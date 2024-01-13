<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Personnel;
use App\SAE\Model\Repository\PersonnelRepository;

/**
 * Service pour l'objet de données Personnel.
 */
class ServicePersonnel extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Personnel.
     *
     * @return string
     */
    public function getRepository(): string {
        return "PersonnelRepository";
    }
}
