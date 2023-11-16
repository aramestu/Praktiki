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
        $convention = new Convention($conventionFormatTableau["idConvention"], $conventionFormatTableau["competencesADevelopper"], $conventionFormatTableau["langueImpression"],
        $conventionFormatTableau["dureeStage"], $conventionFormatTableau["nbHeuresHebdo"], $conventionFormatTableau["modePaiement"], $conventionFormatTableau["estSignee"]);
        return $convention;
    }

    protected function getNomClePrimaire(): string
    {
        return "idConvention";
    }

    protected function getNomsColonnes(): array
    {
        return array("idConvention", "CompetencesADevelopper", "langueImpression", "dureeStage", "nbHeuresHebdo", "modePaiement", "estSignee");
    }
}