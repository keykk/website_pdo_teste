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

// Função de autoload aprimorada para carregar classes automaticamente
spl_autoload_register(function($className) {
    // Converter namespace para caminho de diretório (se aplicável)
    // E garantir que estamos usando o separador de diretório correto
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // Lista de diretórios onde as classes podem estar dentro de 'app'
    $directories = [
        'models',
        'controllers',
        'core', // Adicionar outros diretórios se necessário (ex: libs, helpers)
        '' // Para classes diretamente em 'app' (menos comum em MVC estruturado)
    ];

    // Tentar carregar a classe a partir dos diretórios especificados
    foreach ($directories as $dir) {
        $path = !empty($dir) ? $dir . DIRECTORY_SEPARATOR : '';
        // Construir caminho absoluto usando __DIR__ e DIRECTORY_SEPARATOR
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $path . $className . '.php';

        if (file_exists($file)) {
            require_once $file;
            return; // Classe encontrada e carregada, sair da função
        }
    }

    // Opcional: Adicionar log ou tratamento de erro se a classe não for encontrada em nenhum diretório
    // error_log("Autoload falhou para a classe: " . $className);
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
            $controller->index($request);
            break;
        case 'historia':
            require __DIR__ . '/app/controllers/HistoriaController.php';
            $controller = new HistoriaController();
            $controller->index($request);
            break;
        case 'portfolio':
            require __DIR__ . '/app/controllers/PortfolioController.php';
            $controller = new PortfolioController();
            $controller->index($request);
            break;
        case 'trabalhe-conosco':
            require __DIR__ . '/app/controllers/TrabalheConoscoController.php';
            $controller = new TrabalheConoscoController();
            $controller->index($request);
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/app/views/404.php';
            break;
    }
}
