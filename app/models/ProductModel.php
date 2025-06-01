<?php
/**
 * Modelo para gerenciamento de produtos
 */
class ProductModel extends BaseModel {
    protected $db;

    
    /**
     * Obtém todos os produtos
     * 
     * @param bool $activeOnly Se true, retorna apenas produtos ativos
     * @return array Lista de produtos
     */
    public function getAllProducts($activeOnly = false) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id";
                
        if ($activeOnly) {
            $sql .= " WHERE p.active = 1";
        }
        
        $sql .= " ORDER BY p.order_num, p.name";
        
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Obtém produtos por categoria
     * 
     * @param int $categoryId ID da categoria
     * @param bool $activeOnly Se true, retorna apenas produtos ativos
     * @return array Lista de produtos da categoria
     */
    public function getProductsByCategory($categoryId, $activeOnly = false) {
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        
        if ($activeOnly) {
            $sql .= " AND active = 1";
        }
        
        $sql .= " ORDER BY order_num, name";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Obtém um produto pelo ID
     * 
     * @param int $id ID do produto
     * @return array|null Dados do produto ou null se não encontrado
     */
    public function getProductById($id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id 
                WHERE p.id = :id";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    /**
     * Salva um produto (novo ou existente)
     * 
     * @param array $data Dados do produto
     * @return bool|int ID do produto em caso de sucesso, false em caso de erro
     */
    public function saveProduct($data) {
        try {
            if (isset($data['id']) && $data['id'] > 0) {
                // Atualização
                $sql = "UPDATE products SET 
                        category_id = :category_id, 
                        name = :name, 
                        description = :description, 
                        benefits = :benefits, 
                        image_path = :image_path, 
                        active = :active, 
                        order_num = :order_num 
                        WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $data['category_id'],
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':benefits' => $data['benefits'],
                    ':image_path' => $data['image_path'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num'],
                    ':id' => $data['id']
                ]);
                
                return $data['id'];
            } else {
                // Inserção
                $sql = "INSERT INTO products (
                        category_id, name, description, benefits, 
                        image_path, active, order_num
                    ) VALUES (
                        :category_id, :name, :description, :benefits, 
                        :image_path, :active, :order_num
                    )";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $data['category_id'],
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':benefits' => $data['benefits'],
                    ':image_path' => $data['image_path'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num']
                ]);
                
                return $this->db->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log("Erro ao salvar produto: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Exclui um produto
     * 
     * @param int $id ID do produto
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    
    /**
     * Obtém todas as categorias de produtos
     * 
     * @param bool $activeOnly Se true, retorna apenas categorias ativas
     * @return array Lista de categorias
     */
    public function getAllCategories($activeOnly = false) {
        $sql = "SELECT * FROM product_categories";
        
        if ($activeOnly) {
            $sql .= " WHERE active = 1";
        }
        
        $sql .= " ORDER BY order_num, name";
        
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Obtém uma categoria pelo ID
     * 
     * @param int $id ID da categoria
     * @return array|null Dados da categoria ou null se não encontrada
     */
    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product_categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    /**
     * Salva uma categoria (nova ou existente)
     * 
     * @param array $data Dados da categoria
     * @return bool|int ID da categoria em caso de sucesso, false em caso de erro
     */
    public function saveCategory($data) {
        try {
            if (isset($data['id']) && $data['id'] > 0) {
                // Atualização
                $sql = "UPDATE product_categories SET 
                        name = :name, 
                        description = :description, 
                        active = :active, 
                        order_num = :order_num 
                        WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num'],
                    ':id' => $data['id']
                ]);
                
                return $data['id'];
            } else {
                // Inserção
                $sql = "INSERT INTO product_categories (
                        name, description, active, order_num
                    ) VALUES (:name, :description, :active, :order_num)";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':active' => $data['active'],
                    ':order_num' => $data['order_num']
                ]);
                
                return $this->db->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log("Erro ao salvar categoria: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Exclui uma categoria
     * 
     * @param int $id ID da categoria
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteCategory($id) {
        try {
            $this->db->beginTransaction();
            
            // Verificar se existem produtos nesta categoria
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM products WHERE category_id = :category_id");
            $stmt->bindParam(':category_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row['count'] > 0) {
                $this->db->rollBack();
                return false;
            }
            
            // Excluir categoria
            $stmt = $this->db->prepare("DELETE FROM product_categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            
            $this->db->commit();
            return $result;
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erro ao excluir categoria: " . $e->getMessage());
            return false;
        }
    }
}