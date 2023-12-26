<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\StageRepository;

class ServiceStage implements ServiceInterface {

    public static function mettreAJour(Stage|AbstractDataObject $stage, array $attributs): void{
        if(isset($attributs["gratificationStage"])){
            $stage->setGratificationStage($attributs["gratificationStage"]);
        }
        ServiceExperienceProfessionnel::mettreAJour($stage, $attributs);
    }
}