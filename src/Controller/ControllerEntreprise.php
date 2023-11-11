<?php

namespace App\SAE\Controller;

use App\SAE\Lib\VerificationEmail;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Lib\ConnexionEntreprise;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EntrepriseRepository;

class ControllerEntreprise extends ControllerGenerique
{
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

    public static function connecter()
    {
        if (isset($_REQUEST["username"]) && isset($_REQUEST["password"])) {
            $user = (new EntrepriseRepository())->getById($_REQUEST["username"]);
            if (!is_null($user)) {
                if (MotDePasse::verifier($_REQUEST["password"], $user->formatTableau()["mdpHacheTag"])) {
                    ConnexionEntreprise::connecter($_REQUEST["username"]);
                    MessageFlash::ajouter("success", "Connexion réussie");
                    self::afficheVue("view.php", [
                        "pagetitle" => "AccueilEntreprise",
                        "cheminVueBody" => "company/companyHome.php",
                    ]);
                } else {
                    self::redirectionVersURL("warning", "Mot de passe incorrect", "connect");
                }
            } else {
                self::redirectionVersURL("warning", "Login incorrect", "connect");
            }
        } else {
            self::redirectionVersURL("warning", "Remplissez les champs libres", "connect");
        }
    }

    public static function disconnect()
    {
        ConnexionEntreprise::deconnecter();
        self::redirectionVersURL("success", "Déconnexion réussie", "home");
    }

    public static function creerDepuisFormulaire(): void
    {
        if (($_REQUEST["siret"]) > 0) {
            if ($_REQUEST["postcode"] > 0) {
                if ($_REQUEST["effectif"] > 0) {
                    if ($_REQUEST["telephone"] > 0) {
                        $user = Entreprise::construireDepuisFormulaire($_REQUEST);
                        (new EntrepriseRepository())->save($user);
                        VerificationEmail::envoiEmailValidation($user);
                        self::redirectionVersURL("success", "Entreprise créée", "home");
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
            self::redirectionVersURL("warning ", "Siret incorrect", "createAccount");
        }
    }

    public static function validerEmail():void{
        if (isset($_GET["siret"], $_GET["nonce"])){
            $bool=VerificationEmail::traiterEmailValidation($_GET["siret"],$_GET["nonce"]);
            if ($bool){
                self::redirectionVersURL("success","Email Valider","home");
            }else {
                self::redirectionVersURL("warning","Email non Valider","afficherListe");
            }
        }else{
            self::redirectionVersURL("warning","Login ou nonce manquant","afficherListe");
        }
    }

    public static function changePassword():void{
        if(isset($_REQUEST["siret"],$_REQUEST["mail"])) {
            $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
            if (!is_null($user)) {
                if ($user->getEmailEntreprise() == $_REQUEST["mail"]) {
                    VerificationEmail::envoiEmailChangementPassword($_REQUEST["siret"], $_REQUEST["mail"]);
                    self::redirectionVersURL("success", "Vous allez recevoir un mail", "home");
                }
            } else {
                self::redirectionVersURL("warning", "mail incorrect", "forgetPassword");
            }
        }else{
            self::redirectionVersURL("warning","Siret inconnu","forgetPassword");
        }
    }

    public static function resetPassword():void{
        if (isset($_REQUEST["siret"],$_REQUEST["newPassword"],$_REQUEST["confirmNewMdp"])) {
            if ($_REQUEST["newPassword"] == $_REQUEST["confirmNewMdp"]) {
                $user = (new EntrepriseRepository())->getById($_REQUEST["siret"]);
                if (!is_null($user)) {
                    $user->setMdpHache($_REQUEST["newPassword"]);
                    (new EntrepriseRepository())->mettreAJour($user);
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

}
