<?php

namespace App\SAE\Controller;

use App\SAE\Config\ConfLDAP;
use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\ImportationData;
use App\SAE\Lib\Ldap;
use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;
use App\SAE\Model\DataObject\TuteurProfessionnel;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\DepartementRepository;
use App\SAE\Model\Repository\EnseignantRepository;

;

use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\InscriptionRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\Repository\TuteurProfessionnelRepository;

class ControllerMain extends ControllerGenerique
{


    public static function createAccount(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer un compte',
                'cheminVueBody' => 'user/createAccount.php',
            ]
        );
    }

    public static function forgetPassword(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer un compte',
                'cheminVueBody' => 'user/forgetPassword.php',
            ]
        );
    }

    public static function resetPassword(): void
    {
        if (ConnexionUtilisateur::estEntreprise()) {
            $user = (new EntrepriseRepository())->getById(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'changer le mot de passe',
                    'cheminVueBody' => 'user/resetPassword.php',
                    'user' => $user,
                ]
            );
        } else {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'changer le mot de passe',
                    'cheminVueBody' => 'user/resetPassword.php',
                ]
            );
        }
    }

    public static function preference(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            self::home();
        } else {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Préférence',
                    'cheminVueBody' => 'user/preference.php',
                ]
            );
        }

    }


    public static function import(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Importer',
                'cheminVueBody' => 'SAE/index.php',
            ]
        );
    }

    public static function importation(): void
    {
        if (isset($_POST["import"])) {
            $isFirstLine = true;
            $fileName = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                ImportationData::importFromPstage($fileName);
            }
        }
        if (!empty($result)) {
            $messageErreur = 'Cette offer n existe pas !';
            self::error($messageErreur);
        } else {
            self::home();
        }
    }
}
