<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Enseignant représente un enseignant.
 *
 * @package App\SAE\Model\DataObject
 */
class Enseignant extends AbstractDataObject
{
    /**
     * @var string Adresse e-mail de l'enseignant.
     */
    private string $mailEnseignant;

    /**
     * @var string Nom de l'enseignant.
     */
    private string $nomEnseignant;

    /**
     * @var string Prénom de l'enseignant.
     */
    private string $prenomEnseignant;

    /**
     * @var bool Indique si l'enseignant est administrateur.
     */
    private bool $estAdmin;

    /**
     * Constructeur de la classe Enseignant.
     *
     * @param string $mailEnseignant Adresse e-mail de l'enseignant.
     * @param string $nomEnseignant Nom de l'enseignant.
     * @param string $prenomEnseignant Prénom de l'enseignant.
     * @param bool $estAdmin Indique si l'enseignant est administrateur.
     */
    public function __construct(string $mailEnseignant, string $nomEnseignant, string $prenomEnseignant, bool $estAdmin)
    {
        $this->mailEnseignant = $mailEnseignant;
        $this->nomEnseignant = $nomEnseignant;
        $this->prenomEnseignant = $prenomEnseignant;
        $this->estAdmin = $estAdmin;
    }

    /**
     * Obtient l'adresse e-mail de l'enseignant.
     *
     * @return string Adresse e-mail de l'enseignant.
     */
    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    /**
     * Obtient le nom de l'enseignant.
     *
     * @return string Nom de l'enseignant.
     */
    public function getNomEnseignant(): string
    {
        return $this->nomEnseignant;
    }

    /**
     * Obtient le prénom de l'enseignant.
     *
     * @return string Prénom de l'enseignant.
     */
    public function getPrenomEnseignant(): string
    {
        return $this->prenomEnseignant;
    }

    /**
     * Définit l'adresse e-mail de l'enseignant.
     *
     * @param string $mailEnseignant Nouvelle adresse e-mail de l'enseignant.
     */
    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    /**
     * Définit le nom de l'enseignant.
     *
     * @param string $nomEnseignant Nouveau nom de l'enseignant.
     */
    public function setNomEnseignant(string $nomEnseignant): void
    {
        $this->nomEnseignant = $nomEnseignant;
    }

    /**
     * Définit le prénom de l'enseignant.
     *
     * @param string $prenomEnseignant Nouveau prénom de l'enseignant.
     */
    public function setPrenomEnseignant(string $prenomEnseignant): void
    {
        $this->prenomEnseignant = $prenomEnseignant;
    }

    /**
     * Vérifie si l'enseignant est administrateur.
     *
     * @return bool True si l'enseignant est administrateur, false sinon.
     */
    public function isEstAdmin(): bool
    {
        return $this->estAdmin;
    }

    /**
     * Définit si l'enseignant est administrateur.
     *
     * @param bool $estAdmin Nouvelle valeur pour le statut administrateur.
     */
    public function setEstAdmin(bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
    }

    /**
     * Formate les données de l'enseignant sous forme de tableau.
     *
     * @return array Tableau contenant les données de l'enseignant.
     */
    public function formatTableau(): array
    {
        $bool = ($this->estAdmin) ? 1 : 0;
        return [
            "mailEnseignantTag" => $this->mailEnseignant,
            "nomEnseignantTag" => $this->nomEnseignant,
            "prenomEnseignantTag" => $this->prenomEnseignant,
            "estAdminTag" => $bool
        ];
    }

    /**
     * Construit une instance de la classe Enseignant depuis un formulaire.
     *
     * @param array $tableauFormulaire Tableau contenant les données du formulaire.
     *
     * @return Enseignant Instance de la classe Enseignant.
     */
    public static function construireDepuisFormulaire(array $tableauFormulaire): Enseignant
    {
        $bool = (isset($tableauFormulaire["estAdmin"]) && $tableauFormulaire["estAdmin"] == "on");
        return new Enseignant(
            $tableauFormulaire["mail"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["prenom"],
            $bool
        );
    }

    /**
     * Obtient la liste des méthodes de type setter disponibles pour la classe Enseignant.
     *
     * @return array Liste des méthodes de type setter.
     */
    public function getSetters(): array
    {
        return [
            "mailEnseignant" => "setMailEnseignant",
            "nomEnseignant" => "setNomEnseignant",
            "prenomEnseignant" => "setPrenomEnseignant",
            "estAdmin" => "setEstAdmin",
        ];
    }
}
