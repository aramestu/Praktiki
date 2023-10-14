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

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null) : array
    {
        /*$resultArray = array();
        $pdo = Model::getPdo();
        $sql = $pdo->prepare("SELECT * FROM ExperienceProfessionnel");

        if (!is_null($dateDebut) && is_null($dateFin) && is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionnel WHERE dateDebut = $dateDebut";
        }
        elseif (is_null($dateDebut) && !is_null($dateFin) && is_null($optionTri)){
            $sql ="SELECT * FROM ExperienceProfessionnel WHERE dateFin = $dateFin";
        }
        elseif (is_null($dateDebut) && is_null($dateFin) && !is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionnel ORDER BY $optionTri";
        }
        elseif (!is_null($dateDebut) && !is_null($dateFin) && is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionel WHERE dateDebut = $dateDebut AND dateFin = $dateFin";
        }
        elseif (!is_null($dateDebut) && is_null($dateFin) && !is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionel WHERE dateDebut = $dateDebut ORDER BY $optionTri";
        }
        elseif (is_null($dateDebut) && !is_null($dateFin) && !is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionel WHERE dateFin = $dateFin ORDER BY $optionTri";
        }
        elseif (!is_null($dateDebut) && !is_null($dateFin) && !is_null($optionTri)){
            $sql = "SELECT * FROM ExperienceProfessionel WHERE dateDebut = $dateDebut AND dateFin = $dateFin ORDER BY $optionTri";
        }
        $pdo->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll();*/
        /* TODO : tempo 2eme test
         *
         *
         * //TODO : a finir
        $pdo = Model::getPdo();
        $sql = "SELECT * ";
        if (isset($stage) && isset($alternance) || !isset($stage) && !isset($alternance)){
            $sql .= "FROM ExperienceProfessionnel e JOIN Stages s ON s.idStage = e.idExperienceProfessionnel JOIN Alternances a ON a.idalternance = e.idExperienceProfessionnel ";
        }
        elseif (isset($stage)){
            $sql .= "FROM Stages s JOIN ExperienceProfessionnel e ON s.idStage = e.idExperienceProfessionnel ";
        }
        elseif (isset($alternance)){
            $sql .= "FROM Alternances a JOIN ExperienceProfessionnel e ON a.idalternance = e.idExperienceProfessionnel ";
        }
        $sql .= "WHERE numEtudiant IS NULL ";

        if (strlen($dateDebut) > 0){
            $sql .= "AND dateDebutExperienceProfessionnel = '$dateDebut' ";
        }
        if (strlen($dateFin) > 0){
            $sql .= "AND dateFinExperienceProfessionnel = '$dateFin' ";
        }
        if (strlen($codePostal) > 0){
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if (isset($optionTri)){
            if ($optionTri = "datePublication"){
                //TODO : $sql .= "ORDER BY datePublication ASC"
            }
            if ($optionTri = "datePublicationInverse") {
                //TODO : $sql .= "ORDER BY datePublication DESC"
            }
            if ($optionTri = "salaireCroissant" && isset($stage)){
                $sql .= "ORDER BY gratificationStage ASC";
            }
            if ($optionTri = "salaireDecroissant" && isset($stage)) {
                $sql .= "ORDER BY gratificationStage DESC";
            }
        }

        var_dump($sql);
        var_dump($pdo->query($sql)->fetchAll());

        return $pdo->query($sql)->fetchAll();*/

        $tabStages = StageRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal);
        $tabAlternance = AlternanceRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal);
        if (isset($stage)){
            return $tabStages;
        }
        elseif (isset($alternance)){
            return $tabAlternance;
        }
        else{
            //var_dump(self::mergeSort($tabAlternance, $tabStages, $optionTri));
            return self::mergeSort($tabAlternance, $tabStages, $optionTri);
        }
    }
    public static function mergeSort(array $array1, array $array2, string|null $option): array {
        $result = [];

        while (!empty($array1) && !empty($array2)) {
            $element1 = reset($array1);
            $element2 = reset($array2);

            $comparison = match ($option) {
                'datePublication' => $element1['datePublication'] - $element2['datePublication'],
                'datePublicationInverse' => $element2['datePublicationInverse'] - $element1['datePublicationInverse'],
                'salaireCroissant' => $element1['gratificationStage'] - $element2['gratificationStage'],
                'salaireDecroissant' => $element2['gratificationStage'] - $element1['gratificationStage'],
                default => 0, // Pas de changement d'ordre par défaut
            };

            if ($comparison <= 0) {
                $result[] = array_shift($array1);
            } else {
                $result[] = array_shift($array2);
            }
        }

        // Ajout des éléments restants s'il y en a
        return array_merge($result, $array1, $array2);
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