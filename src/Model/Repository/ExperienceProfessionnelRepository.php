<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

class ExperienceProfessionnelRepository {
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
            }
            $option = match ($optionTri) {
                'datePublication', 'salaireDecroissant' => 'asc',
                'datePublicationInverse', 'salaireCroissant' => 'desc',
            };
                var_dump($option);
                var_dump(self::customMergeSort($tabAlternance, $tabStages, $option));
                return self::customMergeSort($tabAlternance, $tabStages, $option);
        }
    }
    //TODO : a modif
    public static function customMergeSort(array $arr1, array $arr2, string $option): array
    {
        $result = array();
        $i = 0;
        $j = 0;

        while ($i < count($arr1) && $j < count($arr2)) {
            if (($option === 'asc' && $arr1[$i] < $arr2[$j]) || ($option === 'desc' && $arr1[$i] > $arr2[$j])) {
                $result[] = $arr1[$i];
                $i++;
            } else {
                $result[] = $arr2[$j];
                $j++;
            }
        }

        // Ajouter les éléments restants des deux tableaux
        while ($i < count($arr1)) {
            $result[] = $arr1[$i];
            $i++;
        }

        while ($j < count($arr2)) {
            $result[] = $arr2[$j];
            $j++;
        }


        // Maintenant, $result contient les éléments triés des deux tableaux
        return $result;
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
        return array_merge($stage, $alternance);
    }
}