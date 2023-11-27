<?php

namespace App\SAE\Model\DataObject;

use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

class ExperienceProfessionnel extends AbstractDataObject
{

    private string $idExperienceProfessionnel;
    private string $sujetExperienceProfessionnel;
    private string $thematiqueExperienceProfessionnel;
    private string $tachesExperienceProfessionnel;
    private string $niveauExperienceProfessionnel;
    private string $codePostalExperienceProfessionnel;
    private string $adresseExperienceProfessionnel;
    private string $dateDebutExperienceProfessionnel;
    private string $dateFinExperienceProfessionnel;
    private string $siret;
    private string $datePublication;


    public function __construct(
        string $sujet,
        string $thematique,
        string $taches,
        string $niveau,
        string $codePostal,
        string $adresse,
        string $dateDebut,
        string $dateFin,
        string $siret
    )
    {
        $this->sujetExperienceProfessionnel = $sujet;
        $this->thematiqueExperienceProfessionnel = $thematique;
        $this->tachesExperienceProfessionnel = $taches;
        $this->niveauExperienceProfessionnel = $niveau;
        $this->codePostalExperienceProfessionnel = $codePostal;
        $this->adresseExperienceProfessionnel = $adresse;
        $this->dateDebutExperienceProfessionnel = $dateDebut;
        $this->dateFinExperienceProfessionnel = $dateFin;
        $this->siret = $siret;
        $this->idExperienceProfessionnel = "";
        $this->datePublication = "";
    }

    public function getIdExperienceProfessionnel(): string
    {
        return $this->idExperienceProfessionnel;
    }

    public function setIdExperienceProfessionnel(string $idExperienceProfessionnel): void
    {
        $this->idExperienceProfessionnel = $idExperienceProfessionnel;
    }

    public function getSujetExperienceProfessionnel(): string
    {
        return $this->sujetExperienceProfessionnel;
    }

    public function setSujetExperienceProfessionnel(string $sujetExperienceProfessionnel): void
    {
        $this->sujetExperienceProfessionnel = $sujetExperienceProfessionnel;
    }

    public function getThematiqueExperienceProfessionnel(): string
    {
        return $this->thematiqueExperienceProfessionnel;
    }

    public function setThematiqueExperienceProfessionnel(string $thematiqueExperienceProfessionnel): void
    {
        $this->thematiqueExperienceProfessionnel = $thematiqueExperienceProfessionnel;
    }

    public function getTachesExperienceProfessionnel(): string
    {
        return $this->tachesExperienceProfessionnel;
    }

    public function setTachesExperienceProfessionnel(string $tachesExperienceProfessionnel): void
    {
        $this->tachesExperienceProfessionnel = $tachesExperienceProfessionnel;
    }

    public function getNiveauExperienceProfessionnel(): string
    {
        return $this->niveauExperienceProfessionnel;
    }

    public function setNiveauExperienceProfessionnel(string $niveauExperienceProfessionnel): void
    {
        $this->niveauExperienceProfessionnel = $niveauExperienceProfessionnel;
    }


    public function getCodePostalExperienceProfessionnel(): string
    {
        return $this->codePostalExperienceProfessionnel;
    }

    public function setCodePostalExperienceProfessionnel(string $codePostalExperienceProfessionnel): void
    {
        $this->codePostalExperienceProfessionnel = $codePostalExperienceProfessionnel;
    }

    public function getAdresseExperienceProfessionnel(): string
    {
        return $this->adresseExperienceProfessionnel;
    }

    public function setAdresseExperienceProfessionnel(string $adresseExperienceProfessionnel): void
    {
        $this->adresseExperienceProfessionnel = $adresseExperienceProfessionnel;
    }

    public function getDateDebutExperienceProfessionnel(): string
    {
        return $this->dateDebutExperienceProfessionnel;
    }

    public function setDateDebutExperienceProfessionnel(string $dateDebutExperienceProfessionnel): void
    {
        $this->dateDebutExperienceProfessionnel = $dateDebutExperienceProfessionnel;
    }

    public function getDateFinExperienceProfessionnel(): string
    {
        return $this->dateFinExperienceProfessionnel;
    }

    public function setDateFinExperienceProfessionnel(string $dateFinExperienceProfessionnel): void
    {
        $this->dateFinExperienceProfessionnel = $dateFinExperienceProfessionnel;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    public function getDatePublication(): string
    {
        return $this->datePublication;
    }

    public function setDatePublication(string $datePublication): void
    {
        $this->datePublication = $datePublication;
    }

    public function formatTableau(): array
    {
        return array(
            "idExperienceProfessionnelTag" => $this->idExperienceProfessionnel,
            "sujetExperienceProfessionnelTag" => $this->sujetExperienceProfessionnel,
            "thematiqueExperienceProfessionnelTag" => $this->thematiqueExperienceProfessionnel,
            "tachesExperienceProfessionnelTag" => $this->tachesExperienceProfessionnel,
            "niveauExperienceProfessionnelTag" => $this->niveauExperienceProfessionnel,
            "codePostalExperienceProfessionnelTag" => $this->codePostalExperienceProfessionnel,
            "adresseExperienceProfessionnelTag" => $this->adresseExperienceProfessionnel,
            "dateDebutExperienceProfessionnelTag" => $this->dateDebutExperienceProfessionnel,
            "dateFinExperienceProfessionnelTag" => $this->dateFinExperienceProfessionnel,
            "siretTag" => $this->siret,
            "datePublicationTag" => $this->datePublication
        );
    }

    public function getNomExperienceProfessionnel(): string
    {
        return "ExperienceProfessionnel";
    }
}
