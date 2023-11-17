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
        return new Convention($conventionFormatTableau["idConvention"], $conventionFormatTableau["idStage"], $conventionFormatTableau["competencesADevelopper"],
        $conventionFormatTableau["dureeDeTravail"], $conventionFormatTableau["languesImpression"], $conventionFormatTableau["origineDeLaConvention"], $conventionFormatTableau["sujetEstConfidentiel"],
        $conventionFormatTableau["nbHeuresHebdo"], $conventionFormatTableau["modePaiement"], $conventionFormatTableau["dureeExperienceProfessionnel"], $conventionFormatTableau["caisseAssuranceMaladie"],
        $conventionFormatTableau["estSignee"], $conventionFormatTableau["estValidee"]);
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
            $pdo = Model::getPdo();
            $sql = "INSERT INTO Conventions (idStage) VALUES (:idStageTag)";
            $requestStatement = $pdo->prepare($sql);
            $values = array(
                "idStageTag" => $convention->getIdStage()
            );
            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


}