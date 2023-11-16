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

    public static function supprimerEntreprise(): void{
        if(!isset($_GET["siret"])){
            self::error("Entreprise non défini");
            return;
        }
        (new EntrepriseRepository())->supprimer(rawurldecode($_GET["siret"]));
        self::panelListeEntreprises();
    }

    public static function panelModificationEntreprise(): void{
        if(!isset($_GET["siret"])){
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/entreprise/modificationEntreprise.php',
            'entreprise' => $entreprise ]);
    }

    public static function modifierEntreprise(): void{
        var_dump($_POST);
        if(!isset($_POST["siret"])){
            self::error("siret non défini");
            return;
        }
        if(!isset($_POST["nom"])){
            self::error("nom non défini");
            return;
        }
        if(!isset($_POST["telephone"])){
            self::error("telephone non défini");
            return;
        }
        if(!isset($_POST["mail"])){
            self::error("mail non défini");
            return;
        }
        if(!isset($_POST["effectif"])){
            self::error("effectif non défini");
            return;
        }
        if(!isset($_POST["codePostal"])){
            self::error("code postal non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById($_POST["siret"]);
        $entreprise->setNomEntreprise($_POST["nom"]);
        $entreprise->setTelephoneEntreprise($_POST["telephone"]);
        $entreprise->setEmailEntreprise($_POST["mail"]);
        $entreprise->setEffectifEntreprise($_POST["effectif"]);
        $entreprise->setCodePostalEntreprise($_POST["codePostal"]);
        (new EntrepriseRepository())->mettreAJour($entreprise);
        self::panelGestionEntreprise();
    }
}