<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;

class AnneeUniversitaireRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "AnneeUniversitaire";
    }

    public static function lastAnneeUniversitaire() : int{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("SELECT MAX(idAnneeUniversitaire) FROM AnneeUniversitaire");
        $requestStatement->execute();
        $result = $requestStatement->fetch();
        return $result[0];
    }

    protected function construireDepuisTableau(array $AnneeUniversitaireFormatTableau): AnneeUniversitaire
    {
        $AnneeUniversitaire = new AnneeUniversitaire($AnneeUniversitaireFormatTableau["idAnneeUniversitaire"],
            $AnneeUniversitaireFormatTableau["nomAnneeUniversitaire"]);

        return $AnneeUniversitaire;
    }
}