<?php

namespace App\SAE\Model\DataObject;

class AnneeUniversitaire extends AbstractDataObject
{
    private string $idAnneeUniversitaire;
    private string $nomAnneeUniversitaire;

    public function __construct(string $nomAnneeUniversitaire)
    {
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
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

    public function formatTableau(): array
    {
        return array(
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire,
            "nomAnneeUniversitaireTag" => $this->nomAnneeUniversitaire
        );
    }
}
