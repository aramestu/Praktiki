<?php

namespace App\SAE\Model\DataObject;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\MotDePasse;

/**
 * La classe Entreprise représente une entreprise.
 *
 * @package App\SAE\Model\DataObject
 */
class Entreprise extends AbstractDataObject
{
    /**
     * @var string Numéro SIRET de l'entreprise.
     */
    private string $siret;

    /**
     * @var string Nom de l'entreprise.
     */
    private string $nomEntreprise;

    /**
     * @var string Code postal de l'entreprise.
     */
    private string $codePostalEntreprise;

    /**
     * @var string Effectif de l'entreprise.
     */
    private string $effectifEntreprise;

    /**
     * @var string Numéro de téléphone de l'entreprise.
     */
    private string $telephoneEntreprise;

    /**
     * @var string Site web de l'entreprise.
     */
    private string $siteWebEntreprise;

    /**
     * @var string Indique si l'entreprise est validée.
     */
    private string $estValide;

    /**
     * @var string Adresse e-mail de l'entreprise.
     */
    private string $mailEntreprise;

    /**
     * @var string Mot de passe haché de l'entreprise.
     */
    private string $mdpHache;

    /**
     * @var string Adresse e-mail à valider.
     */
    private string $mailAValider;

    /**
     * @var string Chaîne aléatoire (nonce).
     */
    private string $nonce;

    /**
     * Constructeur de la classe Entreprise.
     *
     * @param string $siret Numéro SIRET de l'entreprise.
     * @param string $nom Nom de l'entreprise.
     * @param string $codePostal Code postal de l'entreprise.
     * @param string $effectif Effectif de l'entreprise.
     * @param string $telephone Numéro de téléphone de l'entreprise.
     * @param string $siteWeb Site web de l'entreprise.
     * @param string $email Adresse e-mail de l'entreprise.
     * @param string $mdpHache Mot de passe haché de l'entreprise.
     * @param string $emailAValider Adresse e-mail à valider.
     * @param string $nonce Chaîne aléatoire (nonce).
     */
    public function __construct(string $siret, string $nom, string $codePostal, string $effectif, string $telephone, string $siteWeb, string $email, string $mdpHache, string $emailAValider, string $nonce)
    {
        $this->siret = $siret;
        $this->nomEntreprise = $nom;
        $this->codePostalEntreprise = $codePostal;
        $this->effectifEntreprise = $effectif;
        $this->telephoneEntreprise = $telephone;
        $this->siteWebEntreprise = $siteWeb;
        $this->estValide = '0';
        $this->mailEntreprise = $email;
        $this->mdpHache = $mdpHache;
        $this->mailAValider = $emailAValider;
        $this->nonce = $nonce;
    }

    /**
     * Obtient le numéro SIRET de l'entreprise.
     *
     * @return string Numéro SIRET de l'entreprise.
     */
    public function getSiret(): string
    {
        return $this->siret;
    }

    /**
     * Définit le numéro SIRET de l'entreprise.
     *
     * @param string $siret Nouveau numéro SIRET de l'entreprise.
     */
    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    /**
     * Obtient le nom de l'entreprise.
     *
     * @return string Nom de l'entreprise.
     */
    public function getNomEntreprise(): string
    {
        return $this->nomEntreprise;
    }

    /**
     * Définit le nom de l'entreprise.
     *
     * @param string $nomEntreprise Nouveau nom de l'entreprise.
     */
    public function setNomEntreprise(string $nomEntreprise): void
    {
        $this->nomEntreprise = $nomEntreprise;
    }

    /**
     * Obtient le code postal de l'entreprise.
     *
     * @return string Code postal de l'entreprise.
     */
    public function getCodePostalEntreprise(): string
    {
        return $this->codePostalEntreprise;
    }

    /**
     * Définit le code postal de l'entreprise.
     *
     * @param string $codePostalEntreprise Nouveau code postal de l'entreprise.
     */
    public function setCodePostalEntreprise(string $codePostalEntreprise): void
    {
        $this->codePostalEntreprise = $codePostalEntreprise;
    }

    /**
     * Obtient l'effectif de l'entreprise.
     *
     * @return string Effectif de l'entreprise.
     */
    public function getEffectifEntreprise(): string
    {
        return $this->effectifEntreprise;
    }

    /**
     * Définit l'effectif de l'entreprise.
     *
     * @param string $effectifEntreprise Nouvel effectif de l'entreprise.
     */
    public function setEffectifEntreprise(string $effectifEntreprise): void
    {
        $this->effectifEntreprise = $effectifEntreprise;
    }

    /**
     * Obtient le numéro de téléphone de l'entreprise.
     *
     * @return string Numéro de téléphone de l'entreprise.
     */
    public function getTelephoneEntreprise(): string
    {
        return $this->telephoneEntreprise;
    }

    /**
     * Définit le numéro de téléphone de l'entreprise.
     *
     * @param string $telephoneEntreprise Nouveau numéro de téléphone de l'entreprise.
     */
    public function setTelephoneEntreprise(string $telephoneEntreprise): void
    {
        $this->telephoneEntreprise = $telephoneEntreprise;
    }

    /**
     * Obtient le site web de l'entreprise.
     *
     * @return string Site web de l'entreprise.
     */
    public function getSiteWebEntreprise(): string
    {
        return $this->siteWebEntreprise;
    }

