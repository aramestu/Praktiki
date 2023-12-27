<?php

namespace App\SAE\Model\DataObject;

class Alternance extends ExperienceProfessionnel{
    public function __construct(string $sujet, string $thematique, string $taches,string $niveau , string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret)
    {
        parent::__construct($sujet, $thematique, $taches, $niveau, $codePostal, $adresse, $dateDebut, $dateFin, $siret);

    }


    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array()); // test
    }

    public function getNomExperienceProfessionnel(): string {
        return "Alternance";
    }

    public function getSetters(): array {
        return array_merge(parent::getSetters(), array());

    }

}