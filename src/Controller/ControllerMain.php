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

    public static function setCookie(): void
    {
        Cookie::enregistrer('bannerClosed', true, time() + (10 * 365 * 24 * 60 * 60));
        header('Location: frontController.php?action=home'); // Redirect to home page after setting the cookie
        exit();
    }

    public static function checkCookie(): void
    {
        if (!Cookie::contient('bannerClosed')) {
            echo '<div id="cookie-banner"><h2>Politique de confidentialité</h2>
        <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site. Les cookies sont de petits
            fichiers de données qui sont stockés sur votre ordinateur ou appareil mobile lorsque vous visitez un site
            web. Ils nous permettent de collecter des informations sur votre comportement de navigation, comme les pages
            que vous visitez et les services que vous utilisez. Nous utilisons ces informations pour personnaliser votre
            expérience, pour comprendre comment notre site est utilisé et pour améliorer nos services. En continuant à
            utiliser notre site, vous acceptez notre utilisation des cookies. Pour plus dinformations sur notre
            utilisation des cookies et sur la manière dont vous pouvez contrôler les cookies, veuillez consulter notre
            politique de confidentialité.</p>
        <a href="frontController.php?action=setCookie" id="close-banner">Close</a></div>';
        }
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
