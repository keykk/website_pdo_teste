<?php
/**
 * Modelo base para todos os modelos
 */
abstract class BaseModel {
    protected $db;
    protected $table;
    
    /**
     * Construtor
     */
    public function __construct() {
        // Obter conexão com o banco de dados
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Buscar todos os registros
     * 
     * @return array
     */
    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Buscar registro por ID
     * 
     * @param int $id ID do registro
     * @return array|false
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Criar novo registro
     * 
     * @param array $data Dados do registro
     * @return int|false ID do registro inserido ou false em caso de erro
     */
    public function create($data) {
        // Preparar campos e valores
        $fields = array_keys($data);
        $placeholders = array_map(function($field) {
            return ":{$field}";
        }, $fields);
        
        $fieldsStr = implode(', ', $fields);
        $placeholdersStr = implode(', ', $placeholders);
        
        // Preparar e executar query
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$fieldsStr}) VALUES ({$placeholdersStr})");
        
        foreach ($data as $field => $value) {
            $stmt->bindValue(":{$field}", $value);
        }
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Atualizar registro
     * 
     * @param int $id ID do registro
     * @param array $data Dados do registro
     * @return bool
     */
    public function update($id, $data) {
        // Preparar campos e valores
        $fields = array_keys($data);
        $setStr = implode(', ', array_map(function($field) {
            return "{$field} = :{$field}";
        }, $fields));
        
        // Preparar e executar query
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$setStr} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        foreach ($data as $field => $value) {
            $stmt->bindValue(":{$field}", $value);
        }
        
        return $stmt->execute();
    }
    
    /**
     * Excluir registro
     * 
     * @param int $id ID do registro
     * @return bool
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Buscar registros com condições
     * 
     * @param array $conditions Condições de busca
     * @return array
     */
    public function findBy($conditions) {
        // Preparar condições
        $whereStr = implode(' AND ', array_map(function($field) {
            return "{$field} = :{$field}";
        }, array_keys($conditions)));
        
        // Preparar e executar query
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$whereStr}");
        
        foreach ($conditions as $field => $value) {
            $stmt->bindValue(":{$field}", $value);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
