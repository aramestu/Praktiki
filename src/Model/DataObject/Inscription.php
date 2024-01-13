<?php

namespace App\SAE\Model\DataObject;

/**
 * Classe représentant une inscription.
 *
 * @package App\SAE\Model\DataObject
 */
class Inscription extends AbstractDataObject
{
    /**
     * @var string Le numéro de l'étudiant.
     */
    private string $numEtudiant;

    /**
     * @var string L'identifiant de l'année universitaire.
     */
    private string $idAnneeUniversitaire;

    /**
     * @var string Le code du département.
     */
    private string $codeDepartement;

    /**
     * Constructeur de la classe Inscription.
     *
     * @param string $numEtudiant Le numéro de l'étudiant.
     * @param string $idAnneeUniversitaire L'identifiant de l'année universitaire.
     * @param string $codeDepartement Le code du département.
     */
    public function __construct(string $numEtudiant, string $idAnneeUniversitaire, string $codeDepartement)
    {
        $this->numEtudiant = $numEtudiant;
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
        $this->codeDepartement = $codeDepartement;
    }

    /**
     * Obtient le numéro de l'étudiant.
     *
     * @return string Le numéro de l'étudiant.
     */
    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    /**
     * Définit le numéro de l'étudiant.
     *
     * @param string $numEtudiant Le numéro de l'étudiant.
     */
    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    /**
     * Obtient l'identifiant de l'année universitaire.
     *
     * @return string L'identifiant de l'année universitaire.
     */
    public function getIdAnneeUniversitaire(): string
    {
        return $this->idAnneeUniversitaire;
    }

    /**
     * Définit l'identifiant de l'année universitaire.
     *
     * @param string $idAnneeUniversitaire L'identifiant de l'année universitaire.
     */
    public function setIdAnneeUniversitaire(string $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    /**
     * Obtient le code du département.
     *
     * @return string Le code du département.
     */
    public function getCodeDepartement(): string
    {
        return $this->codeDepartement;
    }

    /**
     * Définit le code du département.
     *
     * @param string $codeDepartement Le code du département.
     */
    public function setCodeDepartement(string $codeDepartement): void
    {
        $this->codeDepartement = $codeDepartement;
    }

    /**
     * Formate les données de l'inscription sous forme de tableau.
     *
     * @return array Les données formatées.
     */
    public function formatTableau(): array
    {
        return array(
            "numEtudiantTag" => $this->numEtudiant,
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire,
            "codeDepartementTag" => $this->codeDepartement
        );
    }

    /**
     * Obtient les méthodes setters associées aux propriétés de l'inscription.
     *
     * @return array Les méthodes setters.
     */
    public function getSetters(): array
    {
        return [
            "numEtudiant" => "setNumEtudiant",
            "idAnneeUniversitaire" => "setIdAnneeUniversitaire",
            "codeDepartement" => "setCodeDepartement",
        ];
    }
}
