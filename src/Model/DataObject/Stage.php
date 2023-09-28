<?php
namespace App\SAE\Model\DataObject;

class Stage extends ExperienceProfessionnel {
    private float $gratification;

    public function __construct(string $sujet, string $thematique, string $taches, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret, float $gratification)
    {
        parent::__construct($sujet, $thematique, $taches, $codePostal, $adresse, $dateDebut, $dateFin, $siret);
        $this->gratification = $gratification;
    }

    public function getGratification(): float {
        return $this->gratification;
    }

    public function setGratification(float $gratification): void {
        $this->gratification = $gratification;
    }
}