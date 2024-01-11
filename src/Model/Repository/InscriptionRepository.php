<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Inscription;

/**
 * Repository cocernant les inscriptions
 */

class InscriptionRepository extends AbstractRepository
{

    /**
     * Obtient l'identifiant du département en fonction de son nom.
     *
     * @param string $nomDepartement Le nom du département.
     * @return int L'identifiant du département.
     */
    public static function getIdDep(string $nomDepartement): int
    {
        $pdo = Model::getPdo();
        $sqlDepartement = "SELECT codeDepartement FROM Departements WHERE nomDepartement = :nomDepartement";
        $stmtDepartement = $pdo->prepare($sqlDepartement);
        $stmtDepartement->execute(array("nomDepartement" => $nomDepartement));
        $idDepartement = $stmtDepartement->fetchColumn();
        return $idDepartement;
    }

    /**
     * Obtient l'identifiant de l'année universitaire en fonction de son nom.
     *
     * @param string $anneeUniversitaire Le nom de l'année universitaire.
     * @return int L'identifiant de l'année universitaire.
     */
    public static function getIdAnnee(string $anneeUniversitaire): int
    {
        $pdo = Model::getPdo();
        $sqlAnnee = "SELECT idAnneeUniversitaire FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $stmtAnnee = $pdo->prepare($sqlAnnee);
        $stmtAnnee->execute(array("nomAnnee" => $anneeUniversitaire));
        return $stmtAnnee->fetchColumn();

    }

    /**
     * Construit un objet Inscription à partir d'un tableau de données.
     *
     * @param array $InscriptionFormatTableau Le tableau de données de l'inscription.
     * @return Inscription L'objet Inscription construit.
     */
    public function construireDepuisTableau(array $InscriptionFormatTableau): Inscription
    {
        return new Inscription($InscriptionFormatTableau["numEtudiant"],
            $InscriptionFormatTableau["idAnneeUniversitaire"], $InscriptionFormatTableau["codeDepartement"]);
    }

    /**
     * Obtient le nom de la table correspondant à l'entité Inscription.
     *
     * @return string Le nom de la table Inscriptions.
     */
    protected function getNomTable(): string
    {
        return "Inscriptions";
    }


    /**
     * Obtient le nom de la clé primaire de l'entité Inscription.
     *
     * @return string Le nom de la clé primaire, numEtudiant.
     */
    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    /**
     * Obtient les noms des colonnes de la table Inscriptions.
     *
     * @return array Les noms des colonnes de la table Inscriptions.
     */
    protected function getNomsColonnes(): array
    {
        return array("numEtudiant", "idAnneeUniversitaire", "codeDepartement");
    }
}