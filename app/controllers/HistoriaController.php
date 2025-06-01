<?php
/**
 * Controlador da página História
 */
class HistoriaController extends BaseController {
    private $contentModel;
    private $settingsModel;
    private $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->contentModel = new ContentModel();
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Método principal para exibir a página História
     */
    public function index($requerst = '') {
        // Obter conteúdo da página História
        $content = $this->contentModel->getPageContent('historia');
        
        // Obter configurações do site
        $settings = $this->settingsModel->getAllSettings();
        
        // Obter cotações e previsão do tempo para o rodapé
        $quotes = $this->footerDataModel->getAllQuotes();
        $weather = $this->footerDataModel->getAllWeather();
        
        // Dados para a view
        $data = [
            'title' => $content['title'] ?? 'Nossa História - Omnia Brasil',
            'content' => $content,
            'settings' => $settings,
            'quotes' => $quotes,
            'weather' => $weather,
            'request' => $requerst
        ];
        
        // Renderizar a view
        $this->render('historia/index', $data);
    }
}
