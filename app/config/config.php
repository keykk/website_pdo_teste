<?php
/**
 * Arquivo de configuração principal
 */

// Configurações de URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$script_name = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $protocol . $host . $script_name);
define('SITE_NAME', 'Omnia Brasil');
define('DIR_NAME', $_SERVER['DOCUMENT_ROOT'] . $script_name);
define('DIR_IMAGES', BASE_URL . '/app/public/images');
define('DIR_BANNERS', '/app/public/images/banners/');

// Diretórios
define('APP_ROOT', dirname(dirname(__FILE__)));
define('PUBLIC_ROOT', APP_ROOT . '/public');
define('UPLOAD_DIR', PUBLIC_ROOT . '/uploads');
define('URL_ROOT', BASE_URL);

// Configurações de sessão
define('SESSION_NAME', 'omnia_session');
define('SESSION_LIFETIME', 7200); // 2 horas

// Configurações de email
define('EMAIL_FROM', 'contato@omnia.com.br');
define('EMAIL_NAME', 'Omnia Brasil');

// Configurações do CKEditor
define('CKEDITOR_PATH', '/js/ckeditor/');

// Configurações de debug
define('DEBUG_MODE', true);
