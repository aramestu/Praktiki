<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\TuteurProfessionnel;

class TuteurProfessionnelRepository extends AbstractRepository
{

    public static function get(string $mail,$prenom,$nom,$fonction,$telephone): bool
    {
        try {
            $sql = "INSERT into TuteurProfessionnel 
                             values ( :mailtuteur, :prenomtuteur, :nomtuteur, :fonctiontuteur, :telephonetuteur)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "mailtuteur" => $mail,
                "prenomtuteur" => $prenom,
                "nomtuteur" => $nom,
                "fonctiontuteur" => $fonction,
                "telephonetuteur" => $telephone);
            $pdoStatement->execute($values);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    protected function getNomTable(): string
    {
        return "TuteurProfessionnel";
    }

    protected function construireDepuisTableau(array $TuteurProfessionnelFormatTableau): TuteurProfessionnel
    {
        $tuteur = new TuteurProfessionnel($TuteurProfessionnelFormatTableau["mailTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["prenomTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["nomTuteurProfessionnel"],
            $TuteurProfessionnelFormatTableau["fonctionTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["telephoneTuteur"]);
        return $tuteur;
    }
}
