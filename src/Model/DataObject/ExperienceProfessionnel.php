<?php

namespace App\SAE\Model\DataObject;

use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

/**
 * La classe ExperienceProfessionnel représente une expérience professionnelle.
 *
 * @package App\SAE\Model\DataObject
 */
class ExperienceProfessionnel extends AbstractDataObject
{
    /**
     * @var string Identifiant de l'expérience professionnelle.
     */
    private string $idExperienceProfessionnel;

    /**
     * @var string Sujet de l'expérience professionnelle.
     */
    private string $sujetExperienceProfessionnel;

    /**
     * @var string Thématique de l'expérience professionnelle.
     */
    private string $thematiqueExperienceProfessionnel;

    /**
     * @var string Tâches effectuées pendant l'expérience professionnelle.
     */
    private string $tachesExperienceProfessionnel;

    /**
     * @var string Niveau d'expérience professionnelle.
     */
    private string $niveauExperienceProfessionnel;

    /**
     * @var string Code postal de l'expérience professionnelle.
     */
    private string $codePostalExperienceProfessionnel;

    /**
     * @var string Adresse de l'expérience professionnelle.
     */
    private string $adresseExperienceProfessionnel;

    /**
     * @var string Date de début de l'expérience professionnelle.
     */
    private string $dateDebutExperienceProfessionnel;

    /**
     * @var string Date de fin de l'expérience professionnelle.
     */
    private string $dateFinExperienceProfessionnel;

    /**
     * @var string Numéro SIRET associé à l'expérience professionnelle.
     */
    private string $siret;

    /**
     * @var string Date de publication de l'expérience professionnelle.
     */
    private string $datePublication;

    /**
     * Constructeur de la classe ExperienceProfessionnel.
     *
     * @param string $sujet Sujet de l'expérience professionnelle.
     * @param string $thematique Thématique de l'expérience professionnelle.
     * @param string $taches Tâches effectuées pendant l'expérience professionnelle.
     * @param string $niveau Niveau d'expérience professionnelle.
     * @param string $codePostal Code postal de l'expérience professionnelle.
     * @param string $adresse Adresse de l'expérience professionnelle.
     * @param string $dateDebut Date de début de l'expérience professionnelle.
     * @param string $dateFin Date de fin de l'expérience professionnelle.
     * @param string $siret Numéro SIRET associé à l'expérience professionnelle.
     */
    public function __construct(
        string $sujet,
        string $thematique,
        string $taches,
        string $niveau,
        string $codePostal,
        string $adresse,
        string $dateDebut,
        string $dateFin,
        string $siret
    )
    {
        $this->sujetExperienceProfessionnel = $sujet;
        $this->thematiqueExperienceProfessionnel = $thematique;
        $this->tachesExperienceProfessionnel = $taches;
        $this->niveauExperienceProfessionnel = $niveau;
        $this->codePostalExperienceProfessionnel = $codePostal;
        $this->adresseExperienceProfessionnel = $adresse;
        $this->dateDebutExperienceProfessionnel = $dateDebut;
        $this->dateFinExperienceProfessionnel = $dateFin;
        $this->siret = $siret;
        $this->idExperienceProfessionnel = "";
        $this->datePublication = "";
    }

    /**
     * Obtient l'identifiant de l'expérience professionnelle.
     *
     * @return string Identifiant de l'expérience professionnelle.
     */
    public function getIdExperienceProfessionnel(): string
    {
        return $this->idExperienceProfessionnel;
    }

    /**
     * Définit l'identifiant de l'expérience professionnelle.
     *
     * @param string $idExperienceProfessionnel Nouvel identifiant de l'expérience professionnelle.
     */
    public function setIdExperienceProfessionnel(string $idExperienceProfessionnel): void
    {
        $this->idExperienceProfessionnel = $idExperienceProfessionnel;
    }

    /**
     * Obtient le sujet de l'expérience professionnelle.
     *
     * @return string Sujet de l'expérience professionnelle.
     */
    public function getSujetExperienceProfessionnel(): string
    {
        return $this->sujetExperienceProfessionnel;
    }

