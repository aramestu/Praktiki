<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\Ldap;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Model\Repository\EntrepriseRepository;

class ControllerConnexion extends ControllerGenerique {

    public static function afficherConnexionLdap(): void{
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexion/connexionLdap.php',
            ]
        );
    }

    public static function connecterLdap(){
        if (isset($_REQUEST["username"],$_REQUEST["password"])) {

            $userInformation = Ldap::connection($_REQUEST["username"],$_REQUEST["password"]);
            if ($userInformation) {
                ConnexionUtilisateur::connecter($userInformation->getMail());
                self::redirectionVersURL("success", "Connexion réussie", "displayTDBetu&controller=Etudiant");
            } else {
                self::redirectionVersURL("warning", "Identifiant ou Mot de passe incorrect", "afficherConnexionLdap&controller=Connexion");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "connecterLdap&controller=Connexion");
        }
    }

    public static function afficherConnexionPersonnel(): void{
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexion/connexionPersonnel.php',
            ]
        );
    }

    public static function connecterPersonnel(){
        if (isset($_REQUEST["username"],$_REQUEST["password"])) {

            $userInformation = Ldap::connectionBrutForcePersonnel($_REQUEST["username"]);
            if ($userInformation) {
                ConnexionUtilisateur::connecter($userInformation->getMail());
                self::redirectionVersURL("success", "Connexion réussie", "controller=Main&action=displayTDBetu");
            } else {
                self::redirectionVersURL("warning", "Identifiant ou Mot de passe incorrect", "afficherConnexionPersonnel&controller=Connexion");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "afficherConnexionPersonnel&controller=Connexion");
        }
    }

    public static function afficherConnexionEntreprise(): void{
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexion/connexionEntreprise.php',
            ]
        );
    }

    public static function connecter(){
        if (isset($_REQUEST["username"], $_REQUEST["password"])) {
            $user = (new EntrepriseRepository())->getById($_REQUEST["username"]);
            if (!is_null($user)) {
                if (VerificationEmail::aValideEmail($user)) {
                    if (MotDePasse::verifier($_REQUEST["password"], $user->formatTableau()["mdpHacheTag"])) {
                        ConnexionUtilisateur::connecter($_REQUEST["username"]);
                        MessageFlash::ajouter("success", "Connexion réussie");
                        self::redirectionVersURL("success", "Connexion réussie", "displayTDBentreprise&controller=Entreprise");

                    } else {
                        self::redirectionVersURL("warning", "Mot de passe incorrect", "afficherConnexionEntreprise&controller=Connexion");
                    }
                } else {
                    self::redirectionVersURL("warning", "Email non validé", "afficherConnexionEntreprise&controller=Connexion");
                }
            } else {
                self::redirectionVersURL("warning", "Login incorrect", "afficherConnexionEntreprise&controller=Connexion");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "afficherConnexionEntreprise&controller=Connexion");
        }
    }

    public static function disconnect(){
        ConnexionUtilisateur::deconnecter();
        self::redirectionVersURL("success", "Déconnexion réussie", "home");
    }
}