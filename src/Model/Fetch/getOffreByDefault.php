<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

use App\SAE\Controller\ControllerMain;

// instantiate the loader
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\SAE', __DIR__ . '/../src');
// register the autoloader
$loader->register();

if (isset($_GET["action"])) {
    if (in_array($_GET["action"], get_class_methods("App\Covoiturage\Controller\ControllerMain"))) {
        // On recupère l'action passée dans l'URL
        $action = $_GET["action"];
        $controller = $_GET["controller"];
        $classNameController = "App\SAE\Controller\\Controller" . ucfirst($controller);
        if (class_exists($classNameController)) {
            $classNameController::$action();
        }
        else {
            $action = "error";
            ControllerMain::$action();
        }
    }
    else {
        $action = "error";
        ControllerMain::$action();
    }
}
else {
    $action = "home";
    ControllerMain::$action();
}
?>

/*-------------------------------------------------------------------------------------------------------------------------------------
<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

use App\SAE\Controller\ControllerMain;

// instantiate the loader
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\SAE', __DIR__ . '/../src');
// register the autoloader
$loader->register();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Main';

$classNameController = 'App\SAE\Controller\Controller' . $controller;
if (class_exists($classNameController)) {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if (method_exists($classNameController, $action)) {
            $classNameController::$action();
        } else {
            ControllerMain::error("invalidAction");
        }
    } else {
        ControllerMain::home();
    }
} else {
    ControllerMain::error("invalidAction");
}



?>

Fatal error: Uncaught ArgumentCountError: Too few arguments to function App\SAE\Controller\ControllerMain::error(), 0 passed in C:\xampp\htdocs\sae_web_s1\web\frontController.php on line 31 and exactly 1 expected in C:\xampp\htdocs\sae_web_s1\src\Controller\ControllerMain.php:23 Stack trace: #0 C:\xampp\htdocs\sae_web_s1\web\frontController.php(31): App\SAE\Controller\ControllerMain::error() #1 {main} thrown in C:\xampp\htdocs\sae_web_s1\src\Controller\ControllerMain.php on line 23