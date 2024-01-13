<?php

namespace App\SAE\Controller;

use App\SAE\Config\ConfLDAP;
use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\ImportationData;
use App\SAE\Model\DataObject\TuteurProfessionnel;
use App\SAE\Model\HTTP\Cookie;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\TuteurProfessionnelRepository;

/**
 * Contrôleur principal avec des méthodes liées à la gestion des comptes, réinitialisation de mot de passe, etc.
 */
class ControllerMain extends ControllerGenerique
{

    /**
     * Affiche la vue pour créer un compte.
     *
     * @return void
     */
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

    /**
     * Affiche la vue pour la réinitialisation de mot de passe.
     *
     * @return void
     */
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

    /**
     * Affiche la vue pour la réinitialisation de mot de passe.
     *
     * @return void
     */
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

    /**
     * Affiche la vue des préférences si l'utilisateur est connecté, sinon redirige vers la page d'accueil.
     *
     * @return void
     */
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

    /**
     * Affiche la vue pour l'importation de données.
     *
     * @return void
     */
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

    /**
     * Enregistre un cookie et redirige vers la page d'accueil.
     *
     * @return void
     */
    public static function setCookie(): void
    {
        Cookie::enregistrer('bannerClosed', true);
        header('Location: frontController.php?action=home');
        exit();
    }

    /**
     * Vérifie la présence du cookie et affiche un message le cas échéant.
     *
     * @return void
     */
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

    /**
     * Importe des données à partir d'un fichier.
     *
     * @return void
     */
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
