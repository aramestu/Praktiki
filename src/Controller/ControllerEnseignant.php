<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use mysql_xdevapi\Table;

class ControllerEnseignant extends ControllerGenerique{


    public static function afficherMettreAJourEnseignant(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EnseignantRepository())->getByEmail($mail);
        if (is_null($user)) {
            self::redirectionVersURL("warning", "Enseignant inconnu", "home");
        } else {
            self::afficheVue('view.php', ["user" => $user, "pagetitle" => "Detail d'une Enseignant", "cheminVueBody" => "user/tableauDeBord/formulaireEnseignant.php"]);
        }
    }

    public static function mettreAJour(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EnseignantRepository())->getByEmail($mail);
        if (!is_null($user)) {
            $user = Enseignant::construireDepuisFormulaire($_GET);
            (new EnseignantRepository())->mettreAJour($user);
            self::redirectionVersURL("success", "L'enseignant a été mis à jour", "displayTDBens&controller=Enseignant");
        } else {
            self::redirectionVersURL("warning", "cet enseignant n'existe pas", "afficherFormulaireMiseAJour");
        }
    }

}