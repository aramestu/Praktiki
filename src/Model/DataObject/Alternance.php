<?php

namespace App\SAE\Model\DataObject;

class Alternance extends ExperienceProfessionnel
{
    public function __construct(string $sujet, string $thematique, string $taches, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret)
    {
        parent::__construct($sujet, $thematique, $taches, $codePostal, $adresse, $dateDebut, $dateFin, $siret);

    }
}