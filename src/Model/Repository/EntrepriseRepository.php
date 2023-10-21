<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;
class EntrepriseRepository extends AbstractRepository {

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"], $entrepriseFormatTableau["estValide"]);
        return $entreprise;
    }

    protected function getNomTable(): string {
        return "Entreprises";
    }

    protected function getNomClePrimaire(): string {
        return "siret";
    }

    protected function getNomsColonnes(): array {
        return array("siret", "nomEntreprise", "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "siteWebEntreprise", "estValide");
    }
}