<?php
/**
 * Modelo para gerenciamento de currículos
 */
class ResumeModel extends BaseModel {
    protected $db;

    /**
     * Obtém todos os currículos
     * 
     * @param int $limit Limite de registros (0 = sem limite)
     * @param int $offset Deslocamento para paginação
     * @return array Lista de currículos
     */
    public function getAllResumes($limit = 0, $offset = 0) {
        $sql = "SELECT * FROM resumes ORDER BY created_at DESC";
        
        if ($limit > 0) {
            $sql .= " LIMIT :offset, :limit";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $this->db->query($sql);
        }
        
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Obtém um currículo pelo ID
     * 
     * @param int $id ID do currículo
     * @return array|null Dados do currículo ou null se não encontrado
     */
    public function getResumeById($id) {
        $stmt = $this->db->prepare("SELECT * FROM resumes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    /**
     * Salva um currículo
     * 
     * @param array $data Dados do currículo
     * @return bool|int ID do currículo em caso de sucesso, false em caso de erro
     */
    public function saveResume($data) {
        try {
            $sql = "INSERT INTO resumes (
                    name, email, phone, position, file_path, message
                ) VALUES (
                    :name, :email, :phone, :position, :file_path, :message
                )";
                
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':phone' => $data['phone'],
                ':position' => $data['position'],
                ':file_path' => $data['file_path'],
                ':message' => $data['message']
            ]);
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erro ao salvar currículo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Exclui um currículo
     * 
     * @param int $id ID do currículo
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteResume($id) {
        try {
            $this->db->beginTransaction();
            
            // Primeiro, obter o caminho do arquivo para excluí-lo
            $resume = $this->getResumeById($id);
            
            if ($resume && !empty($resume['file_path'])) {
                $filePath = APP_ROOT . $resume['file_path'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            
            // Excluir registro do banco
            $stmt = $this->db->prepare("DELETE FROM resumes WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            
            $this->db->commit();
            return $result;
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erro ao excluir currículo: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Erro ao excluir arquivo do currículo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Conta o total de currículos
     * 
     * @return int Total de currículos
     */
    public function countResumes() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM resumes");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? (int)$result['total'] : 0;
    }
}