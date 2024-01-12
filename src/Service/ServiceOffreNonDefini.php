<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;

/**
 * Service pour les Offres Non Définies.
 */
class ServiceOffreNonDefini extends AbstractService {

    /**
     * Obtient le nom du repository associé aux Offres Non Définies.
     *
     * @return string Le nom du repository.
     */
    function getRepository(): string
    {
        return "OffreNonDefiniRepository";
    }
}
