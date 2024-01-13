<?php

namespace App\SAE\Model\Repository;

use App\SAE\Controller\ControllerGenerique;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ContratsAlternance;

class ContratsAlternanceRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "ContratsAlternances";
    }

    public function construireDepuisTableau(array $objetFormatTableau): AbstractDataObject
    {
        return new ContratsAlternance($objetFormatTableau["numEtudiant"], $objetFormatTableau["idAnneeUniversitaire"]);
    }

    protected function getNomClePrimaire(): string
    {
        return "";
    }

    protected function getNomsColonnes(): array
    {
        return [];
    }
}