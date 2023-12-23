<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EtudiantRepository;

class ServiceEtudiant {

    public static function miseAJour(Etudiant $etudiant, array $attributs){
        if(isset($attributs["numEtudiant"])){
            $etudiant->setNumEtudiant($attributs["numEtudiant"]);
        }
        if(isset($attributs["prenomEtudiant"])){
            $etudiant->setPrenomEtudiant($attributs["numEtudiant"]);
        }
        if(isset($attributs["nomEtudiant"])){
            $etudiant->setNomEtudiant($attributs["nomEtudiant"]);
        }
        if(isset($attributs["mailPersoEtudiant"])){
            $etudiant->setMailPersoEtudiant($attributs["mailPersoEtudiant"]);
        }
        if(isset($attributs["mailUniversitaireEtudidant"])){
            $etudiant->setMailUniversitaireEtudiant($attributs["mailUniversitaireEtudidant"]);
        }
        if(isset($attributs["telephoneEtudiant"])){
            $etudiant->setTelephoneEtudiant($attributs["telephoneEtudiant"]);
        }
        if(isset($attributs["codePostalEtudiant"])){
            $etudiant->setCodePostalEtudiant($attributs["codePostalEtudiant"]);
        }

        (new EtudiantRepository())->mettreAJour($etudiant);
    }

}