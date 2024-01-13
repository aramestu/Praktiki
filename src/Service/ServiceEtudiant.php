<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\DataObject\AbstractDataObject;

/**
 * Service pour l'objet de données Etudiant.
 */
class ServiceEtudiant extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Etudiant.
     *
     * @return string
     */
    public function getRepository(): string {
        return "EtudiantRepository";
    }
}
