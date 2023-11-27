<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\AbstractDataObject;

class AnneeUniversitaireRepository extends AbstractRepository{

    protected function construireDepuisTableau(array $anneeUniversitaireFormatTableau): AnneeUniversitaire{
        $anneeUniversitaire = new AnneeUniversitaire($anneeUniversitaireFormatTableau["nomAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateFinAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateDebutAnneeUniversitaire"]);

        if (isset($anneeUniversitaireFormatTableau["idAnneeUniversitaire"])) {
            $anneeUniversitaire->setIdAnneeUniversitaire($anneeUniversitaireFormatTableau["idAnneeUniversitaire"]);
        }

        return $anneeUniversitaire;
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

    protected function getNomsColonnesCommunes(): array
    {
        return array("idAnneeUniversitaire", "nomAnneeUniversitaire", "dateFinAnneeUniversitaire", "dateDebutAnneeUniversitaire");
    }
}