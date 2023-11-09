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
    private string $codePostalExperienceProfessionnel;
    private string $adresseExperienceProfessionnel;
    private string $dateDebutExperienceProfessionnel;
    private string $dateFinExperienceProfessionnel;
    private string $numEtudiant;
    private string $mailEnseignant;
    private string $siret;
    private string $mailTuteurProfessionnel;
    private string $datePublication;


    public function __construct(
        string $sujet,
        string $thematique,
        string $taches,
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
        $this->codePostalExperienceProfessionnel = $codePostal;
        $this->adresseExperienceProfessionnel = $adresse;
        $this->dateDebutExperienceProfessionnel = $dateDebut;
        $this->dateFinExperienceProfessionnel = $dateFin;
        $this->siret = $siret;
        $this->idExperienceProfessionnel = "";
        $this->datePublication = "";
        $this->numEtudiant = "";
        $this->mailEnseignant = "";
        $this->mailTuteurProfessionnel = "";
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

    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    public function getMailTuteurProfessionnel(): string
    {
        return $this->mailTuteurProfessionnel;
    }

    public function setMailTuteurProfessionnel(string $mailTuteurProfessionnel): void
    {
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
    }

    public function getDatePublication(): string
    {
        // Si l'id n'a pas été initialisé
        if($this->idExperienceProfessionnel == ""){
            return "";
        }
        return AbstractExperienceProfessionnelRepository::getDatePublication($this->idExperienceProfessionnel);
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
            "codePostalExperienceProfessionnelTag" => $this->codePostalExperienceProfessionnel,
            "adresseExperienceProfessionnelTag" => $this->adresseExperienceProfessionnel,
            "dateDebutExperienceProfessionnelTag" => $this->dateDebutExperienceProfessionnel,
            "dateFinExperienceProfessionnelTag" => $this->dateFinExperienceProfessionnel,
            "siretTag" => $this->siret,
            "numEtudiantTag" => $this->numEtudiant,
            "mailEnseignantTag" => $this->mailEnseignant,
            "mailTuteurProfessionnelTag" => $this->mailTuteurProfessionnel,
            "datePublicationTag" => $this->getDatePublication()
        );
    }

    public function getNomExperienceProfessionnel(): string
    {
        return "Stalternance";
    }
}
