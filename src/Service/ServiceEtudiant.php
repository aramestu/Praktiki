<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceEtudiant extends AbstractService {
    public function getRepository():string{
        return "EtudiantRepository";
    }
}