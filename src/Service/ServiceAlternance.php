<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceAlternance extends AbstractService {
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}