    /**
     * Définit le sujet de l'expérience professionnelle.
     *
     * @param string $sujetExperienceProfessionnel Nouveau sujet de l'expérience professionnelle.
     */
    public function setSujetExperienceProfessionnel(string $sujetExperienceProfessionnel): void
    {
        $this->sujetExperienceProfessionnel = $sujetExperienceProfessionnel;
    }

    /**
     * Obtient la thématique de l'expérience professionnelle.
     *
     * @return string Thématique de l'expérience professionnelle.
     */
    public function getThematiqueExperienceProfessionnel(): string
    {
        return $this->thematiqueExperienceProfessionnel;
    }

    /**
     * Définit la thématique de l'expérience professionnelle.
     *
     * @param string $thematiqueExperienceProfessionnel Nouvelle thématique de l'expérience professionnelle.
     */
    public function setThematiqueExperienceProfessionnel(string $thematiqueExperienceProfessionnel): void
    {
        $this->thematiqueExperienceProfessionnel = $thematiqueExperienceProfessionnel;
    }

    /**
     * Obtient les tâches effectuées pendant l'expérience professionnelle.
     *
     * @return string Tâches effectuées pendant l'expérience professionnelle.
     */
    public function getTachesExperienceProfessionnel(): string
    {
        return $this->tachesExperienceProfessionnel;
    }

    /**
     * Définit les tâches effectuées pendant l'expérience professionnelle.
     *
     * @param string $tachesExperienceProfessionnel Nouvelles tâches effectuées pendant l'expérience professionnelle.
     */
    public function setTachesExperienceProfessionnel(string $tachesExperienceProfessionnel): void
    {
        $this->tachesExperienceProfessionnel = $tachesExperienceProfessionnel;
    }

    /**
     * Obtient le niveau d'expérience professionnelle.
     *
     * @return string Niveau d'expérience professionnelle.
     */
    public function getNiveauExperienceProfessionnel(): string
    {
        return $this->niveauExperienceProfessionnel;
    }

    /**
     * Définit le niveau d'expérience professionnelle.
     *
     * @param string $niveauExperienceProfessionnel Nouveau niveau d'expérience professionnelle.
     */
    public function setNiveauExperienceProfessionnel(string $niveauExperienceProfessionnel): void
    {
        $this->niveauExperienceProfessionnel = $niveauExperienceProfessionnel;
    }

    /**
     * Obtient le code postal de l'expérience professionnelle.
     *
     * @return string Code postal de l'expérience professionnelle.
     */
    public function getCodePostalExperienceProfessionnel(): string
    {
        return $this->codePostalExperienceProfessionnel;
    }

    /**
     * Définit le code postal de l'expérience professionnelle.
     *
     * @param string $codePostalExperienceProfessionnel Nouveau code postal de l'expérience professionnelle.
     */
    public function setCodePostalExperienceProfessionnel(string $codePostalExperienceProfessionnel): void
    {
        $this->codePostalExperienceProfessionnel = $codePostalExperienceProfessionnel;
    }

    /**
     * Obtient l'adresse de l'expérience professionnelle.
     *
     * @return string Adresse de l'expérience professionnelle.
     */
    public function getAdresseExperienceProfessionnel(): string
    {
        return $this->adresseExperienceProfessionnel;
    }

    /**
     * Définit l'adresse de l'expérience professionnelle.
     *
     * @param string $adresseExperienceProfessionnel Nouvelle adresse de l'expérience professionnelle.
     */
    public function setAdresseExperienceProfessionnel(string $adresseExperienceProfessionnel): void
    {
        $this->adresseExperienceProfessionnel = $adresseExperienceProfessionnel;
    }

    /**
     * Obtient la date de début de l'expérience professionnelle.
     *
     * @return string Date de début de l'expérience professionnelle.
     */
    public function getDateDebutExperienceProfessionnel(): string
    {
        return $this->dateDebutExperienceProfessionnel;
    }

