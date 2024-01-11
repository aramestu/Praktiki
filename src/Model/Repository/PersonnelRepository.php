<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Personnel;

class PersonnelRepository extends AbstractRepository
{

    public function construireDepuisTableau(array $personnelFormatTableau): Personnel
    {
        $personnel = new Personnel($personnelFormatTableau["mailPersonnel"], $personnelFormatTableau["nomPersonnel"], $personnelFormatTableau["prenomPersonnel"]);
        return $personnel;
    }

    public function getByEmail(string $valeurEmail): ?Personnel{
        $sql = "SELECT * from Personnels WHERE mailPersonnel = :EmailTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "EmailTag" => ConnexionUtilisateur::getLoginUtilisateurConnecte(),
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();

        if(!$objetFormatTableau){
            return null;
        }
        else{
            return (new PersonnelRepository())->construireDepuisTableau($objetFormatTableau);
        }
    }

    protected function getNomTable(): string
    {
        return "Personnels";
    }

    protected function getNomClePrimaire(): string
    {
        return "mailPersonnel";
    }

    protected function getNomsColonnes(): array
    {
        return array("mailPersonnel", "nomPersonnel", "prenomPersonnel");
    }
}
