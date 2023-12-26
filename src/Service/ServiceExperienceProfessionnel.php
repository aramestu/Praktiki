<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceExperienceProfessionnel implements ServiceInterface {

    public  static function mettreAJour(ExperienceProfessionnel|AbstractDataObject $experienceProfessionnel, array $attributs): void{
        if(isset($attributs["idExperienceProfessionnel"])){
            $experienceProfessionnel->setIdExperienceProfessionnel($attributs["idExperienceProfessionnel"]);
        }

        if(isset($attributs["sujetExperienceProfessionnel"])){
            $experienceProfessionnel->setSujetExperienceProfessionnel($attributs["sujetExperienceProfessionnel"]);
        }

        if(isset($attributs["thematiqueExperienceProfessionnel"])){
            $experienceProfessionnel->setThematiqueExperienceProfessionnel($attributs["thematiqueExperienceProfessionnel"]);
        }

        if(isset($attributs["tachesExperienceProfessionnel"])){
            $experienceProfessionnel->setTachesExperienceProfessionnel($attributs["tachesExperienceProfessionnel"]);
        }

        if(isset($attributs["niveauExperienceProfessionnel"])){
            $experienceProfessionnel->setNiveauExperienceProfessionnel($attributs["niveauExperienceProfessionnel"]);
        }
        if(isset($attributs["codePostalExperienceProfessionnel"])){
            $experienceProfessionnel->setCodePostalExperienceProfessionnel($attributs["codePostalExperienceProfessionnel"]);
        }

        if(isset($attributs["adresseExperienceProfessionnel"])){
            $experienceProfessionnel->setAdresseExperienceProfessionnel($attributs["adresseExperienceProfessionnel"]);
        }

        if(isset($attributs["dateDebutExperienceProfessionnel"])){
            $experienceProfessionnel->setDateDebutExperienceProfessionnel($attributs["dateDebutExperienceProfessionnel"]);
        }

        if(isset($attributs["dateFinExperienceProfessionnel"])){
            $experienceProfessionnel->setDateFinExperienceProfessionnel($attributs["dateFinExperienceProfessionnel"]);
        }

        if(isset($attributs["siret"])){
            $experienceProfessionnel->setSiret($attributs["siret"]);
        }

        if(isset($attributs["datePublication"])){
            $experienceProfessionnel->setDatePublication($attributs["datePublication"]);
        }

        (new ExperienceProfessionnelRepository())->mettreAJour($experienceProfessionnel);
    }

}