<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Stage;

class ExperienceProfessionnelRepository extends AbstractRepository {

    protected function getNomTable(): string
    {
        return "";
    }

    protected function construireDepuisTableau(array $objetFormatTableau): AbstractDataObject
    {
        return new Stage();
    }

    protected function getNomClePrimaire(): string
    {
        return "";
    }

    protected function getNomsColonnes(): array
    {
        return array();
    }
}