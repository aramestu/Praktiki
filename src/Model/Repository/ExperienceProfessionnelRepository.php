<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;

class ExperienceProfessionnelRepository extends  AbstractExperienceProfessionnelRepository {

    protected function getNomsColonnesSupplementaires(): array
    {
        return array();
    }

    protected function getNomDataObject(): string
    {
        return "";
    }

    public function construireDepuisTableau(array $objetFormatTableau): ExperienceProfessionnel
    {
        return new Stage();
    }
}