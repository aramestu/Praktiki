<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\EntrepriseRepository;

class ServiceEntreprise extends AbstractService {
    public function getRepository(): string {
        return "EntrepriseRepository";
    }
}