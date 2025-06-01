<?php
/**
 * Controlador da página Portfólio
 */
class PortfolioController extends BaseController {
    private $contentModel;
    private $productModel;
    private $settingsModel;
    private $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->contentModel = new ContentModel();
        $this->productModel = new ProductModel();
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Método principal para exibir a página Portfólio
     */
    public function index($request = '') {
        // Obter conteúdo da página Portfólio
        $content = $this->contentModel->getPageContent('portfolio');
        
        // Obter categorias de produtos
        $categories = $this->productModel->getAllCategories(true);
        
        // Obter produtos ativos
        $products = $this->productModel->getAllProducts(true);
        
        // Organizar produtos por categoria
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category['id']] = [
                'category' => $category,
                'products' => []
            ];
        }
        
        foreach ($products as $product) {
            if (isset($productsByCategory[$product['category_id']])) {
                $productsByCategory[$product['category_id']]['products'][] = $product;
            }
        }
        
        // Obter configurações do site
        $settings = $this->settingsModel->getAllSettings();
        
        // Obter cotações e previsão do tempo para o rodapé
        $quotes = $this->footerDataModel->getAllQuotes();
        $weather = $this->footerDataModel->getAllWeather();
        
        // Dados para a view
        $data = [
            'title' => $content['title'] ?? 'Portfólio - Omnia Brasil',
            'content' => $content,
            'categories' => $categories,
            'products' => $products,
            'productsByCategory' => $productsByCategory,
            'settings' => $settings,
            'quotes' => $quotes,
            'weather' => $weather,
            'request' => $request
        ];
        
        // Renderizar a view
        $this->render('portfolio/index', $data);
    }
    
    /**
     * Método para exibir detalhes de um produto
     */
    public function produto($id) {
        // Obter produto pelo ID
        $product = $this->productModel->getProductById($id);
        
        if (!$product) {
            // Produto não encontrado, redirecionar para a página de portfólio
            $this->redirect('/portfolio');
            return;
        }
        
        // Obter conteúdo da página Portfólio
        $content = $this->contentModel->getPageContent('portfolio');
        
        // Obter configurações do site
        $settings = $this->settingsModel->getAllSettings();
        
        // Obter cotações e previsão do tempo para o rodapé
        $quotes = $this->footerDataModel->getAllQuotes();
        $weather = $this->footerDataModel->getAllWeather();
        
        // Dados para a view
        $data = [
            'title' => $product['name'] . ' - Omnia Brasil',
            'content' => $content,
            'product' => $product,
            'settings' => $settings,
            'quotes' => $quotes,
            'weather' => $weather
        ];
        
        // Renderizar a view
        $this->render('portfolio/produto', $data);
    }
}
