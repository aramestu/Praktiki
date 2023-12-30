<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

abstract class AbstractService implements ServiceInterface {

    private string $repositoryPath = "App\SAE\Model\Repository\\";

    abstract function getRepository():string;

    public function mettreAJour(AbstractDataObject $dataObject, array $attributs): void {
        $setters = $dataObject->getSetters();
        foreach($setters as $nomAttribut => $nomSetterAttribut){
            if(isset($attributs[$nomAttribut])){
                $dataObject->$nomSetterAttribut($attributs[$nomAttribut]);
            }
        }
        $repository = "{$this->repositoryPath}{$this->getRepository()}";
        (new $repository())->mettreAJour($dataObject);
    }
}