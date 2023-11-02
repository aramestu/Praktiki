<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\EntrepriseRepository;

class ControllerEntreprise extends ControllerGenerique
{
    public static function afficherListeEntrepriseEnAttente()
    {
        self::afficheVue("view.php", [
            "pagetitle" => "Entreprises en attentes",
            "cheminVueBody" => "company/companyListWaiting.php"
        ]);
    }

    public static function accepter()
    {
        EntrepriseRepository::accepter($_GET["siret"]);
        self::afficherListeEntrepriseEnAttente();
    }

    public static function refuser()
    {
        EntrepriseRepository::refuser($_GET["siret"]);
        self::afficherListeEntrepriseEnAttente();
    }

    public static function afficherListeEntrepriseValide()
    {
        self::afficheVue("view.php", [
            "pagetitle" => "Entreprise validées",
            "cheminVueBody" => "company/companyListValidated.php"
        ]);
    }
}
