<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Etudiant;

class EtudiantRepository extends AbstractRepository
{

    public static function save(Etudiant $et): bool
    {
        try {
            $sql = "INSERT into Etudiants 
                             values ( :numEtu, :nomEtu,:prenomEtu,
                                     :mailPersoEtu,:mailUnivEtu, :telephoneEtu, :codePostalEtu)";

            $pdoStatement = Model::getPdo()->prepare($sql);
            $values = array(
                "numEtu" => $et->getNumEtudiant(),
                "nomEtu" => $et->getNomEtudiant(),
                "prenomEtu" => $et->getPrenomEtudiant(),
                "mailPersoEtu" => $et->getMailPersoEtudiant(),
                "mailUnivEtu" => $et->getMailUniversitaireEtuidant(),
                "telephoneEtu" => $et->getTelephoneEtudiant(),
                "codePostalEtu" => $et->getCodePostalEtudiant());
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
