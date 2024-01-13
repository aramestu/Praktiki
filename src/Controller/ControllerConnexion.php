<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\Ldap;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
/**
 * Contrôleur gérant les actions liées à la connexion dans l'application.
 */
class ControllerConnexion extends ControllerGenerique
{
    /**
     * Affiche le formulaire de connexion LDAP.
     */
    public static function afficherConnexionLdap(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            ControllerTDB::displayTDB();
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

    /**
     * Connecte un utilisateur via LDAP.
     */
    public static function connecterLdap(): void
    {
        if (!ConnexionUtilisateur::estConnecte()) {
            if (isset($_REQUEST["username"], $_REQUEST["password"])) {
                $userInformation = Ldap::connection($_REQUEST["username"], $_REQUEST["password"]);
                if ($userInformation && (new EtudiantRepository())->getByEmail($userInformation->getMail())) {
                    if ($userInformation->getHomeDirectory() == "ann2" || $userInformation->getHomeDirectory() == "ann3") {
                        ConnexionUtilisateur::connecter($userInformation->getMail());
                        self::redirectionVersURL("success", "Connexion réussie", "displayTDB&controller=TDB");
                    } else if ($userInformation->getHomeDirectory() == "personnel") {
                        ConnexionUtilisateur::connecter($userInformation->getMail());
                        if (ConnexionUtilisateur::estAdministrateur()) {
                            self::redirectionVersURL("success", "Connexion réussie", "panelListeEtudiants&controller=PanelAdmin");
                        } else {
                            self::redirectionVersURL("success", "Connexion réussie", "displayTDB&controller=TDB");
                        }
                    } else {
                        self::redirectionVersURL("warning", "Vous n'êtes pas un étudiant", "afficherConnexionLdap&controller=Connexion");
                    }
                } else {
                    self::redirectionVersURL("warning", "Identifiant ou Mot de passe incorrect", "afficherConnexionLdap&controller=Connexion");
                }
            } else {
                self::redirectionVersURL("warning", "Remplissez les champs libres", "connecterLdap&controller=Connexion");
            }
        }else
        {
            self::redirectionVersURL("warning", "Vous êtes déjà connecté", "home");
        }
    }

    /**
     * Affiche le formulaire de connexion pour le personnel.
     */
    public static function afficherConnexionPersonnel(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            ControllerTDB::displayTDB();
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

    /**
     * Connecte un utilisateur personnel.
     */
    public static function connecterPersonnel(): void
    {
        if (!ConnexionUtilisateur::estConnecte()) {
            if (isset($_REQUEST["username"], $_REQUEST["password"])) {
                $userInformation = Ldap::connectionBrutForcePersonnel($_REQUEST["username"]);
                if ($userInformation) {
                    ConnexionUtilisateur::connecter($userInformation->getMail());
                    if (ConnexionUtilisateur::estAdministrateur()) {
                        self::redirectionVersURL("success", "Connexion réussie", "panelListeEtudiants&controller=PanelAdmin");
                    } else {
                        self::redirectionVersURL("success", "Connexion réussie", "displayTDB&controller=TDB");
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

    /**
     * Affiche le formulaire de connexion pour les entreprises.
     */
    public static function afficherConnexionEntreprise(): void
    {
        if (ConnexionUtilisateur::estConnecte()) {
            ControllerTDB::displayTDB();
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

    /**
     * Connecte une entreprise.
     */
    public static function connecterEntreprise(): void
    {
        if (!ConnexionUtilisateur::estConnecte()) {
            if (isset($_REQUEST["username"], $_REQUEST["password"])) {
                $user = (new EntrepriseRepository())->getById($_REQUEST["username"]);
                if (!is_null($user)) {
                    if (VerificationEmail::aValideEmail($user)) {
                        if (MotDePasse::verifier($_REQUEST["password"], $user->formatTableau()["mdpHacheTag"])) {
                            ConnexionUtilisateur::connecter($_REQUEST["username"]);
                            MessageFlash::ajouter("success", "Connexion réussie");
                            self::redirectionVersURL("success", "Connexion réussie", "displayTDB&controller=TDB");

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

    /**
     * Déconnecte l'utilisateur.
     */
    public static function disconnect(): void
    {
        ConnexionUtilisateur::deconnecter();
        self::redirectionVersURL("success", "Déconnexion réussie", "home");
    }
}