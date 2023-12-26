<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;

class ServiceOffreNonDefini implements ServiceInterface {

    public static function mettreAJour(OffreNonDefini|AbstractDataObject $offreNonDefini, array $attributs): void {
        ServiceExperienceProfessionnel::mettreAJour($offreNonDefini, $attributs);
    }
}