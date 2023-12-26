<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

interface ServiceInterface {
    public static function mettreAJour(AbstractDataObject $dataObject, array $attributs): void;
}