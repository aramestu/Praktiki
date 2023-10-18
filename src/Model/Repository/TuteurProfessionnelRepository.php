<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\TuteurProfessionnel;

class TuteurProfessionnelRepository extends AbstractRepository
{

    public static function save(TuteurProfessionnel $t): bool
    {
        try {
            $sql = "INSERT into TuteurProfessionnel 
                             values ( :mailtuteur, :prenomtuteur, :nomtuteur, :fonctiontuteur, :telephonetuteur)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "mailtuteur" => $t->getMailTuteurProfessionnel(),
                "prenomtuteur" => $t->getPrenomTuteurProfessionnel(),
                "nomtuteur" => $t->getNomTuteurProfessionnel(),
                "fonctiontuteur" => $t->getFonctionTuteurProfessionnel(),
                "telephonetuteur" => $t->getTelephoneTuteur());
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
