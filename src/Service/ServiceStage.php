<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\StageRepository;

/**
 * Service pour les Stages.
 */
class ServiceStage extends AbstractService {

    /**
     * Obtient le nom du repository associé aux Stages.
     *
     * @return string Le nom du repository.
     */
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}
