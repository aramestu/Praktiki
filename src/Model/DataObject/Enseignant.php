<?php

namespace App\SAE\Model\DataObject;

class Enseignant extends AbstractDataObject
{
    private string $mailEnseignant;
    private string $nomEnseignant;
    private string $prenomEnseignant;
    private bool $estAdmin;


    public function __construct(string $mailEnseignant, string $nomEnseignant, string $prenomEnseignant, bool $estAdmin)
    {
        $this->mailEnseignant = $mailEnseignant;
        $this->nomEnseignant = $nomEnseignant;
        $this->prenomEnseignant = $prenomEnseignant;
        $this->estAdmin = $estAdmin;

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

    public function isEstAdmin(): bool
    {
        return $this->estAdmin;
    }

    public function setEstAdmin(bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
    }



    public function formatTableau(): array
    {
        if ($this->estAdmin){
            $bool=1;
        }else $bool=0;
        return array(
            "mailEnseignantTag" => $this->mailEnseignant,
            "nomEnseignantTag" => $this->nomEnseignant,
            "prenomEnseignantTag" => $this->prenomEnseignant,
            "estAdminTag" => $bool
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Enseignant
    {
        if (isset($tableauFormulaire["estAdmin"]) && $tableauFormulaire["estAdmin"]=="on"){
            $bool=true;
        }else $bool=false;
        return new Enseignant(
            $tableauFormulaire["mail"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["prenom"],
            $bool

        );
    }
}
