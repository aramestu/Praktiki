<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

class ServiceExperienceProfessionnel extends AbstractService {
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}