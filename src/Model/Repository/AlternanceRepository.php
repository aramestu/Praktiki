<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Alternance;

class AlternanceRepository{
    public static function save(Alternance $a): bool {
        try{
            ExperienceProfessionnelRepository::save($a);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Alternances(idAlternance)
                                                 VALUES(:idAlternanceTag)");
            $values = array("idAlternanceTag" => $pdo->lastInsertId());

            $requestStatement->execute($values);
            return true;
        }catch(\PDOException $e){
            return false;
        }

    }

    public static function construireDepuisTableau($alternanceFormatTableau): Alternance {
        $alternance = new Alternance($alternanceFormatTableau["sujet"], $alternanceFormatTableau["thematique"], $alternanceFormatTableau["taches"], $alternanceFormatTableau["codePostal"], $alternanceFormatTableau["adresse"], $alternanceFormatTableau["dateDebut"], $alternanceFormatTableau["dateFin"], $alternanceFormatTableau["siret"]);
        if(array_key_exists("id", $alternanceFormatTableau)){
            $alternance->setId($alternanceFormatTableau["id"]);
        }
        return $alternance;
    }
}