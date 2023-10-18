<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Departement;

class DepartementRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "Departements";
    }

    public function save (Departement $d) : bool
    {
        try {
            if ($this->get($d->getNomDepartement()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO Departements (nomDepartement) VALUES (:nomDepartementTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array("nomDepartementTag" => $d->getNomDepartement());
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function get(string $nom): ?Departement{
        $pdo = Model::getPdo();
        $sql= "SELECT count(*) FROM Departements WHERE nomDepartement = :nomDep";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomDep" =>$nom);
        $requestStatement->execute($values);
        $Departement = $requestStatement->fetchColumn();
        if($Departement==0){
            return null;
        }
        return $this->construireDepuisTableau($this->getDepuisTableau($nom));
    }

    protected function construireDepuisTableau(array $DepartementFormatTableau): Departement
    {
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


}