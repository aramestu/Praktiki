<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceEtudiant implements ServiceInterface {

    public static function mettreAJour(Etudiant|AbstractDataObject $etudiant, array $attributs): void{
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