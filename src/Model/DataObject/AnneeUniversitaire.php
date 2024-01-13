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

    /**
     * Constructeur de la classe AnneeUniversitaire.
     *
     * @param string $nomAnneeUniversitaire Le nom de l'année universitaire.
     * @param string $dateFinAnneeUniversitaire La date de fin de l'année universitaire.
     * @param string $dateDebutAnneeUniversitaire La date de début de l'année universitaire.
     */
    public function __construct(string $nomAnneeUniversitaire, string $dateFinAnneeUniversitaire, string $dateDebutAnneeUniversitaire)
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
        $this->dateFinAnneeUniversitaire = $dateFinAnneeUniversitaire;
        $this->dateDebutAnneeUniversitaire = $dateDebutAnneeUniversitaire;
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
            "dateDebutAnneeUniversitaireTag" => $this->dateDebutAnneeUniversitaire
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
            "dateDebutAnneeUniversitaire" => "setDateDebutAnneeUniversitaire"
        ];
    }
}
