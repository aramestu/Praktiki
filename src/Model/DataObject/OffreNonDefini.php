<?php
namespace App\SAE\Model\DataObject;
class OffreNonDefini extends ExperienceProfessionnel{
    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array());
    }

    public function getNomExperienceProfessionnel(): string
    {
        return "OffreNonDefini";
    }

}
