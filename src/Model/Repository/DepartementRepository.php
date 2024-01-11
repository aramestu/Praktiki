<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\AbstractDataObject;

/**
 * Repository pour la gestion des objets "Département" en base de données.
 */
class DepartementRepository extends AbstractRepository
{

    /**
     * Enregistre un objet "Département" en base de données.
     *
     * @param AbstractDataObject|Departement $departement L'objet à enregistrer.
     * @return bool True si l'enregistrement a réussi, false sinon.
     */
    public function save(AbstractDataObject|Departement $departement): bool
    {
        try {
            if ($this->getByNom($departement->getNomDepartement()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO Departements (nomDepartement) VALUES (:nomDepartementTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array(
                    "nomDepartementTag" => $departement->getNomDepartement()
                );
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Construit un objet "Département" à partir d'un tableau formaté.
     *
     * @param array $departementFormatTableau Le tableau formaté représentant l'objet.
     * @return Departement Objet "Département" construit.
     */
    public function construireDepuisTableau(array $departementFormatTableau): Departement
    {
        $departement = new Departement($departementFormatTableau["nomDepartement"]);
        if (isset($departementFormatTableau["codeDepartement"])) {
            $departement->setCodeDepartement($departementFormatTableau["codeDepartement"]);
        }

        return $departement;
    }

    /**
     * Récupère un département à partir de la base de données en utilisant le nom du département.
     *
     * @param string $nom Le nom du département à rechercher.
     * @return array|false Un tableau associatif représentant le département trouvé ou false s'il n'existe pas.
     */
    private function getDepuisTableau(string $nom): false|array
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM Departements WHERE nomDepartement = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" => $nom);
        $requestStatement->execute($values);
        return $requestStatement->fetch();
    }

    /**
     * Récupère un département par son nom.
     *
     * @param string $nom Le nom du département à rechercher.
     * @return Departement|null Objet "Département" ou null s'il n'existe pas.
     */
    public function getByNom(string $nom): ?Departement
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM Departements WHERE nomDepartement = :nomDepartementTag";
        $requestStatement = $pdo->prepare($sql);
        $values = array(
            "nomDepartementTag" => $nom
        );
        $requestStatement->execute($values);
        $tableauDepartement = $requestStatement->fetch();
        if ($tableauDepartement != null) {
            $departement = $this->construireDepuisTableau($tableauDepartement);
        } else {
            $departement = null;
        }
        return $departement;
    }

    /**
     * Retourne le nom de la clé primaire de la table associée à ce repository.
     *
     * @return string Nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "codeDepartement";
    }

    /**
     * Retourne le nom de la table associée à ce repository.
     *
     * @return string Nom de la table.
     */
    protected function getNomTable(): string
    {
        return "Departements";
    }

    /**
     * Retourne les noms des colonnes de la table associée à ce repository.
     *
     * @return array Tableau contenant les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array("codeDepartement", "nomDepartement");
    }
}