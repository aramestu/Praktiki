<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\Ldap;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;

class ControllerConnexion extends ControllerGenerique
{

    public static function afficherConnexionLdap(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            ControllerEtudiant::displayTDBetu();
        } else {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Connexion',
                    'cheminVueBody' => 'user/connexion/connexionLdap.php',
                ]
            );
        }
    }

    public static function connecterLdap()
    {
        if (!ConnexionUtilisateur::estConnecte()) {
            if (isset($_REQUEST["username"], $_REQUEST["password"])) {
                $userInformation = Ldap::connection($_REQUEST["username"], $_REQUEST["password"]);
                if ($userInformation) {
                    if ($userInformation->getHomeDirectory() == "ann2" || $userInformation->getHomeDirectory() == "ann3") {
                        ConnexionUtilisateur::connecter($userInformation->getMail());
                        self::redirectionVersURL("success", "Connexion réussie", "displayTDBetu&controller=Etudiant");
                    } else if ($userInformation->getHomeDirectory() == "personnel") {
                        ConnexionUtilisateur::connecter($userInformation->getMail());
                        if (ConnexionUtilisateur::estAdministrateur()) {
                            self::redirectionVersURL("success", "Connexion réussie", "panelListeEtudiants&controller=PanelAdmin");
                        } else {
                            self::redirectionVersURL("success", "Connexion réussie", "displayTDBens&controller=Enseignant");
                        }
                    }
                    else {
                        self::redirectionVersURL("warning", "Vous n'êtes pas un étudiant", "afficherConnexionLdap&controller=Connexion");
                    }
                } else {
                    self::redirectionVersURL("warning", "Identifiant ou Mot de passe incorrect", "afficherConnexionLdap&controller=Connexion");
                }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "connecterLdap&controller=Connexion");
        }
    } else
{
self::redirectionVersURL("warning", "Vous êtes déjà connecté", "home");
}
}

public
static function afficherConnexionPersonnel(): void
{
    if (ConnexionUtilisateur::estConnecte()) {
        ControllerEnseignant::displayTDBens();
    } else {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexion/connexionPersonnel.php',
            ]
        );
    }
}

public
static function connecterPersonnel()
{
    if (!ConnexionUtilisateur::estConnecte()) {
        if (isset($_REQUEST["username"], $_REQUEST["password"])) {
            $userInformation = Ldap::connectionBrutForcePersonnel($_REQUEST["username"]);
            if ($userInformation) {
                ConnexionUtilisateur::connecter($userInformation->getMail());
                if (ConnexionUtilisateur::estAdministrateur()) {
                    self::redirectionVersURL("success", "Connexion réussie", "panelListeEtudiants&controller=PanelAdmin");
                } else {
                    self::redirectionVersURL("success", "Connexion réussie", "displayTDBens&controller=Enseignant");
                }
            } else {
                self::redirectionVersURL("warning", "Identifiant ou Mot de passe incorrect", "afficherConnexionPersonnel&controller=Connexion");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "afficherConnexionPersonnel&controller=Connexion");
        }
    } else {
        self::redirectionVersURL("warning", "Vous êtes déjà connecté", "home");
    }
}

public
static function afficherConnexionEntreprise(): void
{
    if (ConnexionUtilisateur::estConnecte()) {
        ControllerEntreprise::displayTDBentreprise();
    } else {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexion/connexionEntreprise.php',
            ]
        );
    }
}

public
static function connecter()
{
    if (!ConnexionUtilisateur::estConnecte()) {
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
    } else {
        self::redirectionVersURL("warning", "Vous êtes déjà connecté", "home");
    }
}

public
static function disconnect()
{
    ConnexionUtilisateur::deconnecter();
    self::redirectionVersURL("success", "Déconnexion réussie", "home");
}
}