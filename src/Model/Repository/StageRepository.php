<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Stage;

class StageRepository{
    public static function save(Stage $s): void {
        ExperienceProfessionnelRepository::save($s);
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("INSERT INTO Stages(idStage, gratificationStage) 
                                                 VALUES(:idStageTag, :gratificationStageTag)");
        $values = array("idStageTag" => $pdo->lastInsertId(),
                        "gratificationStageTag" => $s->getGratification());

        $requestStatement->execute($values);
    }
}