<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\Repository\EnseignantRepository;

class ServiceEnseignant {

    public static function mettreAJour(Enseignant $enseignant, array $attributs): void{
        if(isset($attributs["mailEnseignant"])){
            $enseignant->setMailEnseignant($attributs["mailEnseignant"]);
        }
        if(isset($attributs["nomEnseignant"])){
            $enseignant->setNomEnseignant($attributs["nomEnseignant"]);
        }
        if(isset($attributs["prenomEnseignant"])){
            $enseignant->setPrenomEnseignant($attributs["prenomEnseignant"]);
        }
        if(isset($attributs["estAdmin"])){
            $enseignant->setEstAdmin($attributs["estAdmin"]);
        }

        (new EnseignantRepository())->mettreAJour($enseignant);
    }
}