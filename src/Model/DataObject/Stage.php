<?php

namespace App\SAE\Model\DataObject;

class Stage extends ExperienceProfessionnel
{
    private float $gratificationStage;

    public function __construct(string $sujet, string $thematique, string $taches, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret, float $gratification)
    {
        parent::__construct($sujet, $thematique, $taches, $codePostal, $adresse, $dateDebut, $dateFin, $siret);
        $this->gratificationStage = $gratification;
    }

    public function getGratificationStage(): float
    {
        return $this->gratificationStage;
    }

    public function setGratificationStage(float $gratificationStage): void
    {
        $this->gratificationStage = $gratificationStage;
    }

    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array(
            "gratificationStageTag" => $this->gratificationStage
        ));
    }

    public function getNomExperienceProfessionnel(): string
    {
        return "Stage";
    }
}