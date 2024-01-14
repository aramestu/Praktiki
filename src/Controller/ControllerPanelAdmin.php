<?php

namespace App\SAE\Controller;

use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\OffreNonDefiniRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Service\ServiceEntreprise;
use App\SAE\Service\ServiceEtudiant;

/**
 * Contrôleur administratif avec des méthodes liées à la gestion des étudiants, des entreprises, des offres, etc.
 */
class ControllerPanelAdmin extends ControllerGenerique
{

    /**
     * Affiche le panel des étudiants pour l'administration.
     *
     * @return void
     */
    public static function panelEtudiants(): void
    {
        $listEtudiants = (new EtudiantRepository())->getAll();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'student/studentList.php',
            'listEtudiants' => $listEtudiants]);
    }

    /**
     * Affiche le panel des entreprises en attente de validation pour l'administration.
     *
     * @return void
     */
    public static function panelEntreprises(): void
    {
        $keywords = ControllerEntreprise::keywordsExiste();
        $codePostalEntreprise = ControllerEntreprise::codePostalExiste();
        $effectifEntreprise = ControllerEntreprise::effectifExiste();
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseEnAttenteFiltree($keywords, $codePostalEntreprise, $effectifEntreprise);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'company/companyListWaiting.php',
            'listEntreprises' => $listEntreprises]);
    }

    /**
     * Affiche le panel des offres pour l'administration.
     *
     * @return void
     */
    public static function panelOffres(): void
    {
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
            'listOffres' => $listOffres]);
    }

    /**
     * Affiche le panel d'importation des données pour l'administration.
     *
     * @return void
     */
    public static function panelImportPstage(): void
    {
        self::afficheVue('view.php', ['pagetitle' => 'Importation des données',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/import/index.php']);
    }

    /**
     * Affiche le panel de la liste des entreprises pour l'administration.
     *
     * @return void
     */
    public static function panelListeEntreprises(): void
    {
        $keywords = "";
        if (isset($_GET["keywords"])) {
            $keywords .= $_GET["keywords"];
        }
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseAvecEtatFiltree(null, $keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/entreprise/entrepriseList.php',
            'listEntreprises' => $listEntreprises,
            'keywords' => $keywords,
            'nbEntreprise' => (new EntrepriseRepository())->count(),
            'nbEntrepriseValide' => (new EntrepriseRepository())->getNbEntrepriseValide(),
            'nbEntrepriseAttente' => (new EntrepriseRepository())->getNbEntrepriseAttente(),
            'nbEntrepriseRefuse' => (new EntrepriseRepository())->getNbEntrpriseRefusee()]);
    }

    /**
     * Affiche le panel de la liste des étudiants pour l'administration.
     *
     * @return void
     */
    public static function panelListeEtudiants(): void
    {
        $keywords = "";
        if (isset($_GET["keywords"])) {
            $keywords .= $_GET["keywords"];
        }
        $listEtudiants = (new EtudiantRepository())->searchs($keywords);
        $anneeUniversitaire = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/etudiant/etudiantList.php',
            'listEtudiants' => $listEtudiants,
            'anneeUniversitaire' => $anneeUniversitaire,
            'nbEtudiant' => (new EtudiantRepository())->count(),
            'nbEtudiantExpProValide' => (new EtudiantRepository())->getNbEtudiantExpProValide($anneeUniversitaire),
            'nbEtudiantConventionEnCours' => (new EtudiantRepository())->getNbEtudiantConventionAttente($anneeUniversitaire),
            'nbEtudiantNiStageNiAlternance' => (new EtudiantRepository())->getNbEtudiantSansConventionNiAlternance($anneeUniversitaire)]);
    }

    /**
     * Affiche le panel de la liste des offres pour l'administration.
     *
     * @return void
     */
    public static function panelListeOffres(): void
    {
        $keywords = "";
        if (isset($_GET["keywords"])) {
            $keywords .= $_GET["keywords"];
        }
        $listOffres = (new ExperienceProfessionnelRepository())->search($keywords);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/offre/offreList.php',
            'listOffres' => $listOffres,
            'nbOffre' => (new ExperienceProfessionnelRepository())->getNbExperienceProfessionnel(),
            'nbStage' => (new StageRepository())->count(),
            'nbAlternance' => (new AlternanceRepository())->count(),
            'nbNonDefini' => (new OffreNonDefiniRepository())->count()]);
    }

    /**
     * Affiche le panel de gestion d'une entreprise pour l'administration.
     *
     * @return void
     */
    public static function panelGestionEntreprise(): void
    {
        if (!isset($_GET["siret"])) {
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/entreprise/managementEntreprise.php',
            'entreprise' => $entreprise]);
    }

    /**
     * Valide une entreprise pour l'administration.
     *
     * @return void
     */
    public static function validerEntreprise(): void
    {
        if (!isset($_GET["siret"])) {
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        $entreprise->setEstValide(true);
        (new EntrepriseRepository())->mettreAJour($entreprise);
        self::panelGestionEntreprise();
    }

    /**
     * Invalide une entreprise pour l'administration.
     *
     * @return void
     */
    public static function invaliderEntreprise(): void
    {
        if (!isset($_GET["siret"])) {
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        $entreprise->setEstValide(false);
        (new EntrepriseRepository())->mettreAJour($entreprise);
        self::panelGestionEntreprise();
    }

    /**
     * Supprime une entreprise pour l'administration.
     *
     * @return void
     */
    public static function supprimerEntreprise(): void
    {
        if (!isset($_GET["siret"])) {
            self::error("Entreprise non défini");
            return;
        }
        (new EntrepriseRepository())->supprimer(rawurldecode($_GET["siret"]));
        self::panelListeEntreprises();
    }

    /**
     * Affiche le panel de modification d'une entreprise pour l'administration.
     *
     * @return void
     */
    public static function panelModificationEntreprise(): void
    {
        if (!isset($_GET["siret"])) {
            self::error("Entreprise non défini");
            return;
        }
        $entreprise = (new EntrepriseRepository())->getById(rawurldecode($_GET["siret"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/entreprise/modificationEntreprise.php',
            'entreprise' => $entreprise]);
    }

    /**
     * Modifie une entreprise pour l'administration.
     *
     * @return void
     */
    public static function modifierEntreprise(): void
    {
        $attributs = [];
        if (!isset($_POST["siret"])) {
            self::redirectionVersURL("warning", "aucun siret fourni, impossible d'identifier l'entreprise", "panelListeEntreprises&controller=PanelAdmin");
            return;
        }
        if (isset($_POST["nom"])) {
            $attributs["nomEntreprise"] = $_POST["nom"];
        }
        if (isset($_POST["mail"])) {
            $attributs["mailEntreprise"] = $_POST["mail"];
        }
        if (isset($_POST["telephone"])) {
            $attributs["telephoneEntreprise"] = $_POST["telephone"];
        }
        if (isset($_POST["codePostal"])) {
            $attributs["codePostalEntreprise"] = $_POST["codePostal"];
        }
        if (isset($_POST["website"])) {
            $attributs["siteWebEntreprise"] = $_POST["website"];
        }
        if (isset($_POST["effectif"])) {
            $attributs["effectifEntreprise"] = $_POST["effectif"];
        }
        $entreprise = (new EntrepriseRepository())->getById($_POST["siret"]);
        if ($entreprise == null) {
            self::redirectionVersURL("warning", "aucune entreprise ne correspond à ce siret", "panelListeEntreprises&controller=PanelAdmin");
            return;
        }
        (new ServiceEntreprise())->mettreAJour($entreprise, $attributs);
        self::panelGestionEntreprise();
    }

    /**
     * Affiche le panel de gestion d'un étudiant pour l'administration.
     *
     * @return void
     */
    public static function panelGestionEtudiant(): void
    {
        if (!isset($_GET["numEtudiant"])) {
            self::error("Etudiant non défini");
            return;
        }
        $etudiant = (new EtudiantRepository())->getById(rawurldecode($_GET["numEtudiant"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/etudiant/managementEtudiant.php',
            'etudiant' => $etudiant]);
    }

    /**
     * Supprime un étudiant pour l'administration.
     *
     * @return void
     */
    public static function supprimerEtudiant(): void
    {
        if (!isset($_GET["numEtudiant"])) {
            self::error("Etudiant non défini");
            return;
        }
        (new EtudiantRepository())->supprimer(rawurldecode($_GET["numEtudiant"]));
        self::panelListeEtudiants();
    }

    /**
     * Affiche le panel de modification d'un étudiant pour l'administration.
     *
     * @return void
     */
    public static function panelModificationEtudiant(): void
    {
        if (!isset($_GET["numEtudiant"])) {
            self::error("Etudiant non défini");
            return;
        }
        $etudiant = (new EtudiantRepository())->getById(rawurldecode($_GET["numEtudiant"]));
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/etudiant/modificationEtudiant.php',
            'etudiant' => $etudiant]);
    }

    /**
     * Modifie un étudiant pour l'administration.
     *
     * @return void
     */
    public static function modifierEtudiant(): void
    {
        $attributs = [];
        if (!isset($_POST["numEtudiant"])) {
            self::redirectionVersURL("warning", "aucun numEtudiant fourni, impossible d'identifier l'étudiant", "panelListeEtudiants&controller=PanelAdmin");
            return;
        }
        if (isset($_POST["mailPerso"])) {
            $attributs["mailPersoEtudiant"] = $_POST["mailPerso"];
        }
        if (isset($_POST["telephone"])) {
            $attributs["telephoneEtudiant"] = $_POST["telephone"];
        }
        if (isset($_POST["codePostal"])) {
            $attributs["codePostalEtudiant"] = $_POST["codePostal"];
        }
        if (isset($_POST["nom"])) {
            $attributs["nomEtudiant"] = $_POST["nom"];
        }
        if (isset($_POST["prenom"])) {
            $attributs["prenomEtudiant"] = $_POST["prenom"];
        }
        if (isset($_POST["telephone"])) {
            $attributs["telephoneEtudiant"] = $_POST["telephone"];
        }
        if (isset($_POST["mailUniv"])) {
            $attributs["mailUniversitaireEtudidant"] = $_POST["mailUniv"];
        }
        $etudiant = (new EtudiantRepository())->getById($_POST["numEtudiant"]);
        if ($etudiant == null) {
            self::redirectionVersURL("warning", "aucun etudiant ne possède se numEtudiant", "panelListeEtudiants&controller=PanelAdmin");
        }
        (new ServiceEtudiant())->mettreAJour($etudiant, $attributs);
        self::panelGestionEtudiant();
    }

    /**
     * Affiche le panel des statistiques pour l'administrateur.
     *
     * @return void
     */
    public static function panelStatistique(): void
    {
        $liste = (new AnneeUniversitaireRepository())->getNomStageAlternanceRienExistant();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panelAdmin.php',
            'adminPanelView' => 'user/adminPanel/statistique/statistiques.php',
            'liste' => $liste
        ]);
    }

}