    /**
     * Définit la date de début de l'expérience professionnelle.
     *
     * @param string $dateDebutExperienceProfessionnel Nouvelle date de début de l'expérience professionnelle.
     */
    public function setDateDebutExperienceProfessionnel(string $dateDebutExperienceProfessionnel): void
    {
        $this->dateDebutExperienceProfessionnel = $dateDebutExperienceProfessionnel;
    }

    /**
     * Obtient la date de fin de l'expérience professionnelle.
     *
     * @return string Date de fin de l'expérience professionnelle.
     */
    public function getDateFinExperienceProfessionnel(): string
    {
        return $this->dateFinExperienceProfessionnel;
    }

    /**
     * Définir la date de fin de l'expérience professionnelle.
     *
     * @param string $dateFinExperienceProfessionnel La date de fin de l'expérience professionnelle.
     */
    public function setDateFinExperienceProfessionnel(string $dateFinExperienceProfessionnel): void
    {
        $this->dateFinExperienceProfessionnel = $dateFinExperienceProfessionnel;
    }

    /**
     * Obtenir le numéro SIRET associé à l'expérience professionnelle.
     *
     * @return string Le numéro SIRET.
     */
    public function getSiret(): string
    {
        return $this->siret;
    }

    /**
     * Définir le numéro SIRET associé à l'expérience professionnelle.
     *
     * @param string $siret Le numéro SIRET.
     */
    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    /**
     * Obtenir la date de publication de l'expérience professionnelle.
     *
     * @return string La date de publication.
     */
    public function getDatePublication(): string
    {
        return $this->datePublication;
    }

    /**
     * Définir la date de publication de l'expérience professionnelle.
     *
     * @param string $datePublication La date de publication.
     */
    public function setDatePublication(string $datePublication): void
    {
        $this->datePublication = $datePublication;
    }

    /**
     * Formater les données de l'expérience professionnelle sous forme de tableau.
     *
     * @return array Les données formatées.
     */
    public function formatTableau(): array
    {
        return array(
            "idExperienceProfessionnelTag" => $this->idExperienceProfessionnel,
            "sujetExperienceProfessionnelTag" => $this->sujetExperienceProfessionnel,
            "thematiqueExperienceProfessionnelTag" => $this->thematiqueExperienceProfessionnel,
            "tachesExperienceProfessionnelTag" => $this->tachesExperienceProfessionnel,
            "niveauExperienceProfessionnelTag" => $this->niveauExperienceProfessionnel,
            "codePostalExperienceProfessionnelTag" => $this->codePostalExperienceProfessionnel,
            "adresseExperienceProfessionnelTag" => $this->adresseExperienceProfessionnel,
            "dateDebutExperienceProfessionnelTag" => $this->dateDebutExperienceProfessionnel,
            "dateFinExperienceProfessionnelTag" => $this->dateFinExperienceProfessionnel,
            "siretTag" => $this->siret,
            "datePublicationTag" => $this->datePublication
        );
    }

    /**
     * Obtenir le nom de l'expérience professionnelle.
     *
     * @return string Le nom de l'expérience professionnelle.
     */
    public function getNomExperienceProfessionnel(): string
    {
        return "ExperienceProfessionnel";
    }

    /**
     * Obtenir les méthodes setters associées aux propriétés de l'expérience professionnelle.
     *
     * @return array Les méthodes setters.
     */
    public function getSetters(): array
    {
        return [
            "idExperienceProfessionnel" => "setIdExperienceProfessionnel",
            "sujetExperienceProfessionnel" => "setSujetExperienceProfessionnel",
            "thematiqueExperienceProfessionnel" => "setThematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel" => "setTachesExperienceProfessionnel",
            "niveauExperienceProfessionnel" => "setNiveauExperienceProfessionnel",
            "codePostalExperienceProfessionnel" => "setCodePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel" => "setAdresseExperienceProfessionnel",
            "dateDebutExperienceProfessionnel" => "setDateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel" => "setDateFinExperienceProfessionnel",
            "siret" => "setSiret",
            "datePublication" => "setDatePublication",
        ];
    }
}