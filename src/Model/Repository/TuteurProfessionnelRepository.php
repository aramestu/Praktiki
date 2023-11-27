<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\TuteurProfessionnel;

class TuteurProfessionnelRepository extends AbstractRepository
{
    protected function getNomTable(): string
    {
        return "TuteurProfessionnel";
    }

    protected function construireDepuisTableau(array $TuteurProfessionnelFormatTableau): TuteurProfessionnel
    {
        $tuteur = new TuteurProfessionnel($TuteurProfessionnelFormatTableau["mailTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["prenomTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["nomTuteurProfessionnel"],
            $TuteurProfessionnelFormatTableau["fonctionTuteurProfessionnel"], $TuteurProfessionnelFormatTableau["telephoneTuteurProfessionnel"]);
        return $tuteur;
    }

    protected function getNomClePrimaire(): string
    {
        return "mailTuteurProfessionnel";
    }

    protected function getNomsColonnesCommunes(): array
    {
        return array("mailTuteurProfessionnel", "prenomTuteurProfessionnel", "nomTuteurProfessionnel", "fonctionTuteurProfessionnel", "telephoneTuteurProfessionnel");
    }
}
