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

class ControllerEntreprise extends ControllerGenerique
{

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

    public static function getNbEntrepriseTotal(): int
    {
        $listEntreprises = (new EntrepriseRepository())->getAll();
        return count($listEntreprises);
    }

    public static function getNbEntrepriseValide(): int
    {
        return (new EntrepriseRepository())->getNbEntrepriseValide();
    }

    public static function getNbEntrepriseEnAttente(): int
    {
        return (new EntrepriseRepository())->getNbEntrepriseAttente();
    }

    public static function getNbEntrepriseRefuse(): int
    {
        //        $listEntreprises = ;
//        foreach ($listEntreprises as $entreprise) {
//            if ($entreprise->getEstValide() == -1) {
//                $nbEntrepriseRefuse++;
//            }
//        }
        //TODO : verifier quand archive presente
        return (new EntrepriseRepository())->getNbEntrpriseRefusee();
    }

    public static function afficherListeEntrepriseValideFiltree(): void
    {
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

    public static function accepter()
    {
        EntrepriseRepository::accepter($_GET["siret"]);
        self::afficherListeEntrepriseEnAttenteFiltree();
    }

    public static function refuser()
    {
        EntrepriseRepository::refuser($_GET["siret"]);
        self::afficherListeEntrepriseEnAttenteFiltree();
    }


    public static function keywordsExiste()
    {
        if (isset($_GET["keywords"])) {
            return $_GET["keywords"];
        }
        return null;
    }

    public static function codePostalExiste()
    {
        if (isset($_GET["codePostal"])) {
            return $_GET["codePostal"];
        }
        return null;
    }

    public static function effectifExiste()
    {
        if (isset($_GET["effectif"])) {
            return $_GET["effectif"];
        }
        return null;
    }

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

    public
    static function changePassword(): void
    {
        if (isset($_REQUEST["siret"], $_REQUEST["mail"]) || ConnexionUtilisateur::estConnecte()) {
            if(ConnexionUtilisateur::estConnecte()){
                $user = (new EntrepriseRepository())->getById(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            }else{
                $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
            }
            if (!is_null($user)) {
                if ($user->getEmailEntreprise() == $_REQUEST["mail"] || ConnexionUtilisateur::estConnecte()) {
                    VerificationEmail::envoiEmailChangementPassword($user->getSiret(), $user->getEmailEntreprise());
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

    public
    static function resetPassword(): void
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

    public static function mettreAJour(): void
    {
        $siret = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new entrepriseRepository())->getById($siret);
        if (!is_null($user)) {
            $user = Entreprise::construireDepuisFormulaire($_GET);
            (new entrepriseRepository())->mettreAJour($user);
            self::redirectionVersURL("success", "L'entreprise a été mis à jour", "displayTDB&controller=TDB");
        } else {
            self::redirectionVersURL("warning", "cet entreprise n'existe pas", "afficherFormulaireMiseAJour");
        }
    }

}
