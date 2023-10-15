<?php

namespace App\SAE\Model\DataObject;

class AnneeUniversitaire extends AbstractDataObject
{
    private string $idAnneeUniversitaire;
    private string $nomAnneeUniversitaire;

    public function __construct(string $idAnneeUniversitaire, string $nomAnneeUniversitaire)
    {
        $this->idAnneeUniversitaire = $idAnneeUniversitaire;
        $this->nomAnneeUniversitaire = $nomAnneeUniversitaire;
    }
}
