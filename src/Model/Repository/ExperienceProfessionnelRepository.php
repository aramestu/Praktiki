<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

class ExperienceProfessionnelRepository {
    public static function save(ExperienceProfessionnel $e) : bool
    {
        try {
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
        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function getAll() : array{
        $alternance = AlternanceRepository::getAll();
        $stage = StageRepository::getAll();
        return array_merge($alternance, $stage);
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null) : array
    {
        $tabStages = StageRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        $tabAlternance = AlternanceRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        if (isset($stage)){
            return $tabStages;
        }
        elseif (isset($alternance)){
            return $tabAlternance;
        }
        else{
            if (!isset($optionTri)) {
                return array_merge($tabStages, $tabAlternance);
            }else{
                return self::sort($tabStages, $tabAlternance, $optionTri);
            }

        }
    }

    private static function sort(array $stages, array $alternances, string $option): array{

        if($option == "salaireCroissant" || $option == "salaireDecroissant" ){
            return array_merge($stages, $alternances);
        }
        $allExperienceProfessionnel = array();
        while(!empty($stages) && !empty($alternances)){
            $order = match ($option){
                "datePublication" => strtotime($stages[0]->getDatePublication()) - strtotime($alternances[0]->getDatePublication()),
                "datePublicationInverse" => strtotime($alternances[0]->getDatePublication()) - strtotime($stages[0]->getDatePublication())
            };
            if($order<0){
                $allExperienceProfessionnel[] = array_shift($stages);
            }else{
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);
    }

    public static function mettreAJour(ExperienceProfessionnel $exp): void
    {
        $sql = "UPDATE ExperienceProfessionnel SET
                sujetExperienceProfessionnel= :sujetTag,
                thematiqueExperienceProfessionnel= :thematiqueTag,
                tachesExperienceProfessionnel= :tacheTag,
                codePostalExperienceProfessionnel= :codePostalTag,
                adresseExperienceProfessionnel= :adresseTag,
                dateDebutExperienceProfessionnel= :dateDebutTag,
                dateFinExperienceProfessionnel= :dateFinTag 
                WHERE idExperienceProfessionnel= :idExpPro";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "sujetTag" => $exp->getSujet(),
            "thematiqueTag" => $exp->getThematique(),
            "tacheTag" => $exp->getTaches(),
            "codePostalTag" => $exp->getCodePostal(),
            "adresseTag" => $exp->getAdresse(),
            "dateDebutTag" => $exp->getDateDebut(),
            "dateFinTag" => $exp->getDateFin(),
            "idExpPro" => $exp->getId()
        );
        $pdoStatement->execute($values);
    }

    public static function supprimer(ExperienceProfessionnel $exp): void {
        $sql = "DELETE FROM `ExperienceProfessionnel` WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $exp->getId()
        );

        $pdoStatement->execute($values);
    }

    public static function search(string $keywords){
        $stage = StageRepository::search($keywords);
        $alternance = AlternanceRepository::search($keywords);
        return self::sort($stage, $alternance, "datePublication");
    }
}