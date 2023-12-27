<?php

namespace App\SAE\Model\DataObject;

class AnneeUniversitaire extends AbstractDataObject {
    private string $idAnneeUniversitaire;
    private string $nomAnneeUniversitaire;
    private string $dateFinAnneeUniversitaire;
    private string $dateDebutAnneeUniversitaire;

    public function __construct(string $nomAnneeUniversitaire, string $dateFinAnneeUniversitaire, string $dateDebutAnneeUniversitaire)
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
        $this->dateFinAnneeUniversitaire = $dateFinAnneeUniversitaire;
        $this->dateDebutAnneeUniversitaire = $dateDebutAnneeUniversitaire;
    }

    public function getIdAnneeUniversitaire(): string
    {
        return $this->idAnneeUniversitaire;
    }

    public function setIdAnneeUniversitaire(string $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    public function getNomAnneeUniversitaire(): string
    {
        return $this->nomAnneeUniversitaire;
    }

    public function setNomAnneeUniversitaire(string $nomAnneeUniversitaire): void
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
    }

    public function getDateFinAnneeUniversitaire(): string
    {
        return $this->dateFinAnneeUniversitaire;
    }

    public function setDateFinAnneeUniversitaire(string $dateFinAnneeUniversitaire): void
    {
        $this->dateFinAnneeUniversitaire = $dateFinAnneeUniversitaire;
    }

    public function getDateDebutAnneeUniversitaire(): string
    {
        return $this->dateDebutAnneeUniversitaire;
    }

    public function setDateDebutAnneeUniversitaire(string $dateDebutAnneeUniversitaire): void
    {
        $this->dateDebutAnneeUniversitaire = $dateDebutAnneeUniversitaire;
    }

    public function formatTableau(): array
    {
        return array(
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire,
            "nomAnneeUniversitaireTag" => $this->nomAnneeUniversitaire,
            "dateFinAnneeUniversitaireTag" => $this->dateFinAnneeUniversitaire,
            "dateDebutAnneeUniversitaireTag" => $this->dateDebutAnneeUniversitaire
        );
    }

    public function getSetters(): array {
        return [
            "idAnneeUniversitaire" => "setIdAnneeUniversitaire",
            "nomAnneeUniversitaire" => "setNomAnneeUniversitaire",
            "dateFinAnneeUniversitaire" => "setDateFinAnneeUniversitaire",
            "dateDebutAnneeUniversitaire" => "setDateDebutAnneeUniversitaire"
        ];

    }
}
