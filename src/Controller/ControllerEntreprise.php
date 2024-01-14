<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use mysql_xdevapi\Table;
/**
 * Contrôleur gérant les actions liées aux entreprises.
 */
class ControllerEntreprise extends ControllerGenerique
{
    /**
     * Affiche la vue de connexion.
     *
     * @return void
     */
    public static function connect(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connexionLdap.php',
            ]
        );
    }

    /**
     * Affiche la liste des entreprises validées avec des filtres.
     *
     * @return void
     */
    public static function afficherListeEntrepriseValideFiltree(): void {
        $keywords = self::keywordsExiste();
        $codePostalEntreprise = self::codePostalExiste();
        $effectifEntreprise = self::effectifExiste();
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseValideFiltree($keywords, $codePostalEntreprise, $effectifEntreprise);
        self::afficheVue("view.php", [
            "pagetitle" => "Entreprise validées",
            "cheminVueBody" => "company/companyListValidated.php",
            "listEntreprises" => $listEntreprises
        ]);
    }

    /**
     * Affiche la liste des entreprises en attente avec des filtres.
     *
     * @return void
     */
    public static function afficherListeEntrepriseEnAttenteFiltree(): void
    {
        $keywords = self::keywordsExiste();
        $codePostalEntreprise = self::codePostalExiste();
        $effectifEntreprise = self::effectifExiste();
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseEnAttenteFiltree($keywords, $codePostalEntreprise, $effectifEntreprise);
        self::afficheVue("view.php", [
            "pagetitle" => "Entreprises en attentes",
            "cheminVueBody" => "company/companyListWaiting.php",
            "listEntreprises" => $listEntreprises
        ]);
    }

    /**
     * Accepte une entreprise en attente.
     *
     * @return void
     */
    public static function accepter() : void
    {
        EntrepriseRepository::accepter($_GET["siret"]);
        self::afficherListeEntrepriseEnAttenteFiltree();
    }

    /**
     * Refuse une entreprise en attente.
     *
     * @return void
     */
    public static function refuser() : void
    {
        EntrepriseRepository::refuser($_GET["siret"]);
        self::afficherListeEntrepriseEnAttenteFiltree();
    }

    /**
     * Obtient les mots-clés de filtre pour les entreprises.
     *
     * @return mixed Les mots-clés ou null si non définis.
     */
    public static function keywordsExiste()
    {
        if (isset($_GET["keywords"])) {
            return $_GET["keywords"];
        }
        return null;
    }

    /**
     * Obtient le code postal de filtre pour les entreprises.
     *
     * @return mixed Le code postal ou null si non défini.
     */
    public static function codePostalExiste()
    {
        if (isset($_GET["codePostal"])) {
            return $_GET["codePostal"];
        }
        return null;
    }

    /**
     * Obtient l'effectif de filtre pour les entreprises.
     *
     * @return mixed L'effectif ou null si non défini.
     */
    public static function effectifExiste()
    {
        if (isset($_GET["effectif"])) {
            return $_GET["effectif"];
        }
        return null;
    }

    /**
     * Crée une entreprise à partir des données d'un formulaire.
     *
     * @return void
     */
    public static function creerDepuisFormulaire(): void
    {
        if (($_REQUEST["siret"]) > 0) {
            $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
            if (is_null($user)) {
                if ($_REQUEST["postcode"] >= 01000 & $_REQUEST["postcode"] <= 98890) {
                    if ($_REQUEST["effectif"] > 0 & $_REQUEST["effectif"] <= 99999) {
                        if ($_REQUEST["telephone"] >= 0600000000 & $_REQUEST["telephone"] <= 799999999) {
                            if ($_REQUEST["password"] == $_REQUEST["confirmPassword"]) {
                                $user = Entreprise::construireDepuisFormulaire($_REQUEST);
                                (new EntrepriseRepository())->save($user);
                                VerificationEmail::envoiEmailValidation($user);
                                self::redirectionVersURL("success", "Entreprise créée", "home");
                            } else {
                                self::redirectionVersURL("warning", "Mot de passe différent", "createAccount");
                            }

                        } else {
                            self::redirectionVersURL("warning", "Telephone incorrect", "createAccount");
                        }
                    } else {
                        self::redirectionVersURL("warning", "Effectif ", "createAccount");
                    }
                } else {
                    self::redirectionVersURL("warning", "Code postal incorrect", "createAccount");
                }
            } else {
                self::redirectionVersURL("warning", "Siret déjà utilisé", "createAccount");
            }
        } else {
            self::redirectionVersURL("warning ", "Siret incorrect", "createAccount");
        }
    }

    /**
     * Valide l'adresse e-mail d'une entreprise.
     *
     * @return void
     */
    public static function validerEmail(): void
    {
        if (isset($_GET["siret"], $_GET["nonce"])) {
            $bool = VerificationEmail::traiterEmailValidation($_GET["siret"], $_GET["nonce"]);
            if ($bool) {
                self::redirectionVersURL("success", "Email Validé", "home");
            } else {
                self::redirectionVersURL("warning", "Email non Validé", "home");
            }
        } else {
            self::redirectionVersURL("warning", "Login ou nonce manquant", "home");
        }
    }

    /**
     * Change le mot de passe d'une entreprise.
     *
     * @return void
     */
    public static function changePassword(): void
    {
        if (isset($_REQUEST["siret"], $_REQUEST["mail"]) || ConnexionUtilisateur::estConnecte()) {
            if(ConnexionUtilisateur::estConnecte()){
                $user = (new EntrepriseRepository())->getById(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            }else{
                $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
            }
            if (!is_null($user)) {
                if ($user->getMailEntreprise() == $_REQUEST["mail"] || ConnexionUtilisateur::estConnecte()) {
                    $user->setNonce(MotDePasse::genererChaineAleatoire());
                    (new EntrepriseRepository())->mettreAJour($user);
                    VerificationEmail::envoiEmailChangementPassword($user);
                    self::redirectionVersURL("success", "Vous allez recevoir un mail", "home");
                } else {
                    self::redirectionVersURL("warning", "mail incorrect", "forgetPassword");
                }
            } else {
                self::redirectionVersURL("warning", "mail incorrect", "forgetPassword");
            }
        } else {
            self::redirectionVersURL("warning", "Siret inconnu", "forgetPassword");
        }
    }

    /**
     * Réinitialise le mot de passe d'une entreprise.
     *
     * @return void
     */
    public static function resetPassword(): void
    {
        if (isset($_REQUEST["siret"], $_REQUEST["newPassword"], $_REQUEST["confirmNewMdp"])) {
            if(ConnexionUtilisateur::estEntreprise() && !isset($_REQUEST["ancienMdp"])){
                self::redirectionVersURL("warning", "Vous n'avez pas remplit l'ancien mot de passe", "displayTDB&controller=TDB");
            }
            if ($_REQUEST["newPassword"] == $_REQUEST["confirmNewMdp"]) {
                $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
                if (!is_null($user)) {
                    if(ConnexionUtilisateur::estEntreprise() && !MotDePasse::verifier($_REQUEST["ancienMdp"], $user->formatTableau()["mdpHacheTag"])){
                        self::redirectionVersURL("warning", "Ancien mot de passe incorrect", "displayTDB&controller=TDB");
                    }
                    $user->setMdpHache($_REQUEST["newPassword"]);
                    $user->setNonce("");
                    (new EntrepriseRepository())->mettreAJour($user);
                    if(ConnexionUtilisateur::estEntreprise()){
                        self::redirectionVersURL("success", "Mot de passe changé", "displayTDB&controller=TDB");
                    }
                    self::redirectionVersURL("success", "Mot de passe changé", "home");
                } else {
                    self::redirectionVersURL("warning", "Utilisateur inconnu", "resetPassword");
                }
            } else {
                self::redirectionVersURL("warning", "Mot de passe différent", "resetPassword");
            }
        } else {
            self::redirectionVersURL("warning", "Variable non remplit", "resetPassword");
        }
    }

    public static function verifNonce(): void
    {
        $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
        if($user->FormatTableau()["nonceTag"] != $_REQUEST["nonce"]){
            self::redirectionVersURL("warning", "Vous ne pouvez pas réutiliser le même mail", "home");
        }else{
            self::afficheVue("view.php", [
                "pagetitle" => "Changement de mot de passe",
                "cheminVueBody" => "user/resetPassword.php",
                "siret" => $_REQUEST["siret"],
                "nonce" => $_REQUEST["nonce"]
            ]);
        }
    }

}
