<?php

namespace App\SAE\Model\DataObject;

class Etudiant extends AbstractDataObject
{
    private string $numEtudiant;
    private string $prenomEtudiant;
    private string $nomEtudiant;
    private string $mailPersoEtudiant;
    private string $mailUniversitaireEtuidant;
    private string $telephoneEtudiant;
    private string $codePostalEtudiant;


    public function __construct(string $numEtudiant, string $prenomEtudiant, string $nomEtudiant,
                                string $mailPersoEtudiant, string $mailUniversitaireEtuidant,
                                string $telephoneEtudiant, string $codePostalEtudiant)
    {
        $this->numEtudiant = $numEtudiant;
        $this->prenomEtudiant = $prenomEtudiant;
        $this->nomEtudiant = $nomEtudiant;
        $this->mailPersoEtudiant = $mailPersoEtudiant;
        $this->mailUniversitaireEtuidant = $mailUniversitaireEtuidant;
        $this->telephoneEtudiant = $telephoneEtudiant;
        $this->codePostalEtudiant = $codePostalEtudiant;
    }

    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    public function getPrenomEtudiant(): string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(string $prenomEtudiant): void
    {
        $this->prenomEtudiant = $prenomEtudiant;
    }

    public function getNomEtudiant(): string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(string $nomEtudiant): void
    {
        $this->nomEtudiant = $nomEtudiant;
    }

    public function getMailPersoEtudiant(): string
    {
        return $this->mailPersoEtudiant;
    }

    public function setMailPersoEtudiant(string $mailPersoEtudiant): void
    {
        $this->mailPersoEtudiant = $mailPersoEtudiant;
    }

    public function getMailUniversitaireEtuidant(): string
    {
        return $this->mailUniversitaireEtuidant;
    }

    public function setMailUniversitaireEtuidant(string $mailUniversitaireEtuidant): void
    {
        $this->mailUniversitaireEtuidant = $mailUniversitaireEtuidant;
    }

    public function getTelephoneEtudiant(): string
    {
        return $this->telephoneEtudiant;
    }

    public function setTelephoneEtudiant(string $telephoneEtudiant): void
    {
        $this->telephoneEtudiant = $telephoneEtudiant;
    }

    public function getCodePostalEtudiant(): string
    {
        return $this->codePostalEtudiant;
    }

    public function setCodePostalEtudiant(string $codePostalEtudiant): void
    {
        $this->codePostalEtudiant = $codePostalEtudiant;
    }



}
