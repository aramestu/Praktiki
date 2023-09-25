<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

use App\SAE\Controller\ControllerMain;

// instantiate the loader
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\SAE', __DIR__ . '/../src');
// register the autoloader
$loader->register();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Check if the method exists in ControllerVoiture
    if (method_exists('App\SAE\Controller\ControllerMain', $action)) {
        ControllerMain::$action();
    } else {
        echo "Invalid action.";
    }
} else {
    ControllerMain::home();
}


?>
