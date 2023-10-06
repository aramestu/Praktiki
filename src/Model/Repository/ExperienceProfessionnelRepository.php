<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\Repository\Model;

class ExperienceProfessionnelRepository{
    public static function save(ExperienceProfessionnel $e) : bool{
        try{
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO ExperienceProfessionnel(sujetExperienceProfessionnel, thematiqueExperienceProfessionnel,
                                                                                    tachesExperienceProfessionnel, codePostalExperienceProfessionnel,
                                                                                    adresseExperienceProfessionnel, dateDebutExperienceProfessionnel, 
                                                                                    dateFinExperienceProfessionnel, siret) 
                                                    VALUES(:sujetExperienceProfessionnelTag, :thematiqueExperienceProfessionnelTag,
                                                            :tachesExperienceProfessionnelTag, :codePostalExperienceProfessionnelTag,
                                                            :adresseExperienceProfessionnelTag, :dateDebutExperienceProfessionnelTag, 
                                                            :dateFinExperienceProfessionnelTag, :siretTag)");
            $values = array("sujetExperienceProfessionnelTag" => $e->getSujet(),
                "thematiqueExperienceProfessionnelTag" => $e->getThematique(),
                "tachesExperienceProfessionnelTag" => $e->getTaches(),
                "codePostalExperienceProfessionnelTag" => $e->getCodePostal(),
                "adresseExperienceProfessionnelTag" => $e->getAdresse(),
                "dateDebutExperienceProfessionnelTag" => $e->getDateDebut(),
                "dateFinExperienceProfessionnelTag" => $e->getDateFin(),
                "siretTag" => $e->getSiret());
            $requestStatement->execute($values);
            return true;
        }catch (\PDOException $e){
            return false;
        }
    }

    public static function getAllExperienceProfessionnelByDefault() : array{
        try{
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("SELECT * FROM ExperienceProfessionnel");
            $requestStatement->execute();
            $result = $requestStatement->fetchAll(\PDO::FETCH_ASSOC);
            $tab = array();
            foreach ($result as $item){
                $e = new ExperienceProfessionnel($item["sujetExperienceProfessionnel"], $item["thematiqueExperienceProfessionnel"],
                    $item["tachesExperienceProfessionnel"], $item["codePostalExperienceProfessionnel"],
                    $item["adresseExperienceProfessionnel"], $item["dateDebutExperienceProfessionnel"],
                    $item["dateFinExperienceProfessionnel"], $item["siret"]);
                $e->setId($item["idExperienceProfessionnel"]);
                array_push($tab, $e);
            }
            return $tab;
        }catch (\PDOException $e){
            return array();
        }
    }
}