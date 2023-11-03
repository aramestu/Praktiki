<?php

namespace App\SAE\Controller;

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



    private static function keywordsExiste(){
        if(isset($_GET["keywords"])){
            return $_GET["keywords"];
        }
        return null;
    }

    private static function codePostalExiste(){
        if(isset($_GET["codePostal"])){
            return $_GET["codePostal"];
        }
        return null;
    }

    private static function effectifExiste(){
        if(isset($_GET["effectif"])){
            return $_GET["effectif"];
        }
        return null;
    }
}
