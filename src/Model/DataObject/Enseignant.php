<?php
namespace App\SAE\Model\DataObject;

class Enseignant extends AbstractDataObject
{
    private string $mailEnseignant;
    private string $nomEnseignant;
    private string $prenomEnseignant;


    public function __construct(string $mailEnseignant, string $nomEnseignant, string $prenomEnseignant)
    {
        $this->mailEnseignant = $mailEnseignant;
        $this->nomEnseignant = $nomEnseignant;
        $this->prenomEnseignant = $prenomEnseignant;

    }

    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    public function getNomEnseignant(): string
    {
        return $this->nomEnseignant;
    }

    public function getPrenomEnseignant(): string
    {
        return $this->prenomEnseignant;
    }

    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    public function setNomEnseignant(string $nomEnseignant): void
    {
        $this->nomEnseignant = $nomEnseignant;
    }

    public function setPrenomEnseignant(string $prenomEnseignant): void
    {
        $this->prenomEnseignant = $prenomEnseignant;
    }

}