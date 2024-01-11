<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use Cassandra\Date;

class StageRepository extends AbstractExperienceProfessionnelRepository
{
    protected function getNomDataObject(): string
    {
        return "Stage";
    }

    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idStage","gratificationStage");
    }

    protected function getNomClePrimaire(): string
    {
        return "idStage";
    }

    protected function getNomTable(): string
    {
        return "Stages";
    }

    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new Stage($expProFormatTableau["sujetExperienceProfessionnel"], $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"], $expProFormatTableau["niveauExperienceProfessionnel"], $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"], $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"], $expProFormatTableau["siret"], $expProFormatTableau["gratificationStage"], $expProFormatTableau["commentaireProfesseur"]);
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }
}