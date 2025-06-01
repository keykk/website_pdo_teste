<?php
/**
 * Modelo para gerenciamento de configurações do site
 */
class SettingsModel extends BaseModel {
    protected $db;
    

    /**
     * Obtém todas as configurações do site
     * 
     * @return array Configurações do site
     */
    public function getAllSettings() {
        $settings = [];
        
        $stmt = $this->db->query("SELECT setting_key, setting_value FROM settings");
        
        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }
        
        return $settings;
    }
    
    /**
     * Obtém uma configuração específica
     * 
     * @param string $key Chave da configuração
     * @return string|null Valor da configuração ou null se não existir
     */
    public function getSetting($key) {
        $stmt = $this->db->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['setting_value'] : null;
    }
    
    /**
     * Salva uma configuração
     * 
     * @param string $key Chave da configuração
     * @param string $value Valor da configuração
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function saveSetting($key, $value) {
        // Verificar se a configuração já existe
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['count'] > 0) {
            // Atualizar configuração existente
            $stmt = $this->db->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
            return $stmt->execute([$value, $key]);
        } else {
            // Inserir nova configuração
            $stmt = $this->db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)");
            return $stmt->execute([$key, $value]);
        }
    }
    
    /**
     * Salva múltiplas configurações
     * 
     * @param array $settings Array associativo de configurações (chave => valor)
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function saveSettings($settings) {
        try {
            $this->db->beginTransaction();
            
            foreach ($settings as $key => $value) {
                $this->saveSetting($key, $value);
            }
            
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollback();
            error_log("Erro ao salvar configurações: " . $e->getMessage());
            return false;
        }
    }
}