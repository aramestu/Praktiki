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


    public static function save(Entreprise $en): bool
    {
        try {
            $sql = "INSERT into Entreprises 
                             values ( :siret, :nomEnt,:CodePostal,
                                     :effectif,:telEnt, :siteEnt)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "siret" => $en->getSiret(),
                "nomEnt" => $en->getNom(),
                "CodePostal" => $en->getCodePostal(),
                "effectif" => $en->getEffectif(),
                "telEnt" => $en->getTelephone(),
                "siteEnt" => $en->getSiteWeb());
            $pdoStatement->execute($values);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"]);
        return $entreprise;
    }

    protected function getNomTable(): string {
        return "Entreprises";
    }
}