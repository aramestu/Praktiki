<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

/**
 * Classe abstraite pour les services.
 */
abstract class AbstractService implements ServiceInterface {

    // Chemin du repository par défaut
    private string $repositoryPath = "App\SAE\Model\Repository\\";

    /**
     * Méthode abstraite pour obtenir le nom du repository.
     *
     * @return string
     */
    abstract function getRepository(): string;

    /**
     * Met à jour les attributs d'un objet de données abstrait.
     *
     * @param AbstractDataObject $dataObject L'objet de données abstrait à mettre à jour.
     * @param array $attributs Les nouveaux attributs à appliquer.
     * @return void
     */
    public function mettreAJour(AbstractDataObject $dataObject, array $attributs): void {
        $setters = $dataObject->getSetters();

        // Parcourt les setters de l'objet de données et met à jour les attributs correspondants
        foreach($setters as $nomAttribut => $nomSetterAttribut){
            if(isset($attributs[$nomAttribut])){
                $dataObject->$nomSetterAttribut($attributs[$nomAttribut]);
            }
        }

        // Obtient le chemin complet du repository
        $repository = "{$this->repositoryPath}{$this->getRepository()}";

        // Appelle la méthode mettreAJour du repository correspondant
        (new $repository())->mettreAJour($dataObject);
    }
}
