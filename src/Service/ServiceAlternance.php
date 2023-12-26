<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceAlternance implements ServiceInterface {

    public static function mettreAJour(Alternance|AbstractDataObject $alternance, array $attributs): void{
        ServiceExperienceProfessionnel::mettreAJour($alternance, $attributs);
    }
}