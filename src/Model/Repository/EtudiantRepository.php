<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;

class EtudiantRepository extends AbstractRepository
{

    public function getEtudiantAvecConventionValidee(): array
    {
        return $this->getEtudiantAvecConvention(true,true);
    }

    public function getEtudiantAvecConvention(bool $estSigne, bool $estValide): array{
        $sql = "SELECT * FROM Etudiants e 
                JOIN Conventions c ON c.idStage = e.idStage ";

        $whereAjoutee = false;
        $values = array();
        if($estSigne){
            $sql .= " WHERE c.estSigne = :estSigneTag";
            $values["estSigneTag"] = $estSigne;
        }
        else if($estValide){
            $sql .= " WHERE c.estValide = :estValideTag";
            $values["estValideTag"] = $estValide;
        }

        $request = Model::getPdo()->prepare($sql);

        $request->execute($values);

        $objects = [];
        foreach ($request as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

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

    public function search(string $keywords): array{
        $sql = "SELECT * FROM Etudiants
                WHERE ";
        $sql .= $this->colonneToSearch(array("numEtudiant", "nomEtudiant", "prenomEtudiant"));
        $values["keywordsTag"] = '%' . $keywords . '%';

        $request = Model::getPdo()->prepare($sql);
        $request->execute($values);
        $listeEtudiants = array();
        foreach ($request as $etudiantTab) {
            $listeEtudiants[] = $this->construireDepuisTableau($etudiantTab);
        }
        return $listeEtudiants;
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
