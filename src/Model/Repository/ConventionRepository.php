<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Convention;
use PDO;

class ConventionRepository extends AbstractRepository {

    protected function getNomTable(): string{
        return "Conventions";
    }

    public function construireDepuisTableau(array $conventionFormatTableau): Convention {
        if (!isset($conventionFormatTableau["sujetEstConfidentiel"])) {
            $conventionFormatTableau["sujetEstConfidentiel"] = false;
        }
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
                                    $conventionFormatTableau["estValidee"], $conventionFormatTableau["estSignee"]);
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
            "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "estFini", "estValidee", "estSignee");
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
                         estFini, mailEnseignant, nomEnseignant, prenomEnseignant, estSignee) 
                    VALUES (:competencesADevelopperTag, :dureeDeTravailTag, :languesImpressionTag, :origineDeLaConventionTag, :sujetEstConfidentielTag,
                            :nbHeuresHebdoTag, :modePaiementTag, :dureeExperienceProfessionnelTag, :caisseAssuranceMaladieTag, :mailTuteurProfessionnelTag,
                            :prenomTuteurProfessionnelTag, :nomTuteurProfessionnelTag, :fonctionTuteurProfessionnelTag, :telephoneTuteurProfessionnelTag,
                            :sujetExperienceProfessionnelTag, :thematiqueExperienceProfessionnelTag, :tachesExperienceProfessionnelTag,
                            :codePostalExperienceProfessionnelTag, :adresseExperienceProfessionnelTag, :dateDebutExperienceProfessionnelTag, :dateFinExperienceProfessionnelTag, 
                            :nomSignataireTag, :prenomSignataireTag, :siretTag, :nomEntrepriseTag, :codePostalEntrepriseTag, :effectifEntrepriseTag, 
                            :telephoneEntrepriseTag, :estValideeTag, :estFiniTag, :mailEnseignantTag, :nomEnseignantTag, :prenomEnseignantTag, :estSigneeTag)";
            $requestStatement = $pdo->prepare($sql);
            $values = $convention->formatTableau();
            unset($values["idConventionTag"]);
            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function archiver(string $valeurClePrimaire): void
    {
        //TODO : a tester lorsque la supression sera possible
        parent::archiver($valeurClePrimaire);
        $pdo = Model::getPdo();
        $table = "ConventionStageEtudiant";
        $tableArchives = "ConventionStageEtudiantArchives";
        $clePrimaire = "idConvention";
        $sql = "INSERT INTO $tableArchives SELECT * FROM $table WHERE $table.$clePrimaire = :clePrimaireTag";
        $values = array("clePrimaireTag" => $valeurClePrimaire);
        $requeteStatement = $pdo->prepare($sql);
        $requeteStatement->execute($values);
    }

    public function getConventionAvecEtudiant(string $idEtudiant) : ?Convention{
        $sql = "SELECT * FROM ConventionsStageEtudiant cse
                JOIN Conventions c ON c.idConvention = cse.idConvention
                WHERE cse.numEtudiant = :numEtudiantTag
                AND cse.idAnneeUniversitaire = 3";

        $values = [
            "numEtudiantTag" => $idEtudiant
        ];

        $pdoStatement = Model::getPdo()->prepare($sql);
        $pdoStatement->execute($values);
        $result = $pdoStatement->fetch();
        if(!$result){
            return null;
        }
        return $this->construireDepuisTableau($result);
    }
}