<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Enseignant;
class EnseignantRepository extends AbstractRepository
{
    public static function get(string $mail,$nom,$prenom): bool
    {
        try {
            $sql = "INSERT into Enseignants 
                             values ( :mailEnsei, :nomEnsei,:prenomEnsei)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "mailEnsei" => $mail,
                "nomEnsei" => $nom,
                "prenomEnsei" => $prenom);
            $pdoStatement->execute($values);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
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
