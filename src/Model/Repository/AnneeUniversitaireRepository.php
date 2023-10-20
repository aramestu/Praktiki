<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\AbstractDataObject;

class AnneeUniversitaireRepository extends AbstractRepository {

    public function save(AbstractDataObject|AnneeUniversitaire $anneeUniversitaire): bool
    {
        try {
            if ($this->get($anneeUniversitaire->getNomAnneeUniversitaire()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO AnneeUniversitaire (nomAnneeUniversitaire) VALUES (:nomAnneeUniversitaireTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array("nomAnneeUniversitaireTag" => $anneeUniversitaire->getNomAnneeUniversitaire());
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    protected function construireDepuisTableau(array $anneeUniversitaireFormatTableau): AnneeUniversitaire
    {
        $anneeUniversitaire = new AnneeUniversitaire($anneeUniversitaireFormatTableau["idAnneeUniversitaire"],
            $anneeUniversitaireFormatTableau["nomAnneeUniversitaire"]);

        return $anneeUniversitaire;
    }

    private function getByNom(string $nom){
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" =>$nom);
        $requestStatement->execute($values);
        $anneeUniversitaire = $requestStatement->fetch();
        return $anneeUniversitaire;
    }

    protected function getNomTable(): string {
        return "AnneeUniversitaire";
    }

    protected function getNomClePrimaire(): string {
        return "idAnneeUniversitaire";
    }

    protected function getNomsColonnes(): array {
        return array("idAnneeUniversitaire", "nomAnneeUniversitaire");
    }
}