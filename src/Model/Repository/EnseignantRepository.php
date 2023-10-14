<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Enseignant;
class EnseignantRepository extends AbstractRepository
{
    public static function get(string $id): ?Enseignant
    {
        $sql = "SELECT mailEnseignant
                FROM Enseignants
                WHERE mailEnseignant = :id";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $enseigant = $pdoStatement->fetch();
        if(!$enseigant)
            return null;
        return $enseigant;
    }

    protected function getNomTable(): string
    {
        return "Enseignants";
    }

    protected function construireDepuisTableau(array $enseignantFormatTableau): Enseignant
    {
        $enseignant = new Enseignant($enseignantFormatTableau["mailEnseignant"],$enseignantFormatTableau["nomEnseignant"], $enseignantFormatTableau["prenomEnseignant"]);
        return $enseignant;
    }
}