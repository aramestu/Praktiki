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
        ControllerMain::error("invalidAction");
    }
} else {
    ControllerMain::home();
}



?>