<?php

namespace App\SAE\Model\DataObject;

/**
 * Classe représentant un stage.
 *
 * @package App\SAE\Model\DataObject
 */
class Stage extends ExperienceProfessionnel
{
    /**
     * La gratification du stage.
     *
     * @var float
     */
    private float $gratificationStage;

    /**
     * Constructeur de la classe Stage.
     *
     * @param string $sujet Le sujet du stage.
     * @param string $thematique La thématique du stage.
     * @param string $taches Les tâches du stage.
     * @param string $niveau Le niveau du stage.
     * @param string $codePostal Le code postal du lieu du stage.
     * @param string $adresse L'adresse du lieu du stage.
     * @param string $dateDebut La date de début du stage.
     * @param string $dateFin La date de fin du stage.
     * @param string $siret Le numéro SIRET associé au lieu du stage.
     * @param float $gratification La gratification du stage.
     */
    public function __construct(string $sujet, string $thematique, string $taches, string $niveau, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret, float $gratification)
    {
        parent::__construct($sujet, $thematique, $taches, $niveau, $codePostal, $adresse, $dateDebut, $dateFin, $siret);
        $this->gratificationStage = $gratification;
    }

    /**
     * Obtient la gratification du stage.
     *
     * @return float La gratification du stage.
     */
    public function getGratificationStage(): float
    {
        return $this->gratificationStage;
    }

    /**
     * Définit la gratification du stage.
     *
     * @param float $gratificationStage La gratification du stage.
     */
    public function setGratificationStage(float $gratificationStage): void
    {
        $this->gratificationStage = $gratificationStage;
    }

    /**
     * Formate les données du stage sous forme de tableau.
     *
     * @return array Les données formatées.
     */
    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array(
            "gratificationStageTag" => $this->gratificationStage
        ));
    }

    /**
     * Obtient le nom du type d'expérience professionnelle, ici "Stage".
     *
     * @return string Le nom du type d'expérience professionnelle.
     */
    public function getNomExperienceProfessionnel(): string
    {
        return "Stage";
    }

    /**
     * Obtient les méthodes setters associées aux propriétés du stage.
     *
     * @return array Les méthodes setters.
     */
    public function getSetters(): array
    {
        return array_merge(parent::getSetters(), [
            "gratificationStage" => "setGratificationStage"
        ]);
    }
}
