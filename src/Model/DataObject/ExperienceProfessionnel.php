<?php
namespace App\SAE\Model\DataObject;

abstract class ExperienceProfessionnel extends AbstractDataObject {

    private string $id;
    private string $sujet;
    private string $thematique;
    private string $taches;
    private string $codePostal;
    private string $adresse;
    private string $dateDebut;
    private string $dateFin;
    private string $siret;
    private string $etudiant;
    private string $enseignant;
    private string $tuteurProfessionnel;

    private string $datePublication;


    public function __construct(
          string $sujet,
          string $thematique,
          string $taches,
          string $codePostal,
          string $adresse,
          string $dateDebut,
          string $dateFin,
          string $siret
       ) {
        $this->sujet = $sujet;
        $this->thematique = $thematique;
        $this->taches = $taches;
        $this->codePostal = $codePostal;
        $this->adresse = $adresse;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->siret = $siret;
        }
    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getSujet(): string {
        return $this->sujet;
    }

    public function setSujet(string $sujet): void {
        $this->sujet = $sujet;
    }

    public function getThematique(): string {
        return $this->thematique;
    }

    public function setThematique(string $thematique): void {
        $this->thematique = $thematique;
    }

    public function getTaches(): string {
        return $this->taches;
    }

    public function setTaches(string $taches): void {
        $this->taches = $taches;
    }

    public function getCodePostal(): string {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function getDateDebut(): string {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): void {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(): string {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): void {
        $this->dateFin = $dateFin;
    }

    public function getSiret(): string {
        return $this->siret;
    }

    public function setSiret(string $siret): void {
        $this->siret = $siret;
    }

    public function getEtudiant(): string {
        return $this->etudiant;
    }

    public function setEtudiant(string $etudiant): void {
        $this->etudiant = $etudiant;
    }

    public function getEnseignant(): string {
        return $this->enseignant;
    }

    public function setEnseignant(string $enseignant): void {
        $this->enseignant = $enseignant;
    }

    public function getTuteurProfessionnel(): string {
        return $this->tuteurProfessionnel;
    }

    public function setTuteurProfessionnel(string $tuteurProfessionnel): void {
        $this->tuteurProfessionnel = $tuteurProfessionnel;
    }

    public function getDatePublication(): string {
        return $this->datePublication;
    }

    public function setDatePublication(string $datePublication): void {
        $this->datePublication = $datePublication;
    }

}
?>