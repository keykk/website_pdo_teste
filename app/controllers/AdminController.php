<?php
/**
 * Controlador do painel administrativo
 */
class AdminController extends BaseController {
    private $contentModel;
    private $bannerModel;
    private $productModel;
    private $resumeModel;
    private $settingsModel;
    private $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->contentModel = new ContentModel();
        $this->bannerModel = new BannerModel();
        $this->productModel = new ProductModel();
        $this->resumeModel = new ResumeModel();
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Método principal para exibir a página de login do admin
     */
    public function index() {
        // Verificar se já está logado
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            $this->redirect(URL_ROOT.'/admin/dashboard');
        }
        
        // Dados para a página de login
        $data = [
            'title' => 'Omnia Brasil - Painel Administrativo',
            'error' => ''
        ];
        
        // Processar login se for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Validar login no banco de dados
            $sql = "SELECT * FROM users WHERE username = :username";
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            //$hash = password_hash($password, PASSWORD_ARGON2ID);
            //echo $hash; // Exibir hash para testes
            if ($user) {
                // Verificar senha
                if (password_verify($password, $user['password'])) { // Senha padrão para testes
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $username;
                    $_SESSION['admin_name'] = $user['name'];
                    $this->redirect(URL_ROOT.'/admin/dashboard');
                } else {
                    $data['error'] = 'Senha incorreta';
                }
            } else {
                $data['error'] = 'Usuário não encontrado';
            }
        }
        
        // Renderizar a view de login
        $this->render('admin/login', $data);
    }
    
    /**
     * Método para exibir o dashboard do admin
     */
    public function dashboard() {
        // Verificar se está logado
        $this->checkLogin();
        
        // Obter estatísticas
        $totalProducts = count($this->productModel->getAllProducts());
        $totalCategories = count($this->productModel->getAllCategories());
        $totalBanners = count($this->bannerModel->getAllBanners());
        $totalResumes = $this->resumeModel->countResumes();
        
        // Dados para o dashboard
        $data = [
            'title' => 'Omnia Brasil - Dashboard',
            'username' => $_SESSION['admin_username'],
            'name' => $_SESSION['admin_name'],
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalBanners' => $totalBanners,
            'totalResumes' => $totalResumes
        ];
        
        // Renderizar a view do dashboard
        $this->renderAdmin('dashboard', $data);
    }

    /**
     * Método para gerenciar banners
     */
    public function banners() {
        // Verificar se está logado
        $this->checkLogin();

        // Verificar se foi enviado um banner para salvar
        $idBanner = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bannerData = [
                'id' => $_POST['id'] ?? null,
                'title' => $_POST['title'] ?? '',
                'subtitle' => $_POST['subtitle'] ?? '',
                'image_path' => $_FILES['image'] ?? null,
                'existing_image' => $_POST['existing_image'] ?? '',
                'link' => $_POST['link'] ?? '',
                'active' => isset($_POST['active']) ? 1 : 0,
                'order_num' => $_POST['order_num'] ?? 0
            ];
            $idBanner = $this->bannerModel->saveBanner($bannerData);
        
        } else if (isset($_GET['delete'])) {
            // Excluir banner se solicitado
            $idBanner = $this->bannerModel->deleteBanner($_GET['delete']);
        }
        // Dados para a página de banners
        $data = [
            'title' => 'Omnia Brasil - Gerenciar Banners',
            'banners' => $this->bannerModel->getAllBanners()
        ];

        if((int)$idBanner > 0) {
            $data['success'] = 'Sucesso !';
        } else if($idBanner <> ''){
            $data['error'] = 'Erro. Verifique os dados e tente novamente. '.$idBanner;
        }
        // Renderizar a view de banners
        $this->renderAdmin('banners', $data);
    }  
    
    /**
     * Método para gerenciar conteúdo das páginas
     */
    public function content() {
        // Verificar se está logado
        $this->checkLogin();
   
        // Dados para a página de conteúdo
        $data = [
            'title' => 'Omnia Brasil - Gerenciamento de Conteúdo',
            'content' => $this->contentModel->getAllContent()
        ];
        
        // Renderizar a view de conteúdo
        $this->renderAdmin('content', $data);
    }

    /**
     * Método para gerenciar produtos
     */
    public function products() {
        // Verificar se está logado
        $this->checkLogin();
        
        // Dados para a página de produtos
        $data = [
            'title' => 'Omnia Brasil - Gerenciar Produtos',
            'products' => $this->productModel->getAllProducts(),
            'categories' => $this->productModel->getAllCategories()
        ];
        
        // Renderizar a view de produtos
        $this->renderAdmin('products', $data);
    }

    /**
     * Método para gerenciar currículos recebidos
     */
    public function resumes() {
        // Verificar se está logado
        $this->checkLogin();
        
        // Dados para a página de currículos
        $data = [
            'title' => 'Omnia Brasil - Currículos Recebidos',
            'resumes' => $this->resumeModel->getAllResumes()
        ];
        
        // Renderizar a view de currículos
        $this->renderAdmin('resumes', $data);
    }

    /**
     * Método para gerenciar configurações
     */
    public function settings() {
        // Verificar se está logado
        $this->checkLogin();
        
        // Dados para a página de configurações
        $data = [
            'title' => 'Omnia Brasil - Configurações',
            'settings' => $this->settingsModel->getAllSettings()
        ];
        
        // Renderizar a view de configurações
        $this->renderAdmin('settings', $data);
    }

    /**
     * Método para fazer logout
     */
    public function logout() {
        // Destruir sessão
        session_destroy();
        
        // Redirecionar para login
        $this->redirect(URL_ROOT . '/admin');
    }
    
    // ... [restante dos métodos permanecem iguais, pois usam os models que já foram convertidos para PDO]
    
    /**
     * Verificar se o usuário está logado
     */
    private function checkLogin() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            $this->redirect(URL_ROOT.'/admin');
        }
    }

}