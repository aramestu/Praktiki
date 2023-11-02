<?php

namespace App\SAE\Model\DataObject;

class TuteurProfessionnel extends AbstractDataObject
{
    private string $mailTuteurProfessionnel;
    private string $prenomTuteurProfessionnel;
    private string $nomTuteurProfessionnel;
    private string $fonctionTuteurProfessionnel;
    private string $telephoneTuteurProfessionnel;


    public function __construct(string $mailTuteurProfessionnel, string $prenomTuteurProfessionnel, string $nomTuteurProfessionnel
        , string                       $fonctionTuteurProfessionnel, string $telephoneTuteur)
    {
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
        $this->telephoneTuteurProfessionnel = $telephoneTuteur;

    }

    public function getMailTuteurProfessionnel(): string
    {
        return $this->mailTuteurProfessionnel;
    }

    public function setMailTuteurProfessionnel(string $mailTuteurProfessionnel): void
    {
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
    }

    public function getPrenomTuteurProfessionnel(): string
    {
        return $this->prenomTuteurProfessionnel;
    }

    public function setPrenomTuteurProfessionnel(string $prenomTuteurProfessionnel): void
    {
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
    }

    public function getNomTuteurProfessionnel(): string
    {
        return $this->nomTuteurProfessionnel;
    }

    public function setNomTuteurProfessionnel(string $nomTuteurProfessionnel): void
    {
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
    }

    public function getFonctionTuteurProfessionnel(): string
    {
        return $this->fonctionTuteurProfessionnel;
    }

    public function setFonctionTuteurProfessionnel(string $fonctionTuteurProfessionnel): void
    {
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
    }

    public function getTelephoneTuteurProfessionnel(): string
    {
        return $this->telephoneTuteurProfessionnel;
    }

    public function setTelephoneTuteurProfessionnel(string $telephoneTuteurProfessionnel): void
    {
        $this->telephoneTuteurProfessionnel = $telephoneTuteurProfessionnel;
    }


    public function formatTableau(): array
    {
        return array(
            "mailTuteurProfessionnelTag" => $this->mailTuteurProfessionnel,
            "prenomTuteurProfessionnelTag" => $this->prenomTuteurProfessionnel,
            "nomTuteurProfessionnelTag" => $this->nomTuteurProfessionnel,
            "fonctionTuteurProfessionnelTag" => $this->fonctionTuteurProfessionnel,
            "telephoneTuteurProfessionnelTag" => $this->telephoneTuteurProfessionnel
        );
    }
}

