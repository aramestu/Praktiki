<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Inscription;

class InscriptionRepository extends AbstractRepository
{

    public static function getIdDep($nomDepartement)
    {
        $pdo = Model::getPdo();
        $sqlDepartement = "SELECT codeDepartement FROM Departements WHERE nomDepartement = :nomDepartement";
        $stmtDepartement = $pdo->prepare($sqlDepartement);
        $stmtDepartement->execute(array("nomDepartement" => $nomDepartement));
        $idDepartement = $stmtDepartement->fetchColumn();
        return $idDepartement;
    }

    public static function getIdAnnee($anneeUniversitaire)
    {
        $pdo = Model::getPdo();
        $sqlAnnee = "SELECT idAnneeUniversitaire FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $stmtAnnee = $pdo->prepare($sqlAnnee);
        $stmtAnnee->execute(array("nomAnnee" => $anneeUniversitaire));
        $idAnneeUniversitaire = $stmtAnnee->fetchColumn();
        return $idAnneeUniversitaire;

    }

    protected function construireDepuisTableau(array $InscriptionFormatTableau): Inscription
    {
        $Inscription = new Inscription($InscriptionFormatTableau["numEtudiant"],
            $InscriptionFormatTableau["idAnneeUniversitaire"], $InscriptionFormatTableau["codeDepartement"]);
        return $Inscription;
    }

    protected function getNomTable(): string
    {
        return "Inscriptions";
    }


    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    protected function getNomsColonnesCommunes(): array
    {
        return array("numEtudiant", "idAnneeUniversitaire", "codeDepartement");
    }
}