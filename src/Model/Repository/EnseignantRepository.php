<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Enseignant;

class EnseignantRepository extends AbstractRepository
{

    protected function construireDepuisTableau(array $enseignantFormatTableau): Enseignant
    {
        $enseignant = new Enseignant($enseignantFormatTableau["mailEnseignant"], $enseignantFormatTableau["nomEnseignant"], $enseignantFormatTableau["prenomEnseignant"],$enseignantFormatTableau["estAdmin"]);
        return $enseignant;
    }

    protected function getNomTable(): string
    {
        return "Enseignants";
    }

    protected function getNomClePrimaire(): string
    {
        return "mailEnseignant";
    }

    protected function getNomsColonnes(): array
    {
        return array("mailEnseignant", "nomEnseignant", "prenomEnseignant", "estAdmin");
    }
}
