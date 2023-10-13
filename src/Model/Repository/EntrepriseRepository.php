<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;
class EntrepriseRepository extends AbstractRepository {

    public function get(string $siret): ?Entreprise{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("SELECT * FROM Entreprises
                                                 WHERE siret = :siretTag");
        $values = array("siretTag" =>$siret);
        $requestStatement->execute($values);
        $entrepriseTab = $requestStatement->fetch();
        if(!$entrepriseTab){
            return null;
        }
        return self::construireDepuisTableau($entrepriseTab);
    }

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["téléphoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"]);
        return $entreprise;
    }

    protected function getNomTable(): string {
        return "Entreprises";
    }
}