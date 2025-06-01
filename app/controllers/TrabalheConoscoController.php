<?php
/**
 * Controlador da página Trabalhe Conosco
 */
class TrabalheConoscoController extends BaseController {
    private $contentModel;
    private $resumeModel;
    private $settingsModel;
    private $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        $this->contentModel = new ContentModel();
        $this->resumeModel = new ResumeModel();
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Método principal para exibir a página Trabalhe Conosco
     */
    public function index($request = '') {
        // Obter conteúdo da página Trabalhe Conosco
        $content = $this->contentModel->getPageContent('trabalhe-conosco');
        
        // Obter configurações do site
        $settings = $this->settingsModel->getAllSettings();
        
        // Obter cotações e previsão do tempo para o rodapé
        $quotes = $this->footerDataModel->getAllQuotes();
        $weather = $this->footerDataModel->getAllWeather();
        
        // Dados para a view
        $data = [
            'title' => $content['title'] ?? 'Trabalhe Conosco - Omnia Brasil',
            'content' => $content,
            'settings' => $settings,
            'quotes' => $quotes,
            'weather' => $weather,
            'success' => isset($_GET['success']) ? true : false,
            'error' => isset($_GET['error']) ? $_GET['error'] : '',
            'request' => $request
        ];
        
        // Renderizar a view
        $this->render('trabalhe-conosco/index', $data);
    }
    
    /**
     * Método para processar o envio de currículo
     */
    public function enviar() {
        // Verificar se é uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/trabalhe-conosco');
            return;
        }
        
        // Validar dados do formulário
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $position = $_POST['position'] ?? '';
        $message = $_POST['message'] ?? '';
        
        if (empty($name) || empty($email) || empty($phone)) {
            $this->redirect('/trabalhe-conosco?error=Preencha todos os campos obrigatórios');
            return;
        }
        
        // Validar e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/trabalhe-conosco?error=E-mail inválido');
            return;
        }
        
        // Processar upload do arquivo
        $filePath = '';
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = APP_ROOT . '/public/uploads/resumes/';
            
            // Criar diretório se não existir
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Gerar nome único para o arquivo
            $fileName = uniqid() . '_' . basename($_FILES['resume']['name']);
            $filePath = '/public/uploads/resumes/' . $fileName;
            $uploadFile = $uploadDir . $fileName;
            
            // Verificar tipo de arquivo (permitir apenas PDF, DOC, DOCX)
            $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
                $this->redirect('/trabalhe-conosco?error=Formato de arquivo não permitido. Use PDF, DOC ou DOCX');
                return;
            }
            
            // Mover arquivo para o diretório de uploads
            if (!move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFile)) {
                $this->redirect('/trabalhe-conosco?error=Erro ao enviar o arquivo');
                return;
            }
        } else {
            $this->redirect('/trabalhe-conosco?error=É necessário enviar um currículo');
            return;
        }
        
        // Salvar dados no banco
        $resumeData = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'position' => $position,
            'file_path' => $filePath,
            'message' => $message
        ];
        
        $result = $this->resumeModel->saveResume($resumeData);
        
        if ($result) {
            // Enviar e-mail de notificação (opcional)
            $this->sendResumeNotification($resumeData);
            
            // Redirecionar com mensagem de sucesso
            $this->redirect('/trabalhe-conosco?success=1');
        } else {
            // Redirecionar com mensagem de erro
            $this->redirect('/trabalhe-conosco?error=Erro ao salvar o currículo');
        }
    }
    
    /**
     * Método para enviar notificação por e-mail (opcional)
     */
    private function sendResumeNotification($data) {
        // Obter e-mail de destino das configurações
        $settings = $this->settingsModel->getAllSettings();
        $to = $settings['resume_email'] ?? 'rh@omnia.com.br';
        
        $subject = 'Novo currículo recebido - ' . $data['name'];
        
        $message = "Um novo currículo foi recebido pelo site:\n\n";
        $message .= "Nome: " . $data['name'] . "\n";
        $message .= "E-mail: " . $data['email'] . "\n";
        $message .= "Telefone: " . $data['phone'] . "\n";
        $message .= "Cargo: " . $data['position'] . "\n\n";
        $message .= "Mensagem: " . $data['message'] . "\n\n";
        $message .= "O currículo está disponível no painel administrativo.";
        
        $headers = "From: " . $settings['company_name'] . " <" . $settings['contact_email'] . ">\r\n";
        
        // Enviar e-mail (descomentado em ambiente de produção)
        // mail($to, $subject, $message, $headers);
    }
}
