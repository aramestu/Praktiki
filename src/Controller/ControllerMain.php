<?php

namespace App\SAE\Controller;

use App\SAE\Config\ConfLDAP;
use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\IImportation;
use App\SAE\Lib\ImportationPstage;
use App\SAE\Lib\ImportationStudea;
use App\SAE\Model\HTTP\Cookie;
use App\SAE\Model\Repository\EntrepriseRepository;

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
        if (ConnexionUtilisateur::estConnecte()) {
            self::home();
        } else {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Créer un compte',
                    'cheminVueBody' => 'user/createAccount.php',
                ]
            );
        }
    }

    /**
     * Affiche la vue pour la réinitialisation de mot de passe avant de ce connecter.
     *
     * @return void
     */
    public static function forgetPassword(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            self::home();
        } else {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Mot de passe oublié',
                    'cheminVueBody' => 'user/forgetPassword.php',
                ]
            );
        }
    }

    /**
     * Affiche la vue pour la réinitialisation de mot de passe une fois connecté en tant qu'entreprise.
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
                    'pagetitle' => 'Connexion',
                    'cheminVueBody' => 'user/preference.php',
                ]
            );
        }

    }

    /**
     * Enregistre un cookie et redirige vers la page d'accueil.
     *
     * @return void
     */
    public static function setCookie(): void
    {
        Cookie::enregistrer('bannerClosed', true,10 * 365 * 24 * 60 * 60);
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
     * @param IImportation $importation
     * @return void
     */
    public static function importation(): void
    {
        if(isset($_POST["typeOffre"])){
            $typeOffre = $_POST["typeOffre"];
            $importation = new ("App\SAE\Lib\Importation" . $typeOffre);
        }
        else{
            self::redirectionVersURL("danger","Ce type d'importation n'existe pas", "panelListeEtudiants&controller=PanelAdmin");
        }

        if (isset($_POST["import"])) {
            $fileName = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                $importation->import($fileName);
                self::redirectionVersURL("success","Importation faites avec succès", "panelListeEtudiants&controller=PanelAdmin");
            }
        }
        if (!empty($result)) {
            $messageErreur = 'Cette offer n existe pas !';
            self::error($messageErreur);
        } else {
            self::home();
        }
    }

    public static function importationPstage(): void{
        self::importation(new ImportationPstage());
    }

    public static function importationStudea(): void{
        self::importation(new ImportationStudea());
    }
}
