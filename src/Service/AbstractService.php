<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\AbstractDataObject;

abstract class AbstractService implements ServiceInterface {

    private string $repositoryPath = "App\SAE\Model\Repository\\";

    abstract function getRepository():string;

    public function mettreAJour(AbstractDataObject $dataObject, array $attributs): void {
        $setters = $dataObject->getSetters();
        foreach($setters as $key => $value){
            if(isset($attributs[$key])){
                $dataObject->$value($attributs[$key]);
            }
        }
        $repository = "{$this->repositoryPath}{$this->getRepository()}";
        (new $repository())->mettreAJour($dataObject);
    }
}