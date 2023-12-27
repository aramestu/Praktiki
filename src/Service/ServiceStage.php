<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\StageRepository;

class ServiceStage extends AbstractService {
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}