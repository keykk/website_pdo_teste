<?php
/**
 * Arquivo principal de entrada da aplicação
 * Responsável por inicializar o sistema e rotear as requisições
 */

// Carregar configurações
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/config/database.php';

// Carregar classes base manualmente para garantir disponibilidade
require_once __DIR__ . '/app/controllers/BaseController.php';
require_once __DIR__ . '/app/models/BaseModel.php';

// Iniciar sessão
session_name(SESSION_NAME);
session_start();

// Função de autoload para carregar classes automaticamente
spl_autoload_register(function($className) {
    // Converter namespace para caminho de arquivo
    $className = str_replace('\\', '/', $className);
    
    // Verificar se o arquivo existe
    $file = __DIR__ . '/app/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Roteamento básico
$request = $_SERVER['REQUEST_URI'];

// Obter o caminho base da aplicação
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

// Remover o caminho base da requisição
$request = str_replace($basePath, '', $request);

// Remover parâmetros de query string
$request = explode('?', $request)[0];

// Remover barras extras no início e fim
$request = trim($request, '/');

// Rotas
// Verificar se é uma rota administrativa
if (strpos($request, 'admin') === 0) {
    require __DIR__ . '/app/controllers/AdminController.php';
    $controller = new AdminController();
    
    // Dividir a rota para obter o método
    $parts = explode('/', $request);
    
    // Se for apenas 'admin', chamar o método index
    if (count($parts) === 1 && $parts[0] === 'admin') {
        $controller->index();
    } 
    // Se for 'admin/alguma-coisa', chamar o método correspondente
    else if (count($parts) === 2 && $parts[0] === 'admin') {
        $method = $parts[1];
        
        // Verificar se o método existe
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            http_response_code(404);
            require __DIR__ . '/app/views/404.php';
        }
    } else {
        http_response_code(404);
        require __DIR__ . '/app/views/404.php';
    }
} else {
    // Rotas normais
    switch ($request) {
        case '':
            require __DIR__ . '/app/controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            break;
        case 'historia':
            require __DIR__ . '/app/controllers/HistoriaController.php';
            $controller = new HistoriaController();
            $controller->index();
            break;
        case 'portfolio':
            require __DIR__ . '/app/controllers/PortfolioController.php';
            $controller = new PortfolioController();
            $controller->index();
            break;
        case 'trabalhe-conosco':
            require __DIR__ . '/app/controllers/TrabalheConoscoController.php';
            $controller = new TrabalheConoscoController();
            $controller->index();
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/app/views/404.php';
            break;
    }
}
