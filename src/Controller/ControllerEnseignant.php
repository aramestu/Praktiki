<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use mysql_xdevapi\Table;

class ControllerEnseignant extends ControllerGenerique
{

    public static function connect(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connect.php',
            ]
        );
    }


    public static function connecter()
    {
        if (isset($_REQUEST["username"])) {
            $user = (new EnseignantRepository())->getById($_REQUEST["username"]);
            if (!is_null($user)) {
                if ($user->isEstAdmin()) {
                    ConnexionUtilisateur::connecter($_REQUEST["username"]);
                    MessageFlash::ajouter("success", "Connexion réussie");
                    self::redirectionVersURL("success", "Connexion réussie", "panelListeEtudiants&controller=PanelAdmin");
                } else {
                    ConnexionUtilisateur::connecter($_REQUEST["username"]);
                    MessageFlash::ajouter("success", "Connexion réussie");
                    self::redirectionVersURL("success", "Connexion réussie", "home");
                }
            } else {
                self::redirectionVersURL("warning", "Login incorrect", "connect&controller=Enseignant");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "connect&controller=Enseignant");
        }
    }


}