<?php
/**
 * Controlador Base
 * Classe abstrata que serve como base para todos os controladores
 */
abstract class BaseController {
    protected $data = [];
    
    /**
     * Renderiza uma view com os dados fornecidos
     * 
     * @param string $view Nome da view a ser renderizada
     * @param array $data Dados a serem passados para a view
     * @return void
     */
    protected function render($view, $data = []) {
        // Mesclar dados existentes com novos dados
        $this->data = array_merge($this->data, $data);
        
        // Extrair dados para que fiquem disponíveis como variáveis na view
        extract($this->data);
        
        // Incluir o cabeçalho
        require_once APP_ROOT . '/views/templates/header.php';
        
        // Incluir a view solicitada
        require_once APP_ROOT . '/views/' . $view . '.php';
        
        // Incluir o rodapé
        require_once APP_ROOT . '/views/templates/footer.php';
    }
    
    /**
     * Renderiza uma view de admin com os dados fornecidos
     * 
     * @param string $view Nome da view a ser renderizada
     * @param array $data Dados a serem passados para a view
     * @return void
     */
    protected function renderAdmin($view, $data = []) {
        // Mesclar dados existentes com novos dados
        $this->data = array_merge($this->data, $data);
        
        // Extrair dados para que fiquem disponíveis como variáveis na view
        extract($this->data);
        
        // Incluir o cabeçalho do admin
        require_once APP_ROOT . '/views/admin/templates/header.php';
        
        // Incluir a view solicitada
        require_once APP_ROOT . '/views/admin/' . $view . '.php';
        
        // Incluir o rodapé do admin
        require_once APP_ROOT . '/views/admin/templates/footer.php';
    }
    
    /**
     * Redireciona para uma URL específica
     * 
     * @param string $url URL para redirecionamento
     * @return void
     */
    protected function redirect($url) {
        // Garantir que a URL comece com URL_ROOT para portabilidade
        if (substr($url, 0, 4) !== 'http' && substr($url, 0, 1) === '/') {
            $url = URL_ROOT . $url;
        }
        header('Location: ' . $url);
        exit;
    }
}
