<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;

class ControllerPanelAdmin extends ControllerGenerique {

    public static function panelEtudiants(): void {
        $listEtudiants = (new EtudiantRepository())->getAll();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'student/studentList.php',
                                                'listEtudiants' => $listEtudiants]);
    }

    public static function panelEntreprises(): void {
        $keywords = ControllerEntreprise::keywordsExiste();
        $codePostalEntreprise = ControllerEntreprise::codePostalExiste();
        $effectifEntreprise = ControllerEntreprise::effectifExiste();
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseEnAttenteFiltree($keywords, $codePostalEntreprise, $effectifEntreprise);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'company/companyListWaiting.php',
                                                'listEntreprises' => $listEntreprises ]);
    }

    public static function panelListeEntreprises(): void {
        $keywords = "";
        if(isset($_GET["keywords"])){
            $keywords .= $_GET["keywords"];
        }
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseAvecEtatFiltree(null,$keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'user/adminPanel/entreprise/entrepriseList.php',
                                                'listEntreprises' => $listEntreprises,
                                                'keywords' => $keywords]);
    }

    public static function panelListeEtudiants(): void {
        $keywords = "";
        if(isset($_GET["keywords"])){
            $keywords .= $_GET["keywords"];
        }
        $listEtudiants = (new EtudiantRepository())->search($keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'user/adminPanel/etudiant/etudiantList.php',
                                                'listEtudiants' => $listEtudiants ]);
    }

    public static function panelGestionEntreprise(): void {
        if(!isset($_GET["siret"])){
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'user/adminPanel/entreprise/managementEntreprise.php',
                                                'entreprise' => $entreprise ]);
    }

    public static function validerEntreprise(): void{
        if(!isset($_GET["siret"])){
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        $entreprise->setEstValide(true);
        (new EntrepriseRepository())->mettreAJour($entreprise);
        self::panelGestionEntreprise();
    }

    public static function invaliderEntreprise(): void{
        if(!isset($_GET["siret"])){
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        $entreprise->setEstValide(false);
        (new EntrepriseRepository())->mettreAJour($entreprise);
        self::panelGestionEntreprise();
    }
}