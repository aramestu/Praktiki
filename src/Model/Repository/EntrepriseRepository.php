<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;
class EntrepriseRepository extends AbstractRepository {

    public function get(string $siret): Entreprise{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("SELECT * FROM Entreprises
                                                 WHERE siret = :siretTag");
        $values = array("siretTag" =>$siret);
        $requestStatement->execute($values);
        return self::construireDepuisTableau($requestStatement->fetch());
    }

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"]);
        return $entreprise;
    }

    protected function getNomTable(): string {
        return "Entreprises";
    }
}