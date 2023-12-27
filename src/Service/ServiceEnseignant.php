<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\Repository\EnseignantRepository;

class ServiceEnseignant extends AbstractService {
    public function getRepository(): string {
        return "EnseignantRepository";
    }
}