<?php
/**
 * Componente para exibir o rodapé com cotações e previsão do tempo
 */
class FooterComponent {
    private $settingsModel, 
            $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Obter cotações para exibição no rodapé
     * 
     * @return array
     */
    public function getCotacoes() {
        return $this->footerDataModel->getAllQuotes();
    }
    
    /**
     * Obter previsão do tempo para exibição no rodapé
     * 
     * @return array
     */
    public function getPrevisaoTempo() {
        return $this->footerDataModel->getAllWeather();
    }
    
    /**
     * Obter informações de contato para o rodapé final
     * 
     * @return array
     */
    public function getContatoInfo() {
        return $this->settingsModel->getAllSettings();
    }
    
    /**
     * Renderizar o rodapé com cotações e previsão do tempo
     * 
     * @return string HTML do rodapé
     */
    public function renderRodapeCotacoes() {
        $cotacoes = $this->getCotacoes();
        $previsao = $this->getPrevisaoTempo();
        
        $html = '<div class="container">';
        $html .= '<div class="row">';
        
        // Cotações
        $html .= '<div class="col-md-6">';
        $html .= '<h5 class="mb-3">Cotações</h5>';
        $html .= '<div class="cotacoes-container">';
        
        foreach ($cotacoes as $cotacao) {
            $tendenciaClass = $cotacao['tendencia'] === 'alta' ? 'text-success' : 'text-danger';
            
            $html .= '<div class="d-flex justify-content-between border-bottom pb-2 mb-2">';
            $html .= '<span>' . $cotacao['cultura'] . '</span>';
            $html .= '<span class="' . $tendenciaClass . '">' . $cotacao['valor'] . ' (' . $cotacao['variacao'] . ')</span>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        // Previsão do tempo
        $html .= '<div class="col-md-6">';
        $html .= '<h5 class="mb-3">Previsão do Tempo</h5>';
        $html .= '<div class="previsao-container">';
        
        foreach ($previsao as $cidade) {
            $html .= '<div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">';
            $html .= '<span>' . $cidade['cidade'] . '/' . $cidade['estado'] . '</span>';
            $html .= '<div>';
            $html .= '<i class="fas ' . $cidade['icone'] . ' text-warning me-2"></i>';
            $html .= '<span>' . $cidade['temperatura'] . '</span>';
            $html .= '</div>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    /**
     * Renderizar o rodapé final com informações de contato
     * 
     * @return string HTML do rodapé
     */
    public function renderRodapeFinal() {
        $info = $this->getContatoInfo();
        
        $html = '<div class="container">';
        $html .= '<div class="row">';
        
        // Logo e descrição
        $html .= '<div class="col-md-4 mb-4 mb-md-0">';
        $html .= '<img src="/public/images/logo-white.png" alt="' . $info['company_name'] . '" class="mb-4" height="60">';
        $html .= '<p>Soluções inovadoras e sustentáveis para a agricultura brasileira. Compromisso com a qualidade e o desenvolvimento do agronegócio.</p>';
        $html .= '<div class="mt-4">';
        $html .= '<a href="' . $info['facebook'] . '" class="text-white me-3" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>';
        $html .= '<a href="' . $info['instagram'] . '" class="text-white me-3" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>';
        $html .= '<a href="' . $info['linkedin'] . '" class="text-white me-3" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>';
        $html .= '<a href="' . $info['youtube'] . '" class="text-white" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>';
        $html .= '</div>';
        $html .= '</div>';
        
        // Informações de contato
        $html .= '<div class="col-md-4 mb-4 mb-md-0">';
        $html .= '<h5 class="mb-4">Contato</h5>';
        $html .= '<ul class="list-unstyled">';
        $html .= '<li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> ' . $info['address'] . '</li>';
        $html .= '<li class="mb-3"><i class="fas fa-phone me-2"></i> ' . $info['phone'] . '</li>';
        $html .= '<li class="mb-3"><i class="fas fa-envelope me-2"></i> ' . $info['email'] . '</li>';
        $html .= '<li><i class="fas fa-clock me-2"></i> ' . $info['working_hours'] . '</li>';
        $html .= '</ul>';
        $html .= '</div>';
        
        // Links rápidos
        $html .= '<div class="col-md-4">';
        $html .= '<h5 class="mb-4">Links Rápidos</h5>';
        $html .= '<ul class="list-unstyled">';
        $html .= '<li class="mb-2"><a href="/" class="text-white text-decoration-none">Home</a></li>';
        $html .= '<li class="mb-2"><a href="/historia" class="text-white text-decoration-none">História</a></li>';
        $html .= '<li class="mb-2"><a href="/portfolio" class="text-white text-decoration-none">Portfólio</a></li>';
        $html .= '<li class="mb-2"><a href="/trabalhe-conosco" class="text-white text-decoration-none">Trabalhe Conosco</a></li>';
        $html .= '<li><a href="#contato" class="text-white text-decoration-none">Contato</a></li>';
        $html .= '</ul>';
        $html .= '</div>';
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}
