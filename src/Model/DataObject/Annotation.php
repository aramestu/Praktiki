<?php

namespace App\SAE\Model\DataObject;

class Annotation extends AbstractDataObject {

    private string $idAnnotation;
    private string $siret;
    private string $mailEnseignant;
    private string $contenu;
    private string $dateAnnotation;
    private bool $estVisibleEtudiant;

    /**
     * @param string $siret
     * @param string $mailEnseignant
     * @param string $contenu
     * @param bool $estVisibleEtudiant
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

    public function getIdAnnotation(): int
    {
        return $this->idAnnotation;
    }

    public function setIdAnnotation(int $idAnnotation): void
    {
        $this->idAnnotation = $idAnnotation;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    public function getDateAnnotation(): string
    {
        return $this->dateAnnotation;
    }

    public function setDateAnnotation(string $dateAnnotation): void
    {
        $this->dateAnnotation = $dateAnnotation;
    }

    public function getEstVisibleEtudiant(): bool
    {
        return $this->estVisibleEtudiant;
    }

    public function setEstVisibleEtudiant(bool $estVisibleEtudiant): void
    {
        $this->estVisibleEtudiant = $estVisibleEtudiant;
    }

    public function formatTableau(): array {
        return array(
            "idAnnotationTag" => $this->idAnnotation,
            "siretTag" => $this->siret,
            "mailEnseignantTag" => $this->mailEnseignant,
            "contenuTag" => $this->contenu,
            "dateAnnotationTag" => $this->dateAnnotation,
            "estVisibleEtudiantTag" => $this->estVisibleEtudiant?1:0
        );
    }

    public function getSetters(): array {
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