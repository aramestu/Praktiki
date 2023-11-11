<?php

namespace App\SAE\Model\DataObject;

use App\SAE\Lib\MotDePasse;

class Entreprise extends AbstractDataObject {
    private string $siret;
    private string $nomEntreprise;
    private string $codePostalEntreprise;
    private string $effectifEntreprise;
    private string $telephoneEntreprise;
    private string $siteWebEntreprise;
    private string $estValide;
    private string $emailEntreprise;
    private string $mdpHache;
    private string $emailAValider;
    private string $nonce;

    public function __construct(string $siret, string $nom, string $codePostal, string $effectif, string $telephone, string $siteWeb, string $email, string $mdpHache,string  $emailAValider, string $nonce)
    {
        $this->siret = $siret;
        $this->nomEntreprise = $nom;
        $this->codePostalEntreprise = $codePostal;
        $this->effectifEntreprise = $effectif;
        $this->telephoneEntreprise = $telephone;
        $this->siteWebEntreprise = $siteWeb;
        $this->estValide = 0;
        $this->emailEntreprise = $email;
        $this->mdpHache = $mdpHache;
        $this->emailAValider=$emailAValider;
        $this->nonce=$nonce;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    public function getNomEntreprise(): string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): void
    {
        $this->nomEntreprise = $nomEntreprise;
    }

    public function getCodePostalEntreprise(): string
    {
        return $this->codePostalEntreprise;
    }

    public function setCodePostalEntreprise(string $codePostalEntreprise): void
    {
        $this->codePostalEntreprise = $codePostalEntreprise;
    }

    public function getEffectifEntreprise(): string
    {
        return $this->effectifEntreprise;
    }

    public function setEffectifEntreprise(string $effectifEntreprise): void
    {
        $this->effectifEntreprise = $effectifEntreprise;
    }

    public function getTelephoneEntreprise(): string
    {
        return $this->telephoneEntreprise;
    }

    public function setTelephoneEntreprise(string $telephoneEntreprise): void
    {
        $this->telephoneEntreprise = $telephoneEntreprise;
    }

    public function getSiteWebEntreprise(): string
    {
        return $this->siteWebEntreprise;
    }

    public function setSiteWebEntreprise(string $siteWebEntreprise): void
    {
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
    public function getMdpHache(): string
    {
        return $this->mdpHache;
    }

    public function setMdpHache($mdpClair):string{
        return MotDePasse::hacher($mdpClair);
    }

    public function getEmailEntreprise(): string
    {
        return $this->emailEntreprise;
    }

    public function setEmailEntreprise(string $email): void
    {
        $this->emailEntreprise = $email;
    }

    public function getEmailAValider(): string
    {
        return $this->emailAValider;
    }

    public function setEmailAValider(string $emailAValider): void
    {
        $this->emailAValider = $emailAValider;
    }

    public function getNonce(): string
    {
        return $this->nonce;
    }

    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
    }



    public function formatTableau(): array
    {
        return [
            "siretTag" => $this->siret,
            "nomEntrepriseTag" => $this->nomEntreprise,
            "codePostalEntrepriseTag" => $this->codePostalEntreprise,
            "effectifEntrepriseTag" => $this->effectifEntreprise,
            "telephoneEntrepriseTag" => $this->telephoneEntreprise,
            "siteWebEntrepriseTag" => $this->siteWebEntreprise,
            "estValideTag" => $this->estValide,
            "emailEntrepriseTag" => $this->emailEntreprise,
            "mdpHacheTag" => $this->mdpHache,
            "emailAValiderTag" => $this->emailAValider,
            "nonceTag" => $this->nonce
        ];
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Entreprise
    {

        $mdpHache = MotDePasse::hacher($tableauFormulaire["password"]);
        return new Entreprise(
            $tableauFormulaire["siret"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["postcode"],
            $tableauFormulaire["effectif"],
            $tableauFormulaire["telephone"],
            $tableauFormulaire["website"],
            "",
            $mdpHache,
            $tableauFormulaire["email"],
            MotDePasse::genererChaineAleatoire()
        );
    }
}
