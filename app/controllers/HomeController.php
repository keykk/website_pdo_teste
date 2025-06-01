<?php
/**
 * Controlador da página inicial
 */
class HomeController extends BaseController {
    private $contentModel;
    private $bannerModel;
    private $settingsModel;
    private $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->contentModel = new ContentModel();
        $this->bannerModel = new BannerModel();
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Método principal para exibir a página inicial
     */
    public function index($request = '') {
        // Obter conteúdo da página inicial
        $content = $this->contentModel->getPageContent('home');
        
        // Obter banners ativos
        $banners = $this->bannerModel->getAllBanners(true);
        
        // Obter configurações do site
        $settings = $this->settingsModel->getAllSettings();
        
        // Obter cotações e previsão do tempo para o rodapé
        $quotes = $this->footerDataModel->getAllQuotes();
        $weather = $this->footerDataModel->getAllWeather();
        
        // Dados para a view
        $data = [
            'title' => $content['title'] ?? 'Omnia Brasil',
            'content' => $content,
            'banners' => $banners,
            'settings' => $settings,
            'quotes' => $quotes,
            'weather' => $weather,
            'info' => $content,
            'request' => $request
        ];
        
        // Renderizar a view
        $this->render('home/index', $data);
    }
}
