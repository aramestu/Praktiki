<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\TuteurProfessionnel;

class TuteurProfessionnelRepository extends AbstractRepository
{
    public static function get(string $id): ?TuteurProfessionnel
    {
        $sql = "SELECT mailTuteurProfessionnel
                FROM TuteurProfessionnel
                WHERE mailTuteurProfessionnel = :id";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $tuteur = $pdoStatement->fetch();
        if(!$tuteur)
            return null;
        return $tuteur;
    }

    protected function getNomTable(): string
    {
        return "TuteurProfessionnel";
    }

    protected function construireDepuisTableau(array $TuteurProfessionnelFormatTableau): TuteurProfessionnel
    {
        $tuteur = new TuteurProfessionnel($TuteurProfessionnelFormatTableau["mailTuteurProfessionnel"],$TuteurProfessionnelFormatTableau["prenomTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["nomTuteurProfessionnel"],
        $TuteurProfessionnelFormatTableau["fonctionTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["telephoneTuteur"]);
        return $tuteur;
    }
}
