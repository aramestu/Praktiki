<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Alternance;

class AlternanceRepository{
    public static function save(Alternance $a): void
    {
        ExperienceProfessionnelRepository::save($a);
        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare("INSERT INTO Alternances(idAlternance)
                                                 VALUES(:idAlternanceTag)");
        $values = array("idAlternanceTag" => $pdo->lastInsertId());

        $requestStatement->execute($values);
    }
}