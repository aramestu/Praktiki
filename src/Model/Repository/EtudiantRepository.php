<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;

class EtudiantRepository extends AbstractRepository
{

    public static function inscrire(string $numEtudiant, string $nomDepartement, string $nomAnneeUniversitaire): bool
    {
        try {
            $pdo = Model::getPdo();
            $sql = "INSERT INTO Inscriptions 
            VALUES ( :numEtudiant, :idAnneeUniversitaire,:codeDepartement)";
            $requestStatement = $pdo->prepare($sql);
            $values = array(
                "numEtudiant" => $numEtudiant,
                "idAnneeUniversitaire" => (new AnneeUniversitaireRepository())->getByNom($nomAnneeUniversitaire)->getIdAnneeUniversitaire(),
                "codeDepartement" => (new DepartementRepository())->getByNom($nomDepartement)->getCodeDepartement());
            $requestStatement->execute($values);

            return true;
        } catch (\PDOException $e) {
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

    protected function getNomTable(): string
    {
        return "Etudiants";
    }

    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    protected function getNomsColonnes(): array
    {
        return array("numEtudiant", "nomEtudiant", "prenomEtudiant", "mailPersoEtudiant", "mailUniversitaireEtudiant", "telephoneEtudiant", "codePostalEtudiant");
    }
}
