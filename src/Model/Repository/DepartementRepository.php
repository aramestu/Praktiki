<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\AbstractDataObject;

class DepartementRepository extends AbstractRepository
{

    public function save(AbstractDataObject|Departement $departement): bool
    {
        try {
            if ($this->getByNom($departement->getNomDepartement()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO Departements (nomDepartement) VALUES (:nomDepartementTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array(
                    "nomDepartementTag" => $departement->getNomDepartement()
                );
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected function construireDepuisTableau(array $departementFormatTableau): Departement
    {
        $departement = new Departement($departementFormatTableau["nomDepartement"]);
        if (isset($departementFormatTableau["codeDepartement"])) {
            $departement->setCodeDepartement($departementFormatTableau["codeDepartement"]);
        }

        return $departement;
    }

    private function getDepuisTableau(string $nom)
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM Departements WHERE nomDepartement = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" => $nom);
        $requestStatement->execute($values);
        $Departement = $requestStatement->fetch();
        return $Departement;
    }

    public function getByNom(string $nom): ?Departement
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM Departements WHERE nomDepartement = :nomDepartementTag";
        $requestStatement = $pdo->prepare($sql);
        $values = array(
            "nomDepartementTag" => $nom
        );
        $requestStatement->execute($values);
        $tableauDepartement = $requestStatement->fetch();
        if ($tableauDepartement != null) {
            $departement = $this->construireDepuisTableau($tableauDepartement);
        } else {
            $departement = null;
        }
        return $departement;
    }


    protected function getNomClePrimaire(): string
    {
        return "codeDepartement";
    }

    protected function getNomTable(): string
    {
        return "Departements";
    }

    protected function getNomsColonnes(): array
    {
        return array("codeDepartement", "nomDepartement");
    }
}