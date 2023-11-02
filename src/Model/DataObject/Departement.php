<?php

namespace App\SAE\Model\DataObject;

class Departement extends AbstractDataObject
{
    private string $codeDepartement;
    private string $nomDepartement;

    public function __construct(string $nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;
    }

    public function getCodeDepartement(): string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(string $codeDepartement): void
    {
        $this->codeDepartement = $codeDepartement;
    }

    public function getNomDepartement(): string
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(string $nomDepartement): void
    {
        $this->nomDepartement = $nomDepartement;
    }

    public function formatTableau(): array
    {
        return array(
            "codeDepartementTag" => $this->codeDepartement,
            "nomDepartementTag" => $this->nomDepartement
        );
    }
}
