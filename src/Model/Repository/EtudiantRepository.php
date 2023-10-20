<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Etudiant;

class EtudiantRepository extends AbstractRepository {

    public static function inscrire(Etudiant $etudiant, int $idAnneeUniversitaire, int $codeDepartement): bool{
        try{
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Inscriptions
                                                 VALUES(:numEtudiantTag, :idAnneeUniversitaireTag, :codeDepartementTag)");
            $values = array(
                "numEtudiantTag" => $etudiant->getNumEtudiant(),
                "idAnneeUniversitaireTag" => $idAnneeUniversitaire,
                "codeDepartementTag" => $codeDepartement
            );
            $requestStatement->execute($values);
            return true;
        }catch (\PDOException){
            return false;
        }
    }

    protected function construireDepuisTableau(array $EtudiantFormatTableau): Etudiant
    {
        $etudiant = new Etudiant($EtudiantFormatTableau["numEtudiant"], $EtudiantFormatTableau["prenomEtudiant"], $EtudiantFormatTableau["nomEtudiant"],
            $EtudiantFormatTableau["mailPersoEtudiant"], $EtudiantFormatTableau["mailUniversitaireEtudiant"], $EtudiantFormatTableau["telephoneEtudiant"],
            $EtudiantFormatTableau["codePostalEtudiant"]);
        return $etudiant;
    }

    protected function getNomTable(): string {
        return "Etudiants";
    }

    protected function getNomClePrimaire(): string {
        return "numEtudiant";
    }

    protected function getNomsColonnes(): array {
        return array("numEtudiant", "nomEtudiant", "prenomEtudiant", "mailPersoEtudiant", "mailUniversitaireEtudiant", "telephoneEtudiant", "codePostalEtudiant");
    }
}
