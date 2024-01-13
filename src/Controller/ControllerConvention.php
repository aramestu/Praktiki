<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Service\ServiceConvention;

/**
 * Contrôleur gérant les actions liées aux conventions dans l'application.
 */
class ControllerConvention extends ControllerGenerique
{
    /**
     * Affiche la vue principale des conventions.
     */
    public static function displayConvention(): void{
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
            ]
        );
    }

    /**
     * Affiche le formulaire de modification de convention.
     */
    public static function afficherFormulaire(): void{
        $idEtudiant = $_GET["idEtudiant"];
        $etudiant= (new EtudiantRepository())->getByEmail(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        if($idEtudiant != $etudiant->getNumEtudiant()){
            self::redirectionVersURL("warning", "Vous n'avez pas accès à cette convention", "home");
        }
        $etudiant = (new EtudiantRepository())->getById($idEtudiant);
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($idEtudiant);
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'convention' => $convention,
                'etudiant' => $etudiant
            ]
        );
    }

    /**
     * Modifie une convention.
     */
    public static function modifierConvention(): void {
        if(!isset($_POST["idConvention"])){
            self::redirectionVersURL("waring", "Aucune idConvention renseigné", "home");
            return;
        }
        $convention = (new ConventionRepository())->getById($_POST["idConvention"]);
        if($convention == null) {
            self::redirectionVersURL("waring", "Aucune convention ne correspond à l'idConvention fourni", "home");
            return;
        }
        $etudiant = (new EtudiantRepository())->getEtudiantAvecConvention($convention->getIdConvention());
        if($etudiant->getMailUniversitaireEtudiant() != ConnexionUtilisateur::getLoginUtilisateurConnecte() && !ConnexionUtilisateur::estAdministrateur()){
            self::redirectionVersURL("danger", "Vous n'avez pas la permission de modifier cette convention", "home");
            return;
        }

        $attributs = [];
        if(isset($_POST["caisseAssuranceMaladie"])){
            $attributs["caisseAssuranceMaladie"] = $_POST["caisseAssuranceMaladie"];
        }
        if(isset($_POST["thematiqueExperienceProfessionnel"])){
            $attributs["thematiqueExperienceProfessionnel"] = $_POST["thematiqueExperienceProfessionnel"];
        }
        if(isset($_POST["sujetExperienceProfessionnel"])){
            $attributs["sujetExperienceProfessionnel"] = $_POST["sujetExperienceProfessionnel"];
        }
        if(isset($_POST["tachesExperienceProfessionnel"])){
            $attributs["tachesExperienceProfessionnel"] = $_POST["tachesExperienceProfessionnel"];
        }
        if(isset($_POST["competencesADevelopper"])){
            $attributs["competencesADevelopper"] = $_POST["competencesADevelopper"];
        }
        if(isset($_POST["dateDebutExperienceProfessionnel"])){
            $attributs["dateDebutExperienceProfessionnel"] = $_POST["dateDebutExperienceProfessionnel"];
        }
        if(isset($_POST["dateFinExperienceProfessionnel"])){
            $attributs["dateFinExperienceProfessionnel"] = $_POST["dateFinExperienceProfessionnel"];
        }
        if(isset($_POST["dureeDeTravail"])){
            $attributs["dureeDeTravail"] = $_POST["dureeDeTravail"];
        }
        if(isset($_POST["languesImpression"])){
            $attributs["languesImpression"] = $_POST["languesImpression"];
        }
        if(isset($_POST["origineDeLaConvention"])){
            $attributs["origineDeLaConvention"] = $_POST["origineDeLaConvention"];
        }
        if(isset($_POST["sujetEstConfidentiel"])){
            $attributs["sujetEstConfidentiel"] = $_POST["sujetEstConfidentiel"];
        }
        if(isset($_POST["nbHeuresHebdo"])){
            $attributs["nbHeuresHebdo"] = $_POST["nbHeuresHebdo"];
        }
        if(isset($_POST["modePaiement"])){
            $attributs["modePaiement"] = $_POST["modePaiement"];
        }
        if(isset($_POST["dureeExperienceProfessionnel"])){
            $attributs["dureeExperienceProfessionnel"] = $_POST["dureeExperienceProfessionnel"];
        }
        if(isset($_POST["codePostalExperienceProfessionnel"])){
            $attributs["codePostalExperienceProfessionnel"] = $_POST["codePostalExperienceProfessionnel"];
        }
        if(isset($_POST["adresseExperienceProfessionnel"])){
            $attributs["adresseExperienceProfessionnel"] = $_POST["adresseExperienceProfessionnel"];
        }
        if(isset($_POST["nomEntreprise"])){
            $attributs["nomEntreprise"] = $_POST["nomEntreprise"];
        }
        if(isset($_POST["siret"])){
            $attributs["siret"] = $_POST["siret"];
        }
        if(isset($_POST["codePostalEntreprise"])){
            $attributs["codePostalEntreprise"] = $_POST["codePostalEntreprise"];
        }
        if(isset($_POST["effectifEntreprise"])){
            $attributs["effectifEntreprise"] = $_POST["effectifEntreprise"];
        }
        if(isset($_POST["telephoneEntreprise"])){
            $attributs["telephoneEntreprise"] = $_POST["telephoneEntreprise"];
        }
        if(isset($_POST["nomTuteurProfessionnel"])){
            $attributs["nomTuteurProfessionnel"] = $_POST["nomTuteurProfessionnel"];
        }
        if(isset($_POST["prenomTuteurProfessionnel"])){
            $attributs["prenomTuteurProfessionnel"] = $_POST["prenomTuteurProfessionnel"];
        }
        if(isset($_POST["fonctionTuteurProfessionnel"])){
            $attributs["fonctionTuteurProfessionnel"] = $_POST["fonctionTuteurProfessionnel"];
        }
        if(isset($_POST["mailTuteurProfessionnel"])){
            $attributs["mailTuteurProfessionnel"] = $_POST["mailTuteurProfessionnel"];
        }
        if(isset($_POST["telephoneTuteurProfessionnel"])){
            $attributs["telephoneTuteurProfessionnel"] = $_POST["telephoneTuteurProfessionnel"];
        }
        if(isset($_POST["nomSignataire"])){
            $attributs["nomSignataire"] = $_POST["nomSignataire"];
        }
        if(isset($_POST["prenomSignataire"])){
            $attributs["nomSignataire"] = $_POST["nomSignataire"];
        }
        if(isset($_POST["nomEnseignant"])){
            $attributs["nomEnseignant"] = $_POST["nomEnseignant"];
        }
        if(isset($_POST["prenomEnseignant"])){
            $attributs["prenomEnseignant"] = $_POST["prenomEnseignant"];
        }
        if(isset($_POST["mailEnseignant"])){
            $attributs["mailEnseignant"] = $_POST["mailEnseignant"];
        }

        (new ServiceConvention())->mettreAJour($convention, $attributs);
        ControllerTDB::displayTDB();
    }

    /**
     * Crée un formulaire de convention.
     */
    public static function creerFormulaire(): void{
        $idEtudiant = $_GET["idEtudiant"];
        $etudiant= (new EtudiantRepository())->getByEmail(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        if($idEtudiant != $etudiant->getNumEtudiant()){
            self::redirectionVersURL("warning", "Vous n'avez pas accès à cette convention", "home");
        }
        $etudiant = (new EtudiantRepository())->getById($idEtudiant);
        (new ConventionRepository())->creerConvention($idEtudiant, 3);
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($idEtudiant);
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'convention' => $convention,
                'etudiant' => $etudiant
            ]
        );
    }

    /**
     * Enregistre une convention nouvellement créée.
     */
    public static function enregistrerConvention() : void{
        $rep = new ConventionRepository();
        $idEtudiant = $_GET["idEtudiant"];
        $etudiant= (new EtudiantRepository())->getByEmail(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        if($idEtudiant != $etudiant->getNumEtudiant()){
            self::redirectionVersURL("warning", "Vous n'avez pas accès à cette convention", "home");
        }
        $convention = $rep->getConventionAvecEtudiant($idEtudiant);
        $convention->setEstFini(true);
        $rep->mettreAJour($convention);
        ControllerTDB::displayTDB();
    }
}