<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

class AlternanceRepository extends AbstractExperienceProfessionnelRepository
{
    protected function getNomDataObject(): string
    {
        return "Alternance";
    }
    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idAlternance");
    }

    protected function getNomClePrimaire(): string
    {
        return "idAlternance";
    }

    protected function getNomTable(): string
    {
        return "Alternances";
    }

    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new Alternance($expProFormatTableau["sujetExperienceProfessionnel"], $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"], $expProFormatTableau["niveauExperienceProfessionnel"], $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"], $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"], $expProFormatTableau["siret"], $expProFormatTableau["commentaireProfesseur"]);
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }
}