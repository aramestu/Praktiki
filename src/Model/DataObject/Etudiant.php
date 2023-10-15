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


}
