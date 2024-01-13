<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Personnel représente un personnel.
 *
 * @package App\SAE\Model\DataObject
 */
class Personnel extends AbstractDataObject
{
    /**
     * @var string Adresse e-mail du personnel.
     */
    private string $mailPersonnel;

    /**
     * @var string Nom du personnel.
     */
    private string $nomPersonnel;

    /**
     * @var string Prénom du personnel.
     */
    private string $prenomPersonnel;
    

    /**
     * Constructeur de la classe Personnel.
     *
     * @param string $mailPersonnel Adresse e-mail du personnel.
     * @param string $nomPersonnel Nom du personnel.
     * @param string $prenomPersonnel Prénom du personnel.
     */
    public function __construct(string $mailPersonnel, string $nomPersonnel, string $prenomPersonnel)
    {
        $this->mailPersonnel = $mailPersonnel;
        $this->nomPersonnel = $nomPersonnel;
        $this->prenomPersonnel = $prenomPersonnel;
    }

    /**
     * Obtient l'adresse e-mail du personnel.
     *
     * @return string Adresse e-mail du personnel.
     */
    public function getMailPersonnel(): string
    {
        return $this->mailPersonnel;
    }

    /**
     * Obtient le nom du personnel.
     *
     * @return string Nom du personnel.
     */
    public function getNomPersonnel(): string
    {
        return $this->nomPersonnel;
    }

    /**
     * Obtient le prénom du personnel.
     *
     * @return string Prénom du personnel.
     */
    public function getPrenomPersonnel(): string
    {
        return $this->prenomPersonnel;
    }

    /**
     * Définit l'adresse e-mail du personnel.
     *
     * @param string $mailPersonnel Nouvelle adresse e-mail du personnel.
     */
    public function setMailPersonnel(string $mailPersonnel): void
    {
        $this->mailPersonnel = $mailPersonnel;
    }

    /**
     * Définit le nom du personnel.
     *
     * @param string $nomPersonnel Nouveau nom du personnel.
     */
    public function setNomPersonnel(string $nomPersonnel): void
    {
        $this->nomPersonnel = $nomPersonnel;
    }

    /**
     * Définit le prénom du personnel.
     *
     * @param string $prenomPersonnel Nouveau prénom du personnel.
     */
    public function setPrenomPersonnel(string $prenomPersonnel): void
    {
        $this->prenomPersonnel = $prenomPersonnel;
    }

    /**
     * Formate les données du personnel sous forme de tableau.
     *
     * @return array Tableau contenant les données du personnel.
     */
    public function formatTableau(): array
    {
        return [
            "mailPersonnelTag" => $this->mailPersonnel,
            "nomPersonnelTag" => $this->nomPersonnel,
            "prenomPersonnelTag" => $this->prenomPersonnel
        ];
    }

    /**
     * Construit une instance de la classe Personnel depuis un formulaire.
     *
     * @param array $tableauFormulaire Tableau contenant les données du formulaire.
     *
     * @return Personnel Instance de la classe Personnel.
     */
    public static function construireDepuisFormulaire(array $tableauFormulaire): Personnel
    {
        return new Personnel(
            $tableauFormulaire["mail"],
            $tableauFormulaire["nom"],
            $tableauFormulaire["prenom"]
        );
    }

    /**
     * Obtient la liste des méthodes de type setter disponibles pour la classe Personnel.
     *
     * @return array Liste des méthodes de type setter.
     */
    public function getSetters(): array
    {
        return [
            "mailPersonnel" => "setMailPersonnel",
            "nomPersonnel" => "setNomPersonnel",
            "prenomPersonnel" => "setPrenomPersonnel"
        ];
    }
}
