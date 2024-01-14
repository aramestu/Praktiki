<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Annotation représente une annotation associée à une entreprise par un enseignant.
 */
class Annotation extends AbstractDataObject
{

    private string $idAnnotation;
    private string $siret;
    private string $mailEnseignant;
    private string $contenu;
    private string $dateAnnotation;
    private bool $estVisibleEtudiant;

    /**
     * Constructeur de la classe Annotation.
     *
     * @param string $siret Le numéro SIRET de l'entreprise associée à l'annotation.
     * @param string $mailEnseignant L'adresse e-mail de l'enseignant ayant créé l'annotation.
     * @param string $contenu Le contenu de l'annotation.
     * @param bool $estVisibleEtudiant Indique si l'annotation est visible par les étudiants.
     */
    public function __construct(string $siret, string $mailEnseignant, string $contenu, bool $estVisibleEtudiant)
    {
        $this->siret = $siret;
        $this->mailEnseignant = $mailEnseignant;
        $this->contenu = $contenu;
        $this->estVisibleEtudiant = $estVisibleEtudiant;
        $this->idAnnotation = "";
        $this->dateAnnotation = "";
    }

    /**
     * Getter pour l'identifiant de l'annotation.
     *
     * @return int L'identifiant de l'annotation.
     */
    public function getIdAnnotation(): int
    {
        return $this->idAnnotation;
    }

    /**
     * Setter pour l'identifiant de l'annotation.
     *
     * @param int $idAnnotation Le nouvel identifiant de l'annotation.
     */
    public function setIdAnnotation(int $idAnnotation): void
    {
        $this->idAnnotation = $idAnnotation;
    }

    /**
     * Getter pour le numéro SIRET de l'entreprise associée à l'annotation.
     *
     * @return string Le numéro SIRET de l'entreprise associée à l'annotation.
     */
    public function getSiret(): string
    {
        return $this->siret;
    }

    /**
     * Setter pour le numéro SIRET de l'entreprise associée à l'annotation.
     *
     * @param string $siret Le nouveau numéro SIRET de l'entreprise associée à l'annotation.
     */
    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    /**
     * Getter pour l'adresse e-mail de l'enseignant ayant créé l'annotation.
     *
     * @return string L'adresse e-mail de l'enseignant ayant créé l'annotation.
     */
    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    /**
     * Setter pour l'adresse e-mail de l'enseignant ayant créé l'annotation.
     *
     * @param string $mailEnseignant La nouvelle adresse e-mail de l'enseignant ayant créé l'annotation.
     */
    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    /**
     * Getter pour le contenu de l'annotation.
     *
     * @return string Le contenu de l'annotation.
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * Setter pour le contenu de l'annotation.
     *
     * @param string $contenu Le nouveau contenu de l'annotation.
     */
    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * Getter pour la date de création de l'annotation.
     *
     * @return string La date de création de l'annotation.
     */
    public function getDateAnnotation(): string
    {
        return $this->dateAnnotation;
    }

    /**
     * Setter pour la date de création de l'annotation.
     *
     * @param string $dateAnnotation La nouvelle date de création de l'annotation.
     */
    public function setDateAnnotation(string $dateAnnotation): void
    {
        $this->dateAnnotation = $dateAnnotation;
    }

    /**
     * Getter pour savoir si l'annotation est visible par les étudiants.
     *
     * @return bool True si l'annotation est visible, sinon False.
     */
    public function getEstVisibleEtudiant(): bool
    {
        return $this->estVisibleEtudiant;
    }

    /**
     * Setter pour indiquer si l'annotation est visible par les étudiants.
     *
     * @param bool $estVisibleEtudiant True si l'annotation est visible, sinon False.
     */
    public function setEstVisibleEtudiant(bool $estVisibleEtudiant): void
    {
        $this->estVisibleEtudiant = $estVisibleEtudiant;
    }

    /**
     * Méthode pour formater l'objet sous forme de tableau.
     *
     * @return array Un tableau représentant l'objet.
     */
    public function formatTableau(): array
    {
        return [
            "idAnnotationTag" => $this->idAnnotation,
            "siretTag" => $this->siret,
            "mailEnseignantTag" => $this->mailEnseignant,
            "contenuTag" => $this->contenu,
            "dateAnnotationTag" => $this->dateAnnotation,
            "estVisibleEtudiantTag" => $this->estVisibleEtudiant ? 1 : 0
        ];
    }

    /**
     * Méthode pour obtenir les setters de l'objet.
     *
     * @return array Un tableau contenant les noms des setters de l'objet.
     */
    public function getSetters(): array
    {
        return [
            "idAnnotation" => "setIdAnnotation",
            "siret" => "setSiret",
            "mailEnseignant" => "setMailEnseignant",
            "contenu" => "setContenu",
            "dateAnnotation" => "setDateAnnotation",
            "estVisibleEtudiant" => "setEstVisibleEtudiant",
        ];
    }
}
