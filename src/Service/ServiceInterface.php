<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

interface ServiceInterface {
    public function mettreAJour(AbstractDataObject $dataObject, array $attributs): void;
}