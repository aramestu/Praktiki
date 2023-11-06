<?php

namespace App\SAE\Controller;

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


    private static function keywordsExiste()
    {
        if (isset($_GET["keywords"])) {
            return $_GET["keywords"];
        }
        return null;
    }

    private static function codePostalExiste()
    {
        if (isset($_GET["codePostal"])) {
            return $_GET["codePostal"];
        }
        return null;
    }

    private static function effectifExiste()
    {
        if (isset($_GET["effectif"])) {
            return $_GET["effectif"];
        }
        return null;
    }

    public static function connecter()
    {
        if (isset($_REQUEST["username"]) && isset($_REQUEST["password"])) {
            $user = (new EntrepriseRepository())->recupererParClePrimaire($_REQUEST["username"]);
            if (!is_null($user)) {
                $mp1 = $user->formatTableau()["mdpHacheTag"];
                $mp2 = hash("sha256", $_REQUEST["password"]);
                if (MotDePasse::verifier($_REQUEST["password"], $user->formatTableau()["mdpHacheTag"])) {
                    ConnexionEntreprise::connecter($_REQUEST["username"]);
                    self::redirectionVersURL("success", "Connexion réussie", "home");
                } else {
                    self::redirectionVersURL("warning", "Mot de passe incorrect" , "connect");
                }
            } else{
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
                if($_REQUEST["effectif"] > 0 ) {
                    if($_REQUEST["telephone"] > 0){
                    $user = Entreprise::construireDepuisFormulaire($_REQUEST);
                    (new EntrepriseRepository())->sauvegarder($user);
                    self::redirectionVersURL("success", "Entreprise créée", "home");
                    }else {
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
}
