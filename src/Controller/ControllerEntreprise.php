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
                    self::afficheVue("view.php", [
                        "pagetitle" => "Entreprise connecté",
                        "cheminVueBody" => "SAE/home.php"
                    ]);
                } else {
                    self::afficheVue("view.php", [
                        "pagetitle" => "Connexion",
                        "cheminVueBody" => "SAE/error.php",
                        "messageErreur" => $mp1 . " et " . $mp2
                    ]);
                }
            }
        } else {
            self::afficheVue("view.php", [
                "pagetitle" => "Connexion",
                "cheminVueBody" => "SAE/error.php",
                "messageErreur" => "Impossible de se connecter"
            ]);
        }
    }

    public static function disconnect(){
        ConnexionEntreprise::deconnecter();
        self::home();
    }

    public static function creerDepuisFormulaire(): void
    {
        if (isset($_REQUEST["siret"]) > 0 && $_REQUEST["postcode"] > 0 && $_REQUEST["effectif"] > 0 && $_REQUEST["telephone"] > 0 ) {
            $user = Entreprise::construireDepuisFormulaire($_REQUEST);
            (new EntrepriseRepository())->sauvegarder($user);
            self::afficheVue("view.php", [
                "pagetitle" => "Entreprise créee",
                "cheminVueBody" => "SAE/home.php"
            ]);
        } else {
            self::afficheVue("view.php", ["pagetitle" => "Créer une entreprise",
                "cheminVueBody" => "user/createAccount.php"]);
        }
    }
}
