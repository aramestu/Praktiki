<?php
namespace App\SAE\Model\DataObject;

class Entreprise {
    private string $siret;
    private string $nom;
    private string $codePostal;
    private string $effectif;
    private string $telephone;
    private string $siteWeb;

    public function __construct(string $siret, string $nom, string $codePostal, string $effectif, string $telephone, string $siteWeb){
        $this->siret = $siret;
        $this->nom = $nom;
        $this->codePostal = $codePostal;
        $this->effectif = $effectif;
        $this->telephone = $telephone;
        $this->siteWeb = $siteWeb;
    }

    public function getSiret(): string{
        return $this->siret;
    }

    public function setSiret(string $siret): void {
        $this->siret = $siret;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getCodePostal(): string {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    public function getEffectif(): string {
        return $this->effectif;
    }

    public function setEffectif(string $effectif): void {
        $this->effectif = $effectif;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function getSiteWeb(): string {
        return $this->siteWeb;
    }

    public function setSiteWeb(string $siteWeb): void {
        $this->siteWeb = $siteWeb;
    }

}
