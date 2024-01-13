<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\AbstractDataObject;

/**
 * Service pour l'objet de données Alternance.
 */
class ServiceAlternance extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Alternance.
     *
     * @return string
     */
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}
