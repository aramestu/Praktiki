<?php

namespace App\SAE\Controller;

use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\StageRepository;

class ControllerConvention extends ControllerGenerique
{
    public static function displayConvention(): void{
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
            ]
        );
    }


    public static function afficherFormulaire(): void{
        $idEtudiant = $_GET["idEtudiant"];
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

    public static function modifierConvention(): void {
        $tab = [
            "idConvention" => $_POST["idConvention"],
            "competencesADevelopper" => $_POST["competences"],
            "dureeDeTravail" => $_POST["dureeTravail"],
            "languesImpression" => $_POST["langueConvention"],
            "origineDeLaConvention" => $_POST["origineStage"],
            "sujetEstConfidentiel" => $_POST["confidentialite"],
            "nbHeuresHebdo" => $_POST["nombreHeuresHebdo"],
            "modePaiement" => $_POST["modaliteVersement"],
            "dureeExperienceProfessionnel" => $_POST["dureeStage"],
            "caisseAssuranceMaladie" => $_POST["assuranceMaladie"],
            "estSignee" => $_POST["estSignee"],
            "estValidee" => $_POST["estValidee"],
            "mailEnseignant" => $_POST["mailEnseignant"],
            "nomEnseignant" => $_POST["nomEnseignant"],
            "prenomEnseignant" => $_POST["prenomEnseignant"],
            "mailTuteurProfessionnel" => $_POST["mailTuteurProfessionnel"],
            "nomTuteurProfessionnel" => $_POST["nomTuteurProfessionnel"],
            "prenomTuteurProfessionnel" => $_POST["prenomTuteurProfessionnel"],
            "fonctionTuteurProfessionnel" => $_POST["fonctionTuteurProfessionnel"],
            "telephoneTuteurProfessionnel" => $_POST["telephoneTuteurProfessionnel"],
            "sujetExperienceProfessionnel" => $_POST["sujetExperienceProfessionnel"],
            "thematiqueExperienceProfessionnel" => $_POST["thematiqueExperienceProfessionnel"],
            "tachesExperienceProfessionnel" => $_POST["tachesExperienceProfessionnel"],
            "codePostalExperienceProfessionnel" => $_POST["codePostalExperienceProfessionnel"],
            "adresseExperienceProfessionnel" => $_POST["adresseExperienceProfessionnel"],
            "dateDebutExperienceProfessionnel" => $_POST["dateDebutExperienceProfessionnel"],
            "dateFinExperienceProfessionnel" => $_POST["dateFinExperienceProfessionnel"],
            "nomSignataire" => $_POST["nomSignataire"],
            "prenomSignataire" => $_POST["prenomSignataire"],
            "siret" => $_POST["siret"],
            "nomEntreprise" => $_POST["nomEntreprise"],
            "codePostalEntreprise" => $_POST["codePostalEntreprise"],
            "effectifEntreprise" => $_POST["effectifEntreprise"],
            "telephoneEntreprise" => $_POST["telephoneEntreprise"],
            "estFini" => $_POST["estFini"]
        ];
        $rep = new ConventionRepository();
        //$convention = $rep->construireDepuisTableau($_POST);
        $convention = new Convention(
            $tab["mailEnseignant"],
            $tab["nomEnseignant"],
            $tab["prenomEnseignant"],
            $tab["competencesADevelopper"],
            $tab["dureeDeTravail"],
            $tab["languesImpression"],
            $tab["origineDeLaConvention"],
            true, // $sujetEstConfidentiel
            $tab["nbHeuresHebdo"],
            $tab["modePaiement"],
            $tab["dureeExperienceProfessionnel"],
            $tab["caisseAssuranceMaladie"],
            $tab["mailTuteurProfessionnel"],
            $tab["prenomTuteurProfessionnel"],
            $tab["nomTuteurProfessionnel"],
            $tab["fonctionTuteurProfessionnel"],
            $tab["telephoneTuteurProfessionnel"],
            $tab["sujetExperienceProfessionnel"],
            $tab["thematiqueExperienceProfessionnel"],
            $tab["tachesExperienceProfessionnel"],
            $tab["codePostalExperienceProfessionnel"],
            $tab["adresseExperienceProfessionnel"],
            $tab["dateDebutExperienceProfessionnel"],
            $tab["dateFinExperienceProfessionnel"],
            $tab["nomSignataire"],
            $tab["prenomSignataire"],
            $tab["siret"],
            $tab["nomEntreprise"],
            $tab["codePostalEntreprise"],
            $tab["effectifEntreprise"],
            $tab["telephoneEntreprise"],
            $tab["estFini"],
            $tab["estValidee"],
            $tab["estSignee"]
        );
        $rep->mettreAJour($convention);
        ControllerGenerique::home();
    }
}