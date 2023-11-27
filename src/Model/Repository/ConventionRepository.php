<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Convention;

class ConventionRepository extends AbstractRepository {

    protected function getNomTable(): string{
        return "Conventions";
    }

    protected function construireDepuisTableau(array $conventionFormatTableau): Convention {
        $convention =  new Convention($conventionFormatTableau["mailEnseignant"], $conventionFormatTableau["nomEnseignant"],
                                    $conventionFormatTableau["prenomEnseignant"], $conventionFormatTableau["competencesADevelopper"],
                                    $conventionFormatTableau["dureeDeTravail"], $conventionFormatTableau["languesImpression"],
                                    $conventionFormatTableau["origineDeLaConvention"], $conventionFormatTableau["sujetEstConfidentiel"],
                                    $conventionFormatTableau["nbHeuresHebdo"], $conventionFormatTableau["modePaiement"],
                                    $conventionFormatTableau["dureeExperienceProfessionnel"], $conventionFormatTableau["caisseAssuranceMaladie"],
                                    $conventionFormatTableau["mailTuteurProfessionnel"], $conventionFormatTableau["prenomTuteurProfessionnel"],
                                    $conventionFormatTableau["nomTuteurProfessionnel"], $conventionFormatTableau["fonctionTuteurProfessionnel"],
                                    $conventionFormatTableau["telephoneTuteurProfessionnel"], $conventionFormatTableau["sujetExperienceProfessionnel"],
                                    $conventionFormatTableau["thematiqueExperienceProfessionnel"], $conventionFormatTableau["tachesExperienceProfessionnel"],
                                    $conventionFormatTableau["codePostalExperienceProfessionnel"], $conventionFormatTableau["adresseExperienceProfessionnel"],
                                    $conventionFormatTableau["dateDebutExperienceProfessionnel"], $conventionFormatTableau["dateFinExperienceProfessionnel"],
                                    $conventionFormatTableau["nomSignataire"], $conventionFormatTableau["prenomSignataire"],
                                    $conventionFormatTableau["siret"], $conventionFormatTableau["nomEntreprise"],
                                    $conventionFormatTableau["codePostalEntreprise"], $conventionFormatTableau["effectifEntreprise"],
                                    $conventionFormatTableau["telephoneEntreprise"], $conventionFormatTableau["estFini"],
                                    $conventionFormatTableau["estValidee"]);
        if(isset($conventionFormatTableau["idConvention"])){
            $convention->setIdConvention($conventionFormatTableau["idConvention"]);
        }
        return $convention;
    }

    protected function getNomClePrimaire(): string
    {
        return "idConvention";
    }

    protected function getNomsColonnes(): array
    {
        return array("idConvention", "mailEnseignant", "nomEnseignant", "prenomEnseignant",
            "competencesADevelopper", "dureeDeTravail", "languesImpression", "origineDeLaConvention",
            "sujetEstConfidentiel", "nbHeuresHebdo", "modePaiement", "dureeExperienceProfessionnel",
            "caisseAssuranceMaladie", "mailTuteurProfessionnel", "prenomTuteurProfessionnel",
            "nomTuteurProfessionnel", "fonctionTuteurProfessionnel", "telephoneTuteurProfessionnel",
            "sujetExperienceProfessionnel", "thematiqueExperienceProfessionnel", "tachesExperienceProfessionnel",
            "codePostalExperienceProfessionnel", "adresseExperienceProfessionnel", "dateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel", "nomSignataire", "prenomSignataire", "siret", "nomEntreprise",
            "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "estFini", "estValidee");
    }

    public function save(AbstractDataObject|Convention $convention): bool
    {
        try {
            $pdo = Model::getPdo();
            $sql = "INSERT INTO Conventions (competencesADevelopper, dureeDeTravail, languesImpression, origineDeLaConvention, 
                         sujetEstConfidentiel, nbHeuresHebdo, modePaiement, dureeExperienceProfessionnel, caisseAssuranceMaladie, 
                         mailTuteurProfessionnel, prenomTuteurProfessionnel, nomTuteurProfessionnel, fonctionTuteurProfessionnel, 
                         telephoneTuteurProfessionnel, sujetExperienceProfessionnel, thematiqueExperienceProfessionnel, 
                         tachesExperienceProfessionnel, codePostalExperienceProfessionnel, adresseExperienceProfessionnel, 
                         dateDebutExperienceProfessionnel, dateFinExperienceProfessionnel, nomSignataire, prenomSignataire, 
                         siret, nomEntreprise, codePostalEntreprise, effectifEntreprise, telephoneEntreprise, estValidee, 
                         estFini, mailEnseignant, nomEnseignant, prenomEnseignant) 
                    VALUES (:competencesADevelopperTag, :dureeDeTravailTag, :languesImpressionTag, :origineDeLaConventionTag, :sujetEstConfidentielTag,
                            :nbHeuresHebdoTag, :modePaiementTag, :dureeExperienceProfessionnelTag, :caisseAssuranceMaladieTag, :mailTuteurProfessionnelTag,
                            :prenomTuteurProfessionnel, :nomTuteurProfessionnel, :fonctionTuteurProfessionnel, :telephoneTuteurProfessionnel,
                            :sujetExperienceProfessionnel, :thematiqueExperienceProfessionnel, :tachesExperienceProfessionnel,
                            :codePostalExperienceProfessionnel, :adresseExperienceProfessionnel, :dateDebutExperienceProfessionnel, :dateFinExperienceProfessionnelTag, 
                            :nomSignataire, :prenomSignataireTag, :siretTag, :nomEntrepriseTag, :codePostalEntreprise, :effectifEntreprise, 
                            :telephoneEntreprise, :estValidee, :estFini, :mailEnseignant, :nomEnseignant, :prenomEnseignant)";
            $requestStatement = $pdo->prepare($sql);
            $values = $convention->formatTableau();
            unset($values["idConvention"]);
            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


}