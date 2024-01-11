<?php

namespace App\SAE\Model\DataObject;

class Personnel extends AbstractDataObject
{
    private string $mailPersonnel;
    private string $nomPersonnel;
    private string $prenomPersonnel;


    public function __construct(string $mailPersonnel, string $nomPersonnel, string $prenomPersonnel)
    {
        $this->mailPersonnel = $mailPersonnel;
        $this->nomPersonnel = $nomPersonnel;
        $this->prenomPersonnel = $prenomPersonnel;
    }

    public function getMailPersonnel(): string
    {
        return $this->mailPersonnel;
    }

    public function getNomPersonnel(): string
    {
        return $this->nomPersonnel;
    }

    public function getPrenomPersonnel(): string
    {
        return $this->prenomPersonnel;
    }

    public function setMailPersonnel(string $mailPersonnel): void
    {
        $this->mailPersonnel = $mailPersonnel;
    }

    public function setNomPersonnel(string $nomPersonnel): void
    {
        $this->nomPersonnel = $nomPersonnel;
    }

    public function setPrenomPersonnel(string $prenomPersonnel): void
    {
        $this->prenomPersonnel = $prenomPersonnel;
    }



    public function formatTableau(): array
    {
        return array(
            "mailPersonnelTag" => $this->mailPersonnel,
            "nomPersonnelTag" => $this->nomPersonnel,
            "prenomPersonnelTag" => $this->prenomPersonnel
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Personnel
    {
        return new Personnel(
            $tableauFormulaire["mail"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["prenom"]
        );
    }
}
