<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

/**
 * Service pour l'objet de données ExperienceProfessionnel.
 */
class ServiceExperienceProfessionnel extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à ExperienceProfessionnel.
     *
     * @return string
     */
    public function getRepository(): string {
        return "ExperienceProfessionnelRepository";
    }
}
