<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

class OffreNonDefiniRepository extends  ExperienceProfessionnelRepository{
    protected function getNomDataObject(): string
    {
        return "OffreNonDefini";
    }

    protected function getNomClePrimaire(): string
    {
        return "idOffreNonDefini";
    }

    protected function getNomTable(): string
    {
        return "OffreNonDefini";
    }
}
