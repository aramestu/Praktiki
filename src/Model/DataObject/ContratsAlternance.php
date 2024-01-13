<?php

namespace App\SAE\Model\DataObject;

use App\SAE\Controller\ControllerGenerique;
use App\SAE\Model\Repository\AbstractRepository;

class ContratsAlternance extends AbstractDataObject
{
    private string $numEtudiant;
    private int $idAnneeUniversitaire;

    /**
     * @param string $numEtudiant
     * @param int $idAnneeUniversitaire
     */
    public function __construct(string $numEtudiant, int $idAnneeUniversitaire)
    {
        $this->numEtudiant = $numEtudiant;
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    public function getIdAnneeUniversitaire(): int
    {
        return $this->idAnneeUniversitaire;
    }

    public function setIdAnneeUniversitaire(int $idAnneeUniversitaire): void
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
    }

    public function formatTableau(): array
    {
        return array("numEtudiantTag" => $this->numEtudiant,
            "idAnneeUniversitaire" => $this->idAnneeUniversitaire);
    }

    public function getSetters(): array
    {
        return array("numEtudiant" => "setNumEtudiant",
            "idAnneeUniversitaire" => "setIdAnneeUniversitaire");
    }
}