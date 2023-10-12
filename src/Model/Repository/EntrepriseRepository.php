<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;
class EntrepriseRepository {

    public function get(string $siret): Entreprise{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("SELECT * FROM Entreprises
                                                 WHERE siret = :siretTag");
        $values = array("siretTag" =>$siret);
        $requestStatement->execute($values);
        return self::construireDepuisTableau($requestStatement->fetch());
    }

    public function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"]);
        return $entreprise;
    }

}