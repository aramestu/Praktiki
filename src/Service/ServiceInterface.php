<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

/**
 * Interface ServiceInterface pour les services.
 */
interface ServiceInterface {
    /**
     * Met à jour un objet de données avec les attributs fournis.
     *
     * @param AbstractDataObject $dataObject L'objet de données à mettre à jour.
     * @param array $attributs Les attributs à mettre à jour.
     * @return void
     */
    public function mettreAJour(AbstractDataObject $dataObject, array $attributs): void;
}
