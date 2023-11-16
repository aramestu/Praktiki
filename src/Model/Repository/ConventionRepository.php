<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Convention;

class ConventionRepository extends AbstractRepository {

    protected function getNomTable(): string
    {
        return "Conventions";
    }

    protected function construireDepuisTableau(array $conventionFormatTableau): Convention
    {
        $convention = new Convention($conventionFormatTableau["idConvention"], $conventionFormatTableau["idStage"], $conventionFormatTableau["competencesADevelopper"],
        $conventionFormatTableau["dureeDeTravail"], $conventionFormatTableau["languesImpression"], $conventionFormatTableau["origineDeLaConvention"], $conventionFormatTableau["sujetEstConfidentiel"],
        $conventionFormatTableau["nbHeuresHebdo"], $conventionFormatTableau["modePaiement"], $conventionFormatTableau["dureeExperienceProfessionnel"], $conventionFormatTableau["caisseAssuranceMaladie"],
        $conventionFormatTableau["estSignee"], $conventionFormatTableau["estValidee"]);
        return $convention;
    }

    protected function getNomClePrimaire(): string
    {
        return "idConvention";
    }

    protected function getNomsColonnes(): array
    {
        return array("idConvention", "idStage", "CompetencesADevelopper", "dureeDeTravail", "languesImpression", "origineDeLaConvention", "sujetEstConfidentiel", "nbHeuresHebdo", "modePaiement", "dureeExperienceProfessionnel", "caisseAssuranceMaladie", "estSignee", "estValidee");
    }

    public function save(AbstractDataObject|Convention $convention): bool
    {
        try {
            if ($this->getById($convention->getIdConvention()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO Conventions (CompetencesADevelopper) VALUES (NULL)";
                $requestStatement = $pdo->prepare($sql);
                $requestStatement->execute();
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }
}