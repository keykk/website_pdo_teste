<?php
// Set error reporting to catch potential issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define constants if they are in config.php and needed early
require_once __DIR__ . '/app/config/config.php';

// Manually load Database class first
require_once __DIR__ . '/app/config/database.php';

// Manually load Base classes
require_once __DIR__ . '/app/controllers/BaseController.php';
require_once __DIR__ . '/app/models/BaseModel.php';

// --- Start Autoload Function (Copied from corrected index.php) ---
spl_autoload_register(function($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $directories = [
        'models',
        'controllers',
        'core',
        ''
    ];
    foreach ($directories as $dir) {
        $path = !empty($dir) ? $dir . DIRECTORY_SEPARATOR : '';
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            // echo "Autoloaded: $file\n"; // Debugging line
            return;
        }
    }
    // echo "Autoload failed for class: $className\n"; // Debugging line
});
// --- End Autoload Function ---

// Now, try to instantiate the HomeController which previously failed
try {
    echo "Attempting to instantiate HomeController...\n";
    // The autoload should find app/controllers/HomeController.php
    // And its constructor should find app/models/ContentModel.php
    $controller = new HomeController();
    echo "HomeController instantiated successfully! Autoload seems to be working for required models.\n";

    // Optional: Test other models directly if needed
    // echo "Attempting to instantiate BannerModel...\n";
    // $bannerModel = new BannerModel();
    // echo "BannerModel instantiated successfully!\n";

} catch (Throwable $e) { // Catch Throwable to get Errors as well
    echo "Error during instantiation: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "\n";
    // echo "Stack trace:\n" . $e->getTraceAsString() . "\n"; // Can be verbose
}

?>
