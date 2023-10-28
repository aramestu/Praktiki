<?php
namespace App\SAE\Model\DataObject;

class Entreprise extends AbstractDataObject {
    private string $siret;
    private string $nomEntreprise;
    private string $codePostalEntreprise;
    private string $effectifEntreprise;
    private string $telephoneEntreprise;
    private string $siteWebEntreprise;

    private string $estValide;

    public function __construct(string $siret, string $nom, string $codePostal, string $effectif, string $telephone, string $siteWeb, bool $estValide=false){
        $this->siret = $siret;
        $this->nomEntreprise = $nom;
        $this->codePostalEntreprise = $codePostal;
        $this->effectifEntreprise = $effectif;
        $this->telephoneEntreprise = $telephone;
        $this->siteWebEntreprise = $siteWeb;
        $this->estValide = $estValide;
    }

    public function getSiret(): string{
        return $this->siret;
    }

    public function setSiret(string $siret): void {
        $this->siret = $siret;
    }

    public function getNomEntreprise(): string {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): void {
        $this->nomEntreprise = $nomEntreprise;
    }

    public function getCodePostalEntreprise(): string {
        return $this->codePostalEntreprise;
    }

    public function setCodePostalEntreprise(string $codePostalEntreprise): void {
        $this->codePostalEntreprise = $codePostalEntreprise;
    }

    public function getEffectifEntreprise(): string {
        return $this->effectifEntreprise;
    }

    public function setEffectifEntreprise(string $effectifEntreprise): void {
        $this->effectifEntreprise = $effectifEntreprise;
    }

    public function getTelephoneEntreprise(): string {
        return $this->telephoneEntreprise;
    }

    public function setTelephoneEntreprise(string $telephoneEntreprise): void {
        $this->telephoneEntreprise = $telephoneEntreprise;
    }

    public function getSiteWebEntreprise(): string {
        return $this->siteWebEntreprise;
    }

    public function setSiteWebEntreprise(string $siteWebEntreprise): void {
        $this->siteWebEntreprise = $siteWebEntreprise;
    }

    public function getEstValide(): string
    {
        return $this->estValide;
    }

    public function setEstValide(string $estValide): void
    {
        $this->estValide = $estValide;
    }

    public function formatTableau(): array{
        return array(
            "siretTag" => $this->siret,
            "nomEntrepriseTag" => $this->nomEntreprise,
            "codePostalEntrepriseTag" => $this->codePostalEntreprise,
            "effectifEntrepriseTag" => $this->effectifEntreprise,
            "telephoneEntrepriseTag" => $this->telephoneEntreprise,
            "siteWebEntrepriseTag" => $this->siteWebEntreprise,
            "estValideTag" => $this->estValide
        );
    }
}
