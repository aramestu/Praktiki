<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ContratsAlternance;
use App\SAE\Model\Model;

/**
 * Classe de gestion des opérations de base pour les contrats en alternance dans la base de données.
 *
 * @package App\SAE\Model\Repository
 */
class ContratsAlternanceRepository extends AbstractRepository
{

    /**
     * Retourne le nom de la table associée aux contrats en alternance.
     *
     * @return string Le nom de la table.
     */
    protected function getNomTable(): string
    {
        return "ContratsAlternances";
    }

    /**
     * Construit un objet ContratsAlternance à partir d'un tableau de données formaté.
     *
     * @param array $objetFormatTableau Le tableau de données formaté.
     * @return ContratsAlternance L'objet ContratsAlternance construit.
     */
    public function construireDepuisTableau(array $objetFormatTableau): AbstractDataObject
    {
        return new ContratsAlternance($objetFormatTableau["numEtudiant"], $objetFormatTableau["idAnneeUniversitaire"]);
    }

    /**
     * Retourne le nom de la clé primaire associée aux contrats en alternance.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "numEtudiant, idAnneeUniversitaire";
    }

    /**
     * Retourne les noms des colonnes associées aux contrats en alternance.
     *
     * @return array Les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return ["numEtudiant", "idAnneeUniversitaire"];
    }

    /**
     * Retourne toujours null car ne peut pas être exécuté pour cette table.
     *
     * @param string $valeurClePrimaire La valeur de la clé primaire.
     * @return AbstractDataObject|null Toujours null pour cette table.
     */
    public function getById(string $valeurClePrimaire): ?AbstractDataObject
    {
        return null;
    }

    /**
     * Obtient un objet ContratsAlternance par ses identifiants.
     *
     * @param string $numEtudiant Le numéro de l'étudiant.
     * @param int $idAnneeUniversitaire L'ID de l'année universitaire.
     * @return ContratsAlternance|null L'objet ContratsAlternance ou null s'il n'existe pas.
     */
    public function getByIds(string $numEtudiant, int $idAnneeUniversitaire): ?AbstractDataObject
    {
        $nomTable = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $sql = "SELECT * from ContratsAlternances WHERE numEtudiant = :numEtudiantTag 
                                    AND idAnneeUniversitaire = :idAnneeUniversitaireTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = [
            "numEtudiantTag" => $numEtudiant,
            "idAnneeUniversitaireTag" => $idAnneeUniversitaire
        ];

        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();

        if (!$objetFormatTableau) {
            return null;
        } else {
            return $this->construireDepuisTableau($objetFormatTableau);
        }
    }

    /**
     * Retourne vrai si l'étudiant a une alternance pour une année universitaire. Faux sinon
     * @param string $numEtu
     * @param int $idAnneeUniversitaire
     * @return bool
     */
    public function etudiantPossedeAlternance(string $numEtu, int $idAnneeUniversitaire): bool{
        $sql = "SELECT COUNT(*) FROM ContratsAlternances WHERE numEtudiant= :numEtuTag AND idAnneeUniversitaire= :idAnneeTag";

        $values = [
            "numEtuTag" => $numEtu,
            "idAnneeTag" => $idAnneeUniversitaire
        ];

        $request = Model::getPdo()->prepare($sql);
        $request->execute($values);

        $result = $request->fetchColumn();
        return $result == 1;
    }

    /**
     * Retoune vrai si l'étudiant a une alternance pour l'année universitaire actuelle. Faux sinon
     * @param string $numEtu
     * @return bool
     */
    public function etudiantPossedeActuellementAlternance(string $numEtu) : bool{
        $id = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire()->getIdAnneeUniversitaire();
        return $this->etudiantPossedeAlternance($numEtu, $id);
    }

}