<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;

class ServiceOffreNonDefini extends AbstractService {

    function getRepository(): string
    {
        return "OffreNonDefiniRepository";
    }
}