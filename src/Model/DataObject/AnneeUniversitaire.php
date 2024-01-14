<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe AnneeUniversitaire représente une année universitaire.
 */
class AnneeUniversitaire extends AbstractDataObject
{
    private string $idAnneeUniversitaire;
    private string $nomAnneeUniversitaire;
    private string $dateFinAnneeUniversitaire;
    private string $dateDebutAnneeUniversitaire;

    // Nombre d'étudiant ayant un stage en fonction de l'année universitaire
    private int $nbStage;

    // Nombre d'étudiant ayant une alternance en fonction de l'année universitaire
    private int $nbAlternance;

    // Nombre d'étudiant n'ayant ni un stage ni une alternance en fonction de l'année universitaire
    private int $nbRien;

    /**
     * Constructeur de la classe AnneeUniversitaire.
     *
     * @param string $nomAnneeUniversitaire Le nom de l'année universitaire.
     * @param string $dateFinAnneeUniversitaire La date de fin de l'année universitaire.
     * @param string $dateDebutAnneeUniversitaire La date de début de l'année universitaire.
     */
    public function __construct(string $nomAnneeUniversitaire, string $dateFinAnneeUniversitaire, string $dateDebutAnneeUniversitaire, int $nbStage, int $nbAlternance, int $nbRien)
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
        $this->dateFinAnneeUniversitaire = $dateFinAnneeUniversitaire;
        $this->dateDebutAnneeUniversitaire = $dateDebutAnneeUniversitaire;
        $this->nbStage = $nbStage;
        $this->nbAlternance = $nbAlternance;
        $this->nbRien = $nbRien;
    }

    /**
     * Retourne le nombre d'étudiant qui ont des stages pour l'année universitaire
     * @return int
     */
    public function getNbStage(): int
    {
        return $this->nbStage;
    }
    /**
    public function setNbStage(int $nbStage): void
    {
        $this->nbStage = $nbStage;
    }

    /**
     * Retourne le nombre d'étudiant qui ont des alternances pour l'année universitaire
     * @return int
     */
    public function getNbAlternance(): int
    {
        return $this->nbAlternance;
    }

    /**
     * @param int $nbAlternance
     * @return void
     */
    public function setNbAlternance(int $nbAlternance): void
    {
        $this->nbAlternance = $nbAlternance;
    }

    /**
     * Retourne le nombre d'étudiant qui n'ont ni stage ni alternance des stages pour l'année universitaire
     * @return int
     */
    public function getNbRien(): int
    {
        return $this->nbRien;
    }

    /**
     * @param int $nbRien
     * @return void
     */
    public function setNbRien(int $nbRien): void
    {
        $this->nbRien = $nbRien;
    }

    /**
     * Getter pour l'identifiant de l'année universitaire.
     *
     * @return string L'identifiant de l'année universitaire.
     */
    public function getIdAnneeUniversitaire(): string
    {
        return $this->idAnneeUniversitaire;
    }

    /**
     * Setter pour l'identifiant de l'année universitaire.
     *
     * @param string $idAnneeUniversitaire Le nouvel identifiant de l'année universitaire.
     */
    public function setIdAnneeUniversitaire(string $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    /**
     * Getter pour le nom de l'année universitaire.
     *
     * @return string Le nom de l'année universitaire.
     */
    public function getNomAnneeUniversitaire(): string
    {
        return $this->nomAnneeUniversitaire;
    }

    /**
     * Setter pour le nom de l'année universitaire.
     *
     * @param string $nomAnneeUniversitaire Le nouveau nom de l'année universitaire.
     */
    public function setNomAnneeUniversitaire(string $nomAnneeUniversitaire): void
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
    }

    /**
     * Getter pour la date de fin de l'année universitaire.
     *
     * @return string La date de fin de l'année universitaire.
     */
    public function getDateFinAnneeUniversitaire(): string
    {
        return $this->dateFinAnneeUniversitaire;
    }

    /**
     * Setter pour la date de fin de l'année universitaire.
     *
     * @param string $dateFinAnneeUniversitaire La nouvelle date de fin de l'année universitaire.
     */
    public function setDateFinAnneeUniversitaire(string $dateFinAnneeUniversitaire): void
    {
        $this->dateFinAnneeUniversitaire = $dateFinAnneeUniversitaire;
    }

    /**
     * Getter pour la date de début de l'année universitaire.
     *
     * @return string La date de début de l'année universitaire.
     */
    public function getDateDebutAnneeUniversitaire(): string
    {
        return $this->dateDebutAnneeUniversitaire;
    }

    /**
     * Setter pour la date de début de l'année universitaire.
     *
     * @param string $dateDebutAnneeUniversitaire La nouvelle date de début de l'année universitaire.
     */
    public function setDateDebutAnneeUniversitaire(string $dateDebutAnneeUniversitaire): void
    {
        $this->dateDebutAnneeUniversitaire = $dateDebutAnneeUniversitaire;
    }

    /**
     * Méthode pour formater l'objet sous forme de tableau.
     *
     * @return array Un tableau représentant l'objet.
     */
    public function formatTableau(): array
    {
        return [
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire,
            "nomAnneeUniversitaireTag" => $this->nomAnneeUniversitaire,
            "dateFinAnneeUniversitaireTag" => $this->dateFinAnneeUniversitaire,
            "dateDebutAnneeUniversitaireTag" => $this->dateDebutAnneeUniversitaire,
            "nbStageTag" => $this->nbStage,
            "nbAlternanceTag" => $this->nbAlternance,
            "nbRien" => $this->nbRien
        ];
    }

    /**
     * Méthode pour obtenir les setters de l'objet.
     *
     * @return array Un tableau contenant les noms des setters de l'objet.
     */
    public function getSetters(): array
    {
        return [
            "idAnneeUniversitaire" => "setIdAnneeUniversitaire",
            "nomAnneeUniversitaire" => "setNomAnneeUniversitaire",
            "dateFinAnneeUniversitaire" => "setDateFinAnneeUniversitaire",
            "dateDebutAnneeUniversitaire" => "setDateDebutAnneeUniversitaire",
            "nbStage" => "setNbStage",
            "nbAlternance" => "setNbAlternance",
            "nbRien" => "setNbRien"
        ];
    }
}
