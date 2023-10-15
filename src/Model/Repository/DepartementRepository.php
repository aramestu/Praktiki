<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Departement;

class DepartementRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "Departements";
    }

    public static function lastDepartement() : int{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("SELECT MAX(codeDepartement) FROM Departements");
        $requestStatement->execute();
        $result = $requestStatement->fetch();
        return $result[0];
    }

    protected function construireDepuisTableau(array $DepartementFormatTableau): Departement
    {
        $Departement = new Departement($DepartementFormatTableau["codeDepartement"],
            $DepartementFormatTableau["nomDepartement"]);

        return $Departement;
    }
}