<?php
/**
 * Modelo para gerenciamento de cotações e previsão do tempo
 */
class FooterDataModel extends BaseModel {
    protected $db;
    
    /**
     * Obtém todas as cotações
     * 
     * @return array Lista de cotações
     */
    public function getAllQuotes() {
        $stmt = $this->db->query("SELECT * FROM quotes ORDER BY cultura");
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Atualiza uma cotação
     * 
     * @param array $data Dados da cotação
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function updateQuote($data) {
        $sql = "UPDATE quotes SET 
                valor = :valor, 
                variacao = :variacao, 
                tendencia = :tendencia 
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':valor' => $data['valor'],
            ':variacao' => $data['variacao'],
            ':tendencia' => $data['tendencia'],
            ':id' => $data['id']
        ]);
    }
    
    /**
     * Adiciona uma nova cotação
     * 
     * @param array $data Dados da cotação
     * @return bool|int ID da cotação em caso de sucesso, false em caso de erro
     */
    public function addQuote($data) {
        $sql = "INSERT INTO quotes (cultura, valor, variacao, tendencia) 
                VALUES (:cultura, :valor, :variacao, :tendencia)";
                
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([
            ':cultura' => $data['cultura'],
            ':valor' => $data['valor'],
            ':variacao' => $data['variacao'],
            ':tendencia' => $data['tendencia']
        ])) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Exclui uma cotação
     * 
     * @param int $id ID da cotação
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteQuote($id) {
        $stmt = $this->db->prepare("DELETE FROM quotes WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    /**
     * Obtém todas as previsões do tempo
     * 
     * @return array Lista de previsões do tempo
     */
    public function getAllWeather() {
        $stmt = $this->db->query("SELECT * FROM weather ORDER BY cidade");
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    
    /**
     * Atualiza uma previsão do tempo
     * 
     * @param array $data Dados da previsão
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function updateWeather($data) {
        $sql = "UPDATE weather SET 
                temperatura = :temperatura, 
                icone = :icone 
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':temperatura' => $data['temperatura'],
            ':icone' => $data['icone'],
            ':id' => $data['id']
        ]);
    }
    
    /**
     * Adiciona uma nova previsão do tempo
     * 
     * @param array $data Dados da previsão
     * @return bool|int ID da previsão em caso de sucesso, false em caso de erro
     */
    public function addWeather($data) {
        $sql = "INSERT INTO weather (cidade, estado, temperatura, icone) 
                VALUES (:cidade, :estado, :temperatura, :icone)";
                
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([
            ':cidade' => $data['cidade'],
            ':estado' => $data['estado'],
            ':temperatura' => $data['temperatura'],
            ':icone' => $data['icone']
        ])) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Exclui uma previsão do tempo
     * 
     * @param int $id ID da previsão
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function deleteWeather($id) {
        $stmt = $this->db->prepare("DELETE FROM weather WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    /**
     * Atualiza automaticamente as cotações e previsão do tempo
     * 
     * @return bool True em caso de sucesso, false em caso de erro
     */
    public function updateFooterData() {
        try {
            $this->db->beginTransaction();
            
            // Atualizar cotações (simulação)
            $culturas = ['Soja', 'Milho', 'Café', 'Algodão', 'Trigo'];
            $tendencias = ['alta', 'baixa'];
            
            foreach ($culturas as $cultura) {
                // Verificar se a cultura já existe
                $stmt = $this->db->prepare("SELECT id FROM quotes WHERE cultura = ?");
                $stmt->execute([$cultura]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Gerar valores aleatórios para simulação
                $valor = rand(5000, 50000) / 100; // Entre 50 e 500
                $variacao = (rand(-300, 300) / 100) . '%'; // Entre -3% e 3%
                $tendencia = $tendencias[rand(0, 1)];
                
                if ($row) {
                    // Atualizar
                    $data = [
                        'id' => $row['id'],
                        'valor' => $valor,
                        'variacao' => $variacao,
                        'tendencia' => $tendencia
                    ];
                    $this->updateQuote($data);
                } else {
                    // Inserir
                    $data = [
                        'cultura' => $cultura,
                        'valor' => $valor,
                        'variacao' => $variacao,
                        'tendencia' => $tendencia
                    ];
                    $this->addQuote($data);
                }
            }
            
            // Atualizar previsão do tempo (simulação)
            $cidades = [
                ['cidade' => 'São Paulo', 'estado' => 'SP'],
                ['cidade' => 'Ribeirão Preto', 'estado' => 'SP'],
                ['cidade' => 'Goiânia', 'estado' => 'GO'],
                ['cidade' => 'Cuiabá', 'estado' => 'MT'],
                ['cidade' => 'Campo Grande', 'estado' => 'MS']
            ];
            $icones = ['fa-sun', 'fa-cloud-sun', 'fa-cloud', 'fa-cloud-rain', 'fa-bolt'];
            
            foreach ($cidades as $cidade) {
                // Verificar se a cidade já existe
                $stmt = $this->db->prepare("SELECT id FROM weather WHERE cidade = ? AND estado = ?");
                $stmt->execute([$cidade['cidade'], $cidade['estado']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Gerar valores aleatórios para simulação
                $temperatura = rand(15, 35) . '°C'; // Entre 15°C e 35°C
                $icone = $icones[rand(0, 4)];
                
                if ($row) {
                    // Atualizar
                    $data = [
                        'id' => $row['id'],
                        'temperatura' => $temperatura,
                        'icone' => $icone
                    ];
                    $this->updateWeather($data);
                } else {
                    // Inserir
                    $data = [
                        'cidade' => $cidade['cidade'],
                        'estado' => $cidade['estado'],
                        'temperatura' => $temperatura,
                        'icone' => $icone
                    ];
                    $this->addWeather($data);
                }
            }
            
            $this->db->commit();
            return true;
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erro ao atualizar dados do rodapé: " . $e->getMessage());
            return false;
        }
    }
}