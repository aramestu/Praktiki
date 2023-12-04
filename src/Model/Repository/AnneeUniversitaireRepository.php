<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\AbstractDataObject;

class AnneeUniversitaireRepository extends AbstractRepository{

    public function construireDepuisTableau(array $anneeUniversitaireFormatTableau): AnneeUniversitaire{
        $anneeUniversitaire = new AnneeUniversitaire($anneeUniversitaireFormatTableau["nomAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateFinAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateDebutAnneeUniversitaire"]);

        if (isset($anneeUniversitaireFormatTableau["idAnneeUniversitaire"])) {
            $anneeUniversitaire->setIdAnneeUniversitaire($anneeUniversitaireFormatTableau["idAnneeUniversitaire"]);
        }

        return $anneeUniversitaire;
    }

    public function save(AbstractDataObject|AnneeUniversitaire $anneeUniversitaire): bool {
        try {
            if ($this->getByNom($anneeUniversitaire->getNomAnneeUniversitaire()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO AnneeUniversitaire (nomAnneeUniversitaire,dateFinAnneeUniversitaire,dateDebutAnneeUniversitaire) VALUES (:nomAnneeUniversitaireTag , :dateFinAnneeUniversitaireTag , :dateDebutAnneeUniversitaireTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array(
                    "nomAnneeUniversitaireTag" => $anneeUniversitaire->getNomAnneeUniversitaire(),
                    "dateFinAnneeUniversitaire" => $anneeUniversitaire->getDateFinAnneeUniversitaire(),
                    "dateDebutAnneeUniversitaire" => $anneeUniversitaire->getDateDebutAnneeUniversitaire()
                );
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function getByNom(string $nom): ?AnneeUniversitaire
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" => $nom);
        $requestStatement->execute($values);
        $tableauAnneeUniversitaire = $requestStatement->fetch();
        if ($tableauAnneeUniversitaire != null) {
            $anneeUniversitaire = $this->construireDepuisTableau($tableauAnneeUniversitaire);
        } else {
            $anneeUniversitaire = null;
        }
        return $anneeUniversitaire;
    }

    protected function getNomTable(): string
    {
        return "AnneeUniversitaire";
    }

    protected function getNomClePrimaire(): string
    {
        return "idAnneeUniversitaire";
    }

    protected function getNomsColonnes(): array
    {
        return array("idAnneeUniversitaire", "nomAnneeUniversitaire", "dateFinAnneeUniversitaire", "dateDebutAnneeUniversitaire");
    }
}