<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Etudiant;

class EtudiantRepository extends AbstractRepository
{

    public static function get(string $mail,$prenom,$nom,$mailPerso,$mailUniv,$telephone,$codePostal): bool
    {
        try {
            $sql = "INSERT into Etudiants 
                             values ( :mailEtu, :nomEtu,:prenomEtu,
                                     :mailPersoEtu,:mailUnivEtu, :telephoneEtu, :codePostalEtu)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "mailEtu" => $mail,
                "nomEtu" => $nom,
                "prenomEtu" => $prenom,
                "mailPersoEtu" => $mailPerso,
                "mailUnivEtu" => $mailUniv,
                "telephoneEtu" => $telephone,
                "codePostalEtu" => $codePostal);
            $pdoStatement->execute($values);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    protected function getNomTable(): string
    {
        return "Etudiant";
    }

    protected function construireDepuisTableau(array $EtudiantFormatTableau): Etudiant
    {
        $etudiant = new Etudiant($EtudiantFormatTableau["mailEtudiant"], $EtudiantFormatTableau["prenomEtudiant"], $EtudiantFormatTableau["nomEtudiant"],
            $EtudiantFormatTableau["mailPersoEtudiant"], $EtudiantFormatTableau["mailUniversitaireEtuidant"], $EtudiantFormatTableau["telephoneEtudiant"],
            $EtudiantFormatTableau["codePostalEtudiant"]);
        return $etudiant;
    }
}
