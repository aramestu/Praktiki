<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\Repository\EnseignantRepository;

/**
 * Service pour l'objet de données Enseignant.
 */
class ServiceEnseignant extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Enseignant.
     *
     * @return string
     */
    public function getRepository(): string {
        return "EnseignantRepository";
    }
}
