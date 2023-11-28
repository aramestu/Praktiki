<?php

namespace App\SAE\Controller;

use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

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

    public static function panelOffres(): void {
        $keywords = ControllerExpPro::keywordsExiste();
        $dateDebut = ControllerExpPro::dateDebutExiste();
        $dateFin = ControllerExpPro::dateFinExiste();
        $typeContrat = ControllerExpPro::typeContratExiste();
        $niveauEtude = ControllerExpPro::niveauEtudeExiste();
        $codePostal = ControllerExpPro::codePostalExiste();
        $optionTri = ControllerExpPro::optionTriExiste();
        $listOffres = (new ExperienceProfessionnelRepository())->getExpProFiltree($keywords, $dateDebut, $dateFin, $typeContrat, $niveauEtude, $codePostal, $optionTri);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'offre/offerList.php',
                                                'listOffres' => $listOffres ]);
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
        $listEtudiants = (new EtudiantRepository())->searchs($keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'user/adminPanel/etudiant/etudiantList.php',
                                                'listEtudiants' => $listEtudiants ]);
    }

    public static function panelListeOffres(): void {
        $keywords = "";
        if(isset($_GET["keywords"])){
            $keywords .= $_GET["keywords"];
        }
        $listOffres = (new ExperienceProfessionnelRepository())->search($keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                'adminPanelView' => 'user/adminPanel/offre/offreList.php',
                                                'listOffres' => $listOffres ]);
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

    public static function panelGestionEtudiant(): void {
        if(!isset($_GET["numEtudiant"])){
            self::error("Etudiant non défini");
            return;
        }
        $etudiant = (new EtudiantRepository())->getById(rawurldecode($_GET["numEtudiant"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                                'adminPanelView' => 'user/adminPanel/etudiant/managementEtudiant.php',
                                                                'etudiant' => $etudiant ]);
    }

    public static function supprimerEtudiant(): void{
        if(!isset($_GET["numEtudiant"])){
            self::error("Etudiant non défini");
            return;
        }
        (new EtudiantRepository())->supprimer(rawurldecode($_GET["numEtudiant"]));
        self::panelListeEtudiants();
    }

    public static function panelModificationEtudiant(): void{
        if(!isset($_GET["numEtudiant"])){
            self::error("Etudiant non défini");
            return;
        }
        $etudiant = (new EtudiantRepository())->getById(rawurldecode($_GET["numEtudiant"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                                'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
                                                                'adminPanelView' => 'user/adminPanel/etudiant/modificationEtudiant.php',
                                                                'etudiant' => $etudiant ]);
    }

    public static function modifierEtudiant(): void{
        if(!isset($_POST["numEtudiant"])){
            self::error("siret non défini");
            return;
        }
        if(!isset($_POST["nom"])){
            self::error("nom non défini");
            return;
        }
        if(!isset($_POST["prenom"])){
            self::error("prenom non défini");
            return;
        }
        if(!isset($_POST["telephone"])){
            self::error("telephone non défini");
            return;
        }
        if(!isset($_POST["mailUniv"])){
            self::error("mail Univ non défini");
            return;
        }
        if(!isset($_POST["mailPerso"])){
            self::error("mail Perso non défini");
            return;
        }
        if(!isset($_POST["codePostal"])){
            self::error("code postal non défini");
            return;
        }
        $etudiant = (new EtudiantRepository())->getById($_POST["numEtudiant"]);
        $etudiant->setNomEtudiant($_POST["nom"]);
        $etudiant->setPrenomEtudiant($_POST["prenom"]);
        $etudiant->setTelephoneEtudiant($_POST["telephone"]);
        $etudiant->setMailUniversitaireEtudiant($_POST["mailUniv"]);
        $etudiant->setMailPersoEtudiant($_POST["mailPerso"]);
        $etudiant->setCodePostalEtudiant($_POST["codePostal"]);
        (new EtudiantRepository())->mettreAJour($etudiant);
        self::panelGestionEtudiant();
    }

}