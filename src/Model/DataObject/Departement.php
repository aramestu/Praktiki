<?php

namespace App\SAE\Model\DataObject;

class Departement extends AbstractDataObject
{
    private string $codeDepartement;
    private string $nomDepartement;

    public function __construct(string $codeDepartement, string $nomDepartement)
    {
        $this->codeDepartement = $codeDepartement;
        $this->nomDepartement = $nomDepartement;
    }
}
