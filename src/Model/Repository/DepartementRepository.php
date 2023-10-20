<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\AbstractDataObject;

class DepartementRepository extends AbstractRepository{

    public function save (AbstractDataObject|Departement $departement) : bool
    {
        try {
            if ($this->get($departement->getNomDepartement()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO Departements (nomDepartement) VALUES (:nomDepartementTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array("nomDepartementTag" => $departement->getNomDepartement());
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected function construireDepuisTableau(array $DepartementFormatTableau): Departement {
        $Departement = new Departement($DepartementFormatTableau["codeDepartement"],
            $DepartementFormatTableau["nomDepartement"]);

        return $Departement;
    }

    private function getDepuisTableau(string $nom)
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM Departements WHERE nomDepartement = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" =>$nom);
        $requestStatement->execute($values);
        $Departement = $requestStatement->fetch();
        return $Departement;
    }


    protected function getNomClePrimaire(): string {
        return "codeDepartement";
    }

    protected function getNomTable(): string
    {
        return "Departements";
    }

    protected function getNomsColonnes(): array {
        return array("codeDepartement", "nomDepartement");
    }
}