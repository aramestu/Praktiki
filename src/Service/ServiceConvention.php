<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Convention;

/**
 * Service pour l'objet de données Convention.
 */
class ServiceConvention extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Convention.
     *
     * @return string
     */
    public function getRepository(): string {
        return "ConventionRepository";
    }

}
