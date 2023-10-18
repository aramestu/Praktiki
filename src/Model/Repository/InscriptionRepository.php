<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Inscription;

class InscriptionRepository extends AbstractRepository
{


    public static function save(Inscription $i): bool
    {
        try {
            $pdo = Model::getPdo();
            if((new AnneeUniversitaireRepository())->save(new AnneeUniversitaire(1, $i->getIdAnneeUniversitaire()))){
                $annee=$pdo->lastInsertId();
            }else{
                $annee=self::getIdAnnee($i->getIdAnneeUniversitaire());
            }
            if((new DepartementRepository())->save(new Departement(1, $i->getCodeDepartement()))){
                $dep = $pdo->lastInsertId();
            }else{
                $dep=self::getIdDep($i->getCodeDepartement());
            }
            $sql="INSERT into Inscriptions values ( :numEtudiant, :idAnneeUniversitaire,:codeDepartement)";
            $requestStatement = $pdo->prepare($sql);
            $values = array(
                "numEtudiant" => $i->getNumEtudiant(),
                "idAnneeUniversitaire" => $annee,
                "codeDepartement" => $dep);
            $requestStatement->execute($values);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function getIdDep($nomDepartement){
        $pdo = Model::getPdo();
        $sqlDepartement = "SELECT idDepartement FROM Departement WHERE nomDepartement = :nomDepartement";
        $stmtDepartement = $pdo->prepare($sqlDepartement);
        $stmtDepartement->execute(array("nomDepartement" => $nomDepartement));
        $idDepartement = $stmtDepartement->fetchColumn();
        return $idDepartement;
    }

    public static function getIdAnnee($anneeUniversitaire){
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


}