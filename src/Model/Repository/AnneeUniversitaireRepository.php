<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\AbstractDataObject;
/**
 * Repository pour la gestion des objets "AnneeUniversitaire" en base de données.
 */
class AnneeUniversitaireRepository extends AbstractRepository
{
    /**
     * Construit un objet "AnneeUniversitaire" à partir d'un tableau formaté.
     *
     * @param array $anneeUniversitaireFormatTableau Le tableau formaté représentant l'objet.
     * @return AnneeUniversitaire Objet "AnneeUniversitaire" construit.
     */
    public function construireDepuisTableau(array $anneeUniversitaireFormatTableau): AnneeUniversitaire{
        $anneeUniversitaire = new AnneeUniversitaire($anneeUniversitaireFormatTableau["nomAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateFinAnneeUniversitaire"], $anneeUniversitaireFormatTableau["dateDebutAnneeUniversitaire"]);

        if (isset($anneeUniversitaireFormatTableau["idAnneeUniversitaire"])) {
            $anneeUniversitaire->setIdAnneeUniversitaire($anneeUniversitaireFormatTableau["idAnneeUniversitaire"]);
        }

        return $anneeUniversitaire;
    }

    /**
     * Enregistre un objet "AnneeUniversitaire" en base de données.
     *
     * @param AbstractDataObject|AnneeUniversitaire $anneeUniversitaire L'objet à enregistrer.
     * @return bool True si l'enregistrement a réussi, false sinon.
     */
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

    /**
     * Récupère un objet "AnneeUniversitaire" par son nom.
     *
     * @param string $nom Le nom de l'année universitaire.
     * @return AnneeUniversitaire|null L'objet "AnneeUniversitaire" correspondant, ou null s'il n'existe pas.
     */

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

    /**
     * Récupère l'année universitaire en cours.
     *
     * @return AnneeUniversitaire|null L'objet "AnneeUniversitaire" en cours, ou null s'il n'y en a pas.
     */
    public function getCurrentAnneeUniversitaire(): ?AnneeUniversitaire {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM AnneeUniversitaire
                WHERE dateDebutAnneeUniversitaire = (SELECT MAX(dateDebutAnneeUniversitaire) FROM (SELECT * FROM AnneeUniversitaire
                                                                                                   WHERE dateDebutAnneeUniversitaire <= :currentDateTag) as A2)";
        $requestStatement = $pdo->prepare($sql);
        $values = [
            "currentDateTag" => date("Y-m-d")
        ];
        $requestStatement->execute($values);
        $tableauAnneeUniversitaire = $requestStatement->fetch();
        if ($tableauAnneeUniversitaire != null) {
            $anneeUniversitaire = $this->construireDepuisTableau($tableauAnneeUniversitaire);
        } else {
            $anneeUniversitaire = null;
        }
        return $anneeUniversitaire;
    }

    /**
     * Retourne le nom de la table associée à ce repository.
     *
     * @return string Nom de la table.
     */
    protected function getNomTable(): string
    {
        return "AnneeUniversitaire";
    }

    /**
     * Retourne le nom de la clé primaire de la table associée à ce repository.
     *
     * @return string Nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "idAnneeUniversitaire";
    }

    /**
     * Retourne les noms des colonnes de la table associée à ce repository.
     *
     * @return array Tableau contenant les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array("idAnneeUniversitaire", "nomAnneeUniversitaire", "dateFinAnneeUniversitaire", "dateDebutAnneeUniversitaire");
    }
}