    /**
     * Définit le site web de l'entreprise.
     *
     * @param string $siteWebEntreprise Nouveau site web de l'entreprise.
     */
    public function setSiteWebEntreprise(string $siteWebEntreprise): void
    {
        $this->siteWebEntreprise = $siteWebEntreprise;
    }

    /**
     * Obtient l'indicateur de validation de l'entreprise.
     *
     * @return string Indicateur de validation de l'entreprise.
     */
    public function getEstValide(): string
    {
        return $this->estValide;
    }

    /**
     * Définit l'indicateur de validation de l'entreprise.
     *
     * @param string $estValide Nouvel indicateur de validation de l'entreprise.
     */
    public function setEstValide(string $estValide): void
    {
        $this->estValide = $estValide;
    }

    /**
     * Obtient le mot de passe haché de l'entreprise.
     *
     * @return string Mot de passe haché de l'entreprise.
     */
    public function getMdpHache(): string
    {
        return $this->mdpHache;
    }

    /**
     * Définit le mot de passe haché de l'entreprise.
     *
     * @param mixed $mdpClair Nouveau mot de passe clair de l'entreprise.
     */
    public function setMdpHache($mdpClair): void
    {
        $this->mdpHache = MotDePasse::hacher($mdpClair);
    }

    /**
     * Obtient l'adresse e-mail de l'entreprise.
     *
     * @return string Adresse e-mail de l'entreprise.
     */
    public function getMailEntreprise(): string
    {
        return $this->mailEntreprise;
    }

    /**
     * Définit l'adresse e-mail de l'entreprise.
     *
     * @param string $email Nouvelle adresse e-mail de l'entreprise.
     */
    public function setMailEntreprise(string $email): void
    {
        $this->mailEntreprise = $email;
    }

    /**
     * Obtient l'adresse e-mail à valider.
     *
     * @return string Adresse e-mail à valider.
     */
    public function getMailAValider(): string
    {
        return $this->mailAValider;
    }

    /**
     * Définit l'adresse e-mail à valider.
     *
     * @param string $emailAValider Nouvelle adresse e-mail à valider.
     */
    public function setMailAValider(string $emailAValider): void
    {
        $this->mailAValider = $emailAValider;
    }

    /**
     * Obtient la chaîne aléatoire (nonce) de l'entreprise.
     *
     * @return string Chaîne aléatoire (nonce) de l'entreprise.
     */
    public function getNonce(): string
    {
        return $this->nonce;
    }

    /**
     * Définit la chaîne aléatoire (nonce) de l'entreprise.
     *
     * @param string $nonce Nouvelle chaîne aléatoire (nonce) de l'entreprise.
     */
    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
    }

    /**
     * Formate les données de l'entreprise sous forme de tableau.
     *
     * @return array Tableau contenant les données de l'entreprise.
     */
    public function formatTableau(): array
    {
        return [
            "siretTag" => $this->siret,
            "nomEntrepriseTag" => $this->nomEntreprise,
            "codePostalEntrepriseTag" => $this->codePostalEntreprise,
            "effectifEntrepriseTag" => $this->effectifEntreprise,
            "telephoneEntrepriseTag" => $this->telephoneEntreprise,
            "siteWebEntrepriseTag" => $this->siteWebEntreprise,
            "estValideTag" => ($this->estValide) ? '1' : '0',
            "mailEntrepriseTag" => $this->mailEntreprise,
            "mdpHacheTag" => $this->mdpHache,
            "mailAValiderTag" => $this->mailAValider,
            "nonceTag" => $this->nonce
        ];
    }

    /**
     * Construit une instance de la classe Entreprise depuis un formulaire.
     *
     * @param array $tableauFormulaire Tableau contenant les données du formulaire.
     *
     * @return Entreprise Instance de la classe Entreprise.
     */
    public static function construireDepuisFormulaire(array $tableauFormulaire): Entreprise
    {
        if (ConnexionUtilisateur::estConnecte()) {
            $mail = $tableauFormulaire["mail"];
            $mailValide = "";
            $nonce = "";
            $mdpHache = $tableauFormulaire["password"];
        } else {
            $mail = "";
            $mailValide = $tableauFormulaire["mail"];
            $nonce = MotDePasse::genererChaineAleatoire();
            $mdpHache = MotDePasse::hacher($tableauFormulaire["password"]);
        }

        return new Entreprise(
            $tableauFormulaire["siret"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["postcode"],
            $tableauFormulaire["effectif"],
            $tableauFormulaire["telephone"],
            $tableauFormulaire["website"],
            $mail,
            $mdpHache,
            $mailValide,
            $nonce
        );
    }

    /**
     * Obtient la liste des méthodes de type setter disponibles pour la classe Entreprise.
     *
     * @return array Liste des méthodes de type setter.
     */
    public function getSetters(): array
    {
        return [
            "siret" => "setSiret",
            "nomEntreprise" => "setNomEntreprise",
            "codePostalEntreprise" => "setCodePostalEntreprise",
            "effectifEntreprise" => "setEffectifEntreprise",
            "telephoneEntreprise" => "setTelephoneEntreprise",
            "siteWebEntreprise" => "setSiteWebEntreprise",
            "estValide" => "setEstValide",
            "mailEntreprise" => "setMailEntreprise",
            "mdpHache" => "setMdpHache",
            "mailAValider" => "setMailAValider",
            "nonce" => "setNonce",
        ];
    }
}
