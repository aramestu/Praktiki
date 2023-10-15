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
                'datePublication', 'salaireCroissant' => 'asc',
                'datePublicationInverse', 'salaireDecroissant' => 'desc',
            };
                return self::customMergeSort($tabAlternance, $tabStages, $option);
        }
    }

    public static function customMergeSort(array $array1, array $array2, string $option): array {
        // Fusionnez les deux tableaux
        $mergedArray = array_merge($array1, $array2);

        // Fonction de comparaison pour le tri
        $compareFunction = function ($a, $b) use ($option) {
            if ($option === 'asc') {
                return ($a < $b) ? -1 : 1;
            } elseif ($option === 'desc') {
                return ($a > $b) ? -1 : 1;
            } else {
                return 0; // Aucun tri spécifié, ne change pas l'ordre d'origine
            }
        };

        // Triez le tableau fusionné en utilisant la fonction de comparaison
        usort($mergedArray, $compareFunction);

        return $mergedArray;
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