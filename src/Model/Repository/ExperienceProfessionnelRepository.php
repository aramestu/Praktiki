<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
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

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null) : array|false
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
        //TODO : a finir
        $pdo = Model::getPdo();
        $sql = "SELECT * ";
        if (isset($stage) && isset($alternance) || !isset($stage) && !isset($alternance)){
            $sql .= "FROM ExperienceProfessionnel ";
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
            $sql .= "AND codePostalExperienceProfesionnel = '$codePostal' ";
        }
        if (isset($optionTri)){
            //TODO : cas différent
            $sql .= "ORDER BY $optionTri";
        }

        var_dump($sql);
        return $pdo->query($sql)->fetchAll();
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

    public static function supprimer(ExperienceProfessionnel $exp): void
    {
        $sql = "DELETE FROM `ExperienceProfessionnel` WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $exp->getId()
        );

        $pdoStatement->execute($values);
    }

    public static function search(string $keywords){

    }
}