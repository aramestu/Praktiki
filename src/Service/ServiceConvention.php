<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Convention;

class ServiceConvention extends AbstractService {

    public function getRepository(): string {
        return "ConventionRepository";
    }

}