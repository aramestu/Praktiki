<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Stage;

class StageRepository{
    public static function save(Stage $s): bool {
        try{
            ExperienceProfessionnelRepository::save($s);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Stages(idStage, gratificationStage) 
                                                 VALUES(:idStageTag, :gratificationStageTag)");
            $values = array("idStageTag" => $pdo->lastInsertId(),
                "gratificationStageTag" => $s->getGratification());

            $requestStatement->execute($values);
            return true;
        }catch (\PDOException $e){
            return false;
        }
    }

    public static function construireDepuisTableau($stageFormatTableau): Stage {
        $stage = new Stage($stageFormatTableau["sujet"], $stageFormatTableau["thematique"], $stageFormatTableau["taches"], $stageFormatTableau["codePostal"], $stageFormatTableau["adresse"], $stageFormatTableau["dateDebut"], $stageFormatTableau["dateFin"], $stageFormatTableau["siret"], $stageFormatTableau["gratification"]);
        if(array_key_exists("id", $stageFormatTableau)){
            $stage->setId($stageFormatTableau["id"]);
        }
        return $stage;
    }
}