<?php
/**
 * Modelo para gerenciamento de conteúdo das páginas
 */
class ContentModel extends BaseModel {
    protected $db;
    

    /**
     * Obtém todo o conteúdo de uma página específica
     * 
     * @param string $slug Slug da página
     * @return array Conteúdo da página
     */
    public function getPageContent($slug) {
        $content = [];
        
        // Obter informações básicas da página
        $sql = "SELECT id, title, subtitle FROM pages WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica se encontrou resultados (forma PDO)
        if ($result) {
            $page = $result; // Já temos o resultado do fetch anterior
            $content['title'] = $page['title'];
            $content['subtitle'] = $page['subtitle'];
            $pageId = $page['id'];
            
            // Obter seções de conteúdo da página
            $sql = "SELECT section_key, title, content FROM content_sections WHERE page_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$pageId]);  // Forma simplificada com parâmetros no execute
            
            // Obter todas as seções de uma vez (fetchAll)
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($sections as $section) {
                $content[$section['section_key'] . '_TITLE'] = $section['title'];
                $content[$section['section_key']] = $section['content'];
            }
        }
        
        return $content;
    }
    
    /**
     * Obtém o conteúdo de todas as páginas
     * 
     * @return array Conteúdo de todas as páginas
     */
    public function getAllContent() {
        $sql = "SELECT id, slug, title, subtitle FROM pages";
        $stmt = $this->db->query($sql);
        $content = [];

        // PDO usa rowCount() em vez de num_rows
        if ($stmt->rowCount() > 0) {
            // fetchAll() obtém todos os resultados de uma vez (mais eficiente para múltiplas linhas)
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($pages as $page) {
                $pageSlug = $page['slug'];
                $pageId = $page['id'];
                
                $content[$pageSlug] = [
                    'title' => $page['title'],
                    'subtitle' => $page['subtitle']
                ];
                
                // Obter seções de conteúdo da página
                $sqlSections = "SELECT section_key, title, content FROM content_sections WHERE page_id = ?";
                $stmtSections = $this->db->prepare($sqlSections);
                $stmtSections->execute([$pageId]);  // Forma simplificada do PDO
                
                // Obter todas as seções de uma vez
                $sections = $stmtSections->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($sections as $section) {
                    $content[$pageSlug][$section['section_key'] . '_title'] = $section['title'];
                    $content[$pageSlug][$section['section_key'] . '_content'] = $section['content'];
                }
            }
        }

        return $content;
    }
    
    /**
     * Salva o conteúdo de uma página
     * 
     * @param string $slug Slug da página
     * @param array $data Dados do conteúdo
     * @return bool True em caso de sucesso, false em caso de erro
     */
public function savePageContent($slug, $data) {
    try {
        $this->db->beginTransaction();
        
        // Atualizar informações básicas da página
        $sql = "UPDATE pages SET title = ?, subtitle = ? WHERE slug = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['title'], $data['subtitle'], $slug]);
        
        // Obter ID da página
        $sql = "SELECT id FROM pages WHERE slug = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$slug]);
        $page = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($page) {
            $pageId = $page['id'];
            
            // Processar cada seção de conteúdo
            foreach ($data as $key => $value) {
                // Ignorar title e subtitle, já tratados acima
                if ($key == 'title' || $key == 'subtitle') {
                    continue;
                }
                
                // Verificar se é um campo de título ou conteúdo
                if (strpos($key, '_title') !== false) {
                    $sectionKey = str_replace('_title', '', $key);
                    $field = 'title';
                } elseif (strpos($key, '_content') !== false) {
                    $sectionKey = str_replace('_content', '', $key);
                    $field = 'content';
                } else {
                    // Se não for título nem conteúdo, é uma seção simples
                    $sectionKey = $key;
                    $field = 'content';
                }
                
                // Verificar se a seção já existe
                $sql = "SELECT id FROM content_sections WHERE page_id = ? AND section_key = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$pageId, $sectionKey]);
                $section = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($section) {
                    // Atualizar seção existente
                    $sql = "UPDATE content_sections SET $field = ? WHERE id = ?";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute([$value, $section['id']]);
                } else {
                    // Criar nova seção
                    $sql = "INSERT INTO content_sections (page_id, section_key, $field) VALUES (?, ?, ?)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute([$pageId, $sectionKey, $value]);
                }
            }
        }
        
        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        $this->db->rollback();
        error_log("Erro ao salvar conteúdo da página: " . $e->getMessage());
        return false;
    }
}
}
