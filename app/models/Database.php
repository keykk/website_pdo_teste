<?php
/**
 * Classe de conexão com o banco de dados usando PDO
 */
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'omnia_db';
    private $conn;
    
    /**
     * Construtor - estabelece conexão com o banco de dados
     */
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $e) {
            error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
            
            // Em ambiente de produção, não exibir o erro diretamente
            if (defined('DEBUG_MODE') && DEBUG_MODE) {
                echo "Erro de conexão com o banco de dados: " . $e->getMessage();
            } else {
                echo "Erro ao conectar com o banco de dados. Por favor, tente novamente mais tarde.";
            }
            exit;
        }
    }
    
    /**
     * Executa uma consulta SQL
     * 
     * @param string $sql Consulta SQL a ser executada
     * @return PDOStatement|false Resultado da consulta ou false em caso de erro
     */
    public function query($sql) {
        try {
            return $this->conn->query($sql);
        } catch (PDOException $e) {
            error_log("Erro na execução da consulta: " . $e->getMessage() . " - SQL: " . $sql);
            return false;
        }
    }
    
    /**
     * Prepara uma declaração SQL
     * 
     * @param string $sql Consulta SQL a ser preparada
     * @return PDOStatement|false Declaração preparada ou false em caso de erro
     */
    public function prepare($sql) {
        try {
            return $this->conn->prepare($sql);
        } catch (PDOException $e) {
            error_log("Erro ao preparar consulta: " . $e->getMessage() . " - SQL: " . $sql);
            return false;
        }
    }
    
    /**
     * Obtém o ID da última inserção
     * 
     * @return string ID da última inserção
     */
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
    
    /**
     * Fecha a conexão com o banco de dados
     */
    public function close() {
        $this->conn = null;
    }
    
    /**
     * Obtém o objeto de conexão PDO
     * 
     * @return PDO Objeto de conexão
     */
    public function getConnection() {
        return $this->conn;
    }
    
    /**
     * Obtém o número de linhas afetadas pela última operação
     * 
     * @return int Número de linhas afetadas
     */
    public function rowCount() {
        return $this->conn->rowCount();
    }
    
    /**
     * Inicia uma transação
     * 
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function beginTransaction() {
        return $this->conn->beginTransaction();
    }
    
    /**
     * Confirma uma transação
     * 
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function commit() {
        return $this->conn->commit();
    }
    
    /**
     * Reverte uma transação
     * 
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function rollback() {
        return $this->conn->rollBack();
    }
    
    /**
     * Escapa uma string para uso seguro em consultas SQL
     * 
     * @param string $string String a ser escapada
     * @return string String escapada
     * @deprecated Em PDO, use prepared statements em vez de escape
     */
    public function escape($string) {
        return $this->conn->quote($string);
    }
}