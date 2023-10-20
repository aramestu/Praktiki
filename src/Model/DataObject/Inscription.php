<?php
namespace App\SAE\Model\DataObject;

class Inscription extends AbstractDataObject
{
    private string $numEtudiant;
    private string $idAnneeUniversitaire;
    private string $codeDepartement;

    public function __construct(string $numEtudiant, string $idAnneeUniversitaire, string $codeDepartement)
    {
        $this->numEtudiant = $numEtudiant;
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
        $this->codeDepartement = $codeDepartement;
    }

    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    public function getIdAnneeUniversitaire(): string
    {
        return $this->idAnneeUniversitaire;
    }

    public function setIdAnneeUniversitaire(string $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    public function getCodeDepartement(): string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(string $codeDepartement): void
    {
        $this->codeDepartement = $codeDepartement;
    }

    public function formatTableau(): array {
        return array(
            "numEtudiantTag" => $this->numEtudiant,
            "idAnneeUniversitaireTag" => $this->idAnneeUniversitaire,
            "codeDepartementTag" => $this->codeDepartement
        );
    }
}
