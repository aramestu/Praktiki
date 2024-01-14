<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

use App\SAE\Controller\ControllerMain;
use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\OffreNonDefiniRepository;
use App\SAE\Model\Repository\StageRepository;

// instantiate the loader
$loader = new App\SAE\Lib\Psr4AutoloaderClass();
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('App\SAE', __DIR__ . '/../src');


$controller = $_GET['controller'] ?? 'Main';
if ($controller == 'PanelAdmin' && !ConnexionUtilisateur::estAdministrateur()) {
    ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher le panel admin", "home");
} elseif ($controller == 'TDB' && !ConnexionUtilisateur::estConnecte()) {
    ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher le tableau de bord", "home");
} elseif ($controller == 'ExpPro' && !ConnexionUtilisateur::estConnecte()) {
    ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher les offres", "home");
} elseif ($controller == 'ExpPro' && ConnexionUtilisateur::estEntreprise() && $_GET['action'] != 'createOffer' && $_GET['action'] !='creerOffreDepuisFormulaire') {
    $idExpPro = $_GET["experiencePro"] ?? null;
    if (is_null($idExpPro)) {
        ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher les offres", "home");
    }
    $rep = new StageRepository();
    $stage = $rep->getById($idExpPro);

    if (!is_null($stage)) {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() != $stage->getSiret()) {
            ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
        }
    } else {
        $rep = new AlternanceRepository();
        $alternance = $rep->getById($idExpPro);
        if (!is_null($alternance)) {
            if (ConnexionUtilisateur::getLoginUtilisateurConnecte() != $alternance->getSiret() && ConnexionUtilisateur::estEntreprise()) {
                ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
            }
        } else {
            $rep = new OffreNonDefiniRepository();
            $offreNonDefini = $rep->getById($idExpPro);
            if (!is_null($offreNonDefini)) {
                if (ConnexionUtilisateur::getLoginUtilisateurConnecte() != $offreNonDefini->getSiret() && ConnexionUtilisateur::estEntreprise()) {
                    ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");

                }
            } else {
                ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
            }
        }
    }
} elseif ($controller == 'Convention' && !ConnexionUtilisateur::estEtudiant()) {
    ControllerMain::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher les conventions", "home");
}

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
    ControllerMain::home();
}
?>