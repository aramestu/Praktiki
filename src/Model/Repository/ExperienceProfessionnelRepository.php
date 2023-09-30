<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\Repository\Model;

class ExperienceProfessionnelRepository{
    public static function save(ExperienceProfessionnel $e){
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
    }
}