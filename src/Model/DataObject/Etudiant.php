<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Etudiant représente un étudiant.
 *
 * @package App\SAE\Model\DataObject
 */
class Etudiant extends AbstractDataObject
{
    /**
     * @var string Numéro de l'étudiant.
     */
    private string $numEtudiant;

    /**
     * @var string Prénom de l'étudiant.
     */
    private string $prenomEtudiant;

    /**
     * @var string Nom de l'étudiant.
     */
    private string $nomEtudiant;

    /**
     * @var string Adresse e-mail personnelle de l'étudiant.
     */
    private string $mailPersoEtudiant;

    /**
     * @var string Adresse e-mail universitaire de l'étudiant.
     */
    private string $mailUniversitaireEtudidant;

    /**
     * @var string Numéro de téléphone de l'étudiant.
     */
    private string $telephoneEtudiant;

    /**
     * @var string Code postal de l'étudiant.
     */
    private string $codePostalEtudiant;

    /**
     * Constructeur de la classe Etudiant.
     *
     * @param string $numEtudiant Numéro de l'étudiant.
     * @param string $prenomEtudiant Prénom de l'étudiant.
     * @param string $nomEtudiant Nom de l'étudiant.
     * @param string $mailPersoEtudiant Adresse e-mail personnelle de l'étudiant.
     * @param string $mailUniversitaireEtudidant Adresse e-mail universitaire de l'étudiant.
     * @param string $telephoneEtudiant Numéro de téléphone de l'étudiant.
     * @param string $codePostalEtudiant Code postal de l'étudiant.
     */
    public function __construct(
        string $numEtudiant,
        string $prenomEtudiant,
        string $nomEtudiant,
        string $mailPersoEtudiant,
        string $mailUniversitaireEtudidant,
        string $telephoneEtudiant,
        string $codePostalEtudiant
    ) {
        $this->numEtudiant = $numEtudiant;
        $this->prenomEtudiant = $prenomEtudiant;
        $this->nomEtudiant = $nomEtudiant;
        $this->mailPersoEtudiant = $mailPersoEtudiant;
        $this->mailUniversitaireEtudidant = $mailUniversitaireEtudidant;
        $this->telephoneEtudiant = $telephoneEtudiant;
        $this->codePostalEtudiant = $codePostalEtudiant;
    }

    /**
     * Obtient le numéro de l'étudiant.
     *
     * @return string Numéro de l'étudiant.
     */
    public function getNumEtudiant(): string
    {
        return $this->numEtudiant;
    }

    /**
     * Définit le numéro de l'étudiant.
     *
     * @param string $numEtudiant Nouveau numéro de l'étudiant.
     */
    public function setNumEtudiant(string $numEtudiant): void
    {
        $this->numEtudiant = $numEtudiant;
    }

    /**
     * Obtient le prénom de l'étudiant.
     *
     * @return string Prénom de l'étudiant.
     */
    public function getPrenomEtudiant(): string
    {
        return $this->prenomEtudiant;
    }

    /**
     * Définit le prénom de l'étudiant.
     *
     * @param string $prenomEtudiant Nouveau prénom de l'étudiant.
     */
    public function setPrenomEtudiant(string $prenomEtudiant): void
    {
        $this->prenomEtudiant = $prenomEtudiant;
    }

    /**
     * Obtient le nom de l'étudiant.
     *
     * @return string Nom de l'étudiant.
     */
    public function getNomEtudiant(): string
    {
        return $this->nomEtudiant;
    }

    /**
     * Définit le nom de l'étudiant.
     *
     * @param string $nomEtudiant Nouveau nom de l'étudiant.
     */
    public function setNomEtudiant(string $nomEtudiant): void
    {
        $this->nomEtudiant = $nomEtudiant;
    }

    /**
     * Obtient l'adresse e-mail personnelle de l'étudiant.
     *
     * @return string Adresse e-mail personnelle de l'étudiant.
     */
    public function getMailPersoEtudiant(): string
    {
        return $this->mailPersoEtudiant;
    }

    /**
     * Définit l'adresse e-mail personnelle de l'étudiant.
     *
     * @param string $mailPersoEtudiant Nouvelle adresse e-mail personnelle de l'étudiant.
     */
    public function setMailPersoEtudiant(string $mailPersoEtudiant): void
    {
        $this->mailPersoEtudiant = $mailPersoEtudiant;
    }

    /**
     * Obtient l'adresse e-mail universitaire de l'étudiant.
     *
     * @return string Adresse e-mail universitaire de l'étudiant.
     */
    public function getMailUniversitaireEtudiant(): string
    {
        return $this->mailUniversitaireEtudidant;
    }

    /**
     * Définit l'adresse e-mail universitaire de l'étudiant.
     *
     * @param string $mailUniversitaireEtuidant Nouvelle adresse e-mail universitaire de l'étudiant.
     */
    public function setMailUniversitaireEtudiant(string $mailUniversitaireEtuidant): void
    {
        $this->mailUniversitaireEtudidant = $mailUniversitaireEtuidant;
    }

    /**
     * Obtient le numéro de téléphone de l'étudiant.
     *
     * @return string Numéro de téléphone de l'étudiant.
     */
    public function getTelephoneEtudiant(): string
    {
        return $this->telephoneEtudiant;
    }

    /**
     * Définit le numéro de téléphone de l'étudiant.
     *
     * @param string $telephoneEtudiant Nouveau numéro de téléphone de l'étudiant.
     */
    public function setTelephoneEtudiant(string $telephoneEtudiant): void
    {
        $this->telephoneEtudiant = $telephoneEtudiant;
    }

    /**
     * Obtient le code postal de l'étudiant.
     *
     * @return string Code postal de l'étudiant.
     */
    public function getCodePostalEtudiant(): string
    {
        return $this->codePostalEtudiant;
    }

    /**
     * Définit le code postal de l'étudiant.
     *
     * @param string $codePostalEtudiant Nouveau code postal de l'étudiant.
     */
    public function setCodePostalEtudiant(string $codePostalEtudiant): void
    {
        $this->codePostalEtudiant = $codePostalEtudiant;
    }

    /**
     * Formatte les données de l'étudiant sous forme de tableau.
     *
     * @return array Tableau contenant les données de l'étudiant.
     */
    public function formatTableau(): array
    {
        return array(
            "numEtudiantTag" => $this->numEtudiant,
            "prenomEtudiantTag" => $this->prenomEtudiant,
            "nomEtudiantTag" => $this->nomEtudiant,
            "mailPersoEtudiantTag" => $this->mailPersoEtudiant,
            "mailUniversitaireEtudiantTag" => $this->mailUniversitaireEtudidant,
            "telephoneEtudiantTag" => $this->telephoneEtudiant,
            "codePostalEtudiantTag" => $this->codePostalEtudiant
        );
    }

    /**
     * Construit une instance de la classe Etudiant depuis un formulaire.
     *
     * @param array $tableauFormulaire Tableau contenant les données du formulaire.
     *
     * @return Etudiant Instance de la classe Etudiant.
     */
    public static function construireDepuisFormulaire(array $tableauFormulaire): Etudiant
    {
        return new Etudiant(
            $tableauFormulaire["num"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["prenom"],
            $tableauFormulaire["mailPerso"],
            $tableauFormulaire["mailUniv"],
            $tableauFormulaire["telephone"],
            $tableauFormulaire["postcode"]
        );
    }

    /**
     * Obtient la liste des méthodes de type setter disponibles pour la classe Etudiant.
     *
     * @return array Liste des méthodes de type setter.
     */
    public function getSetters(): array
    {
        return [
            "numEtudiant" => "setNumEtudiant",
            "prenomEtudiant" => "setPrenomEtudiant",
            "nomEtudiant" => "setNomEtudiant",
            "mailPersoEtudiant" => "setMailPersoEtudiant",
            "mailUniversitaireEtudiant" => "setMailUniversitaireEtudiant",
            "telephoneEtudiant" => "setTelephoneEtudiant",
            "codePostalEtudiant" => "setCodePostalEtudiant"
        ];
    }
}
