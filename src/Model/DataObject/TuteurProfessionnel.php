<?php
namespace App\SAE\Model\DataObject;

class TuteurProfessionnel extends AbstractDataObject
{
    private string $mailTuteurProfessionnel;
    private string $prenomTuteurProfessionnel;
    private string $nomTuteurProfessionnel;
    private string $fonctionTuteurProfessionnel;
    private string $telephoneTuteur;


    public function __construct(string $mailTuteurProfessionnel, string $prenomTuteurProfessionnel, string $nomTuteurProfessionnel
        , string $fonctionTuteurProfessionnel, string $telephoneTuteur)
    {
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
        $this->telephoneTuteur = $telephoneTuteur;

    }

}

