<?php

namespace App\SAE\Model\DataObject;

/**
 * Classe représentant un objet de données pour les contrats en alternance.
 *
 * @package App\SAE\Model\DataObject
 */
class ContratsAlternance extends AbstractDataObject
{
    /**
     * @var string Le numéro de l'étudiant associé au contrat en alternance.
     */
    private string $numEtudiant;

    /**
     * @var int L'ID de l'année universitaire associée au contrat en alternance.
     */
    private int $idAnneeUniversitaire;

    /**
     * Contructeur de la classe ContratsAlternance.
     *
     * @param string $numEtudiant Le numéro de l'étudiant associé au contrat en alternance.
     * @param int $idAnneeUniversitaire L'ID de l'année universitaire associée au contrat en alternance.
     */
    public function __construct(string $numEtudiant, int $idAnneeUniversitaire)
    {
        $this->numEtudiant = $numEtudiant;
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    /**
     * Obtient le numéro de l'étudiant associé au contrat en alternance.
     *
     * @return string Le numéro de l'étudiant.
     */
    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    /**
     * Modifie le numéro de l'étudiant associé au contrat en alternance.
     *
     * @param string $numEtudiant Le nouveau numéro de l'étudiant.
     * @return void
     */
    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    /**
     * Obtient l'ID de l'année universitaire associée au contrat en alternance.
     *
     * @return int L'ID de l'année universitaire.
     */
    public function getIdAnneeUniversitaire(): int
    {
        return $this->idAnneeUniversitaire;
    }

    /**
     * Modifie l'ID de l'année universitaire associée au contrat en alternance.
     *
     * @param int $idAnneeUniversitaire Le nouvel ID de l'année universitaire.
     * @return void
     */
    public function setIdAnneeUniversitaire(int $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    /**
     * Formatte les données de l'objet sous forme de tableau.
     *
     * @return array Le tableau de données formaté.
     */
    public function formatTableau(): array
    {
        return [
            "numEtudiantTag" => $this->numEtudiant,
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire
        ];
    }

    /**
     * Obtient les noms des méthodes setters associées aux propriétés de l'objet.
     *
     * @return array Les noms des méthodes setters.
     */
    public function getSetters(): array
    {
        return [
            "numEtudiant" => "setNumEtudiant",
            "idAnneeUniversitaire" => "setIdAnneeUniversitaire"
        ];
    }
}
