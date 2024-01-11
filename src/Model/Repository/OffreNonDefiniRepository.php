<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

class OffreNonDefiniRepository extends  AbstractExperienceProfessionnelRepository {
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

    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idOffreNonDefini");
    }

    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new OffreNonDefini($expProFormatTableau["sujetExperienceProfessionnel"], $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"], $expProFormatTableau["niveauExperienceProfessionnel"], $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"], $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"], $expProFormatTableau["siret"], $expProFormatTableau["commentaireProfesseur"]);
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }
}
