<?php

namespace App\SAE\Model\DataObject;

class Alternance extends ExperienceProfessionnel
{
    public function __construct(string $sujet, string $thematique, string $taches,string $niveau , string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret, string $commentaireProfesseur)
    {
        parent::__construct($sujet, $thematique, $taches, $niveau, $codePostal, $adresse, $dateDebut, $dateFin, $siret, $commentaireProfesseur);

    }


    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array()); // test
    }

    public function getNomExperienceProfessionnel(): string
    {
        return "Alternance";
    }
}