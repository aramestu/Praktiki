<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\EntrepriseRepository;

/**
 * Service pour l'objet de données Entreprise.
 */
class ServiceEntreprise extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Entreprise.
     *
     * @return string
     */
    public function getRepository(): string {
        return "EntrepriseRepository";
    }
}
