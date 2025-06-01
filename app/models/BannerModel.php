<?php
/**
 * Modelo para gerenciamento de banners
 */
class BannerModel extends BaseModel {
    protected $db;

    /**
     * Obtém todos os banners
     * 
     * @param bool $activeOnly Se true, retorna apenas banners ativos
     * @return array Lista de banners
     */
    public function getAllBanners($activeOnly = false) {
        $sql = "SELECT * FROM banners";
        
        if ($activeOnly) {
            $sql .= " WHERE active = 1";
        }
        
        $sql .= " ORDER BY order_num, id";
        
        $stmt = $this->db->query($sql);
        
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Obtém um banner pelo ID
     * 
     * @param int $id ID do banner
     * @return array|null Dados do banner ou null se não encontrado
     */
    public function getBannerById($id) {
        $sql = "SELECT * FROM banners WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    /**
     * Salva um banner (novo ou existente)
     * 
     * @param array $data Dados do banner
     * @return bool|int ID do banner em caso de sucesso, false em caso de erro
     */
    public function saveBanner($data) {
        try {
            $img = $this->processImageUpload($data['image_path'] ?? NULL, $data['existing_image'] ?? '');
            $ffile = DIR_NAME . DIR_BANNERS . $img;
            
            if (!is_file($ffile)) {
                return $img; // Retorna false se houve erro no upload da imagem
                exit;
            }
            if (isset($data['id']) && $data['id'] > 0) {
                // Atualização
                $sql = "UPDATE banners SET 
                        title = :title, 
                        subtitle = :subtitle, 
                        image_path = :image_path, 
                        link = :link, 
                        active = :active, 
                        order_num = :order_num 
                        WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':title' => $data['title'],
                    ':subtitle' => $data['subtitle'],
                    ':image_path' => $img,
                    ':link' => $data['link'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num'],
                    ':id' => $data['id']
                ]);
                
                return $data['id'];
            } else {
                // Inserção
                $sql = "INSERT INTO banners (
                        title, subtitle, image_path, link, active, order_num
                    ) VALUES (
                        :title, :subtitle, :image_path, :link, :active, :order_num
                    )";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':title' => $data['title'],
                    ':subtitle' => $data['subtitle'],
                    ':image_path' => $img,
                    ':link' => $data['link'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num']
                ]);
                
                return $this->db->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log("Erro ao salvar banner: " . $e->getMessage());
            return "Erro ao salvar banner: " . $e->getMessage();
        }
    }

    /*Processar imagemBanner*/
    private function processImageUpload($img, $existingImagePath = '') {
        if (empty($img['name'])) {
            return $existingImagePath;
        }

        $uploadDir = DIR_NAME . DIR_BANNERS;

        // Verifica/cria o diretório
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Verifica se é realmente uma imagem (usando getimagesize)
        $imageInfo = getimagesize($img['tmp_name']);
        if ($imageInfo === false) {
            return("O arquivo não é uma imagem válida.");
        }

        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($img['size'] > $maxSize) {
            return("A imagem é muito grande. Tamanho máximo permitido: 2MB.");
        }
            
        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
        $imgName = 'banner_' . uniqid() . '.' . $extension;
        $uploadFile = $uploadDir . $imgName;

        if (!empty($img['name']) && is_file($uploadDir . $existingImagePath)) {
            // Remove a imagem existente
            if(is_file($uploadDir . $existingImagePath))
                unlink($uploadDir . $existingImagePath);
        }

        if (move_uploaded_file($img['tmp_name'], $uploadFile)) {
            return $imgName; // Retorna o nome do arquivo para salvar no banco
        }
        else {
            error_log("Erro ao fazer upload da imagem: " . $img['error']);
            return "Erro ao fazer upload da imagem: " . $img['error'];
        }

    }
    /**
     * Exclui um banner
     * 
     * @param int $id ID do banner
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteBanner($id) {
        try {
            $ex = $this->deleteBannerImg($id);
            if ($ex !== true) {
                return $ex; // Retorna mensagem de erro se houver
                exit;
            }
            $stmt = $this->db->prepare("DELETE FROM banners WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir banner: " . $e->getMessage());
            return "Erro ao excluir banner: " . $e->getMessage();
        }
    }

    private function deleteBannerImg($id) {
        try {
            $stmtSelect = $this->db->prepare("SELECT image_path FROM banners WHERE id = :id");
            $stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtSelect->execute();

            $banner = $stmtSelect->fetch(PDO::FETCH_ASSOC);
            $imagePath = $banner['image_path'] ?? '';

            // Verifica se o caminho da imagem não está vazio
            if (empty($imagePath)) {
                return true; // Nada para excluir
            }

            $uploadDir = DIR_NAME . DIR_BANNERS;
            $fullPath = $uploadDir . $imagePath;

            // Verifica se é um arquivo e existe
            if (is_file($fullPath)) {
                if (!unlink($fullPath)) {
                    error_log("Falha ao excluir o arquivo: " . $fullPath);
                    return "Falha ao excluir o arquivo";
                }
                return true;
            } else {
                error_log("Caminho não é um arquivo válido ou não existe: " . $fullPath);
                return true; // Ou retorne false/mensagem de erro, dependendo da sua lógica
            }
        } catch (PDOException $e) { 
            error_log("Erro ao excluir imagem do banner: " . $e->getMessage());
            return "Erro ao excluir imagem do banner: " . $e->getMessage();
        }
    }
}