<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use Cassandra\Date;

class StageRepository{
    public static function save(Stage $s): bool {
        try{
            ExperienceProfessionnelRepository::save($s);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Stages(idStage, gratificationStage) 
                                                 VALUES(:idStageTag, :gratificationStageTag)");
            $values = array("idStageTag" => $pdo->lastInsertId(),
                "gratificationStageTag" => $s->getGratificationStage());

            $requestStatement->execute($values);
            return true;
        }catch (\PDOException $e){
            return false;
        }
    }

    public static function construireDepuisTableau($stageFormatTableau): Stage {
        $stage = new Stage($stageFormatTableau["sujetExperienceProfessionnel"], $stageFormatTableau["thematiqueExperienceProfessionnel"], $stageFormatTableau["tachesExperienceProfessionnel"], $stageFormatTableau["codePostalExperienceProfessionnel"], $stageFormatTableau["adresseExperienceProfessionnel"], $stageFormatTableau["dateDebutExperienceProfessionnel"], $stageFormatTableau["dateFinExperienceProfessionnel"], $stageFormatTableau["siret"], $stageFormatTableau["gratificationStage"]);
        if(array_key_exists("idStage", $stageFormatTableau)){
            $stage->setIdExperienceProfessionnel($stageFormatTableau["idStage"]);
        }
        if(array_key_exists("numEtudiant", $stageFormatTableau)){
            if(!empty($stageFormatTableau["numEtudiant"])){
                $stage->setNumEtudiant($stageFormatTableau["numEtudiant"]);
            }
        }
        if(array_key_exists("mailEnseignant", $stageFormatTableau)){
            if(!empty($stageFormatTableau["mailEnseignant"])){
                $stage->setMailEnseignant($stageFormatTableau["mailEnseignant"]);
            }
        }
        if(array_key_exists("mailTuteurProfessionnel", $stageFormatTableau)){
            if(!empty($stageFormatTableau["mailTuteurProfessionnel"])){
                $stage->setMailTuteurProfessionnel($stageFormatTableau["mailTuteurProfessionnel"]);
            }
        }
        if(array_key_exists("datePublication", $stageFormatTableau)){
            if(!empty($stageFormatTableau["datePublication"])){
                $stage->setDatePublication($stageFormatTableau["datePublication"]);
            }
        }
        return $stage;
    }

    public static function getAll() : array {
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT *
                                                FROM ExperienceProfessionnel e
                                                JOIN Stages s ON s.idStage = e.idExperienceProfessionnel");
        $AllStage = [];
        foreach ($requestStatement as $stageTab){
            $AllStage[] = self::construireDepuisTableau($stageTab);
        }
        return $AllStage;
    }

    public static function get(string $id) :?Stage {
        $sql = "SELECT *
                FROM ExperienceProfessionnel e
                JOIN Stages s ON s.idStage = e.idExperienceProfessionnel
                WHERE s.idStage = :id";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $stage = $pdoStatement->fetch();

        // S'il n'y a pas de stage
        if (! $stage) {
            return null;
        } else {
            return StageRepository::construireDepuisTableau($stage);
        }
    }



    public static function mettreAJour(Stage $stage): void {
        // Il faut modifier à la fois dans ExperienceProfessionnel et dans Stage
        ExperienceProfessionnelRepository::mettreAJour($stage);

        $sql = "UPDATE Stages SET
                gratificationStage= :gratificationTag
                WHERE idStage= :idTag";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "gratificationTag" => $stage->getGratificationStage(),
            "idTag" => $stage->getIdExperienceProfessionnel()
        );

        $pdoStatement->execute($values);
    }

    public static function supprimer(Stage $stage): void {
        $sql = "DELETE FROM Stages WHERE idStage= :idTag;";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $stage->getIdExperienceProfessionnel()
        );

        $pdoStatement->execute($values);
        ExperienceProfessionnelRepository::supprimer($stage);
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null) : array{
        date_default_timezone_set('Europe/Paris');
        $pdo = Model::getPdo();
        $sql = "SELECT *
                FROM Stages s JOIN ExperienceProfessionnel e ON s.idStage = e.idExperienceProfessionnel WHERE numEtudiant IS NULL ";
        if (isset($datePublication)){
            $sql .= match ($datePublication){
                'last24' => "AND DATEDIFF(NOW(), datePublication) < 1 ",
                'lastWeek' => "AND DATEDIFF(NOW(), datePublication) < 7 ",
                'lastMonth' => "AND DATEDIFF(NOW(), datePublication) < 30 ",
            };
        }

        //TODO : A revoire quand Date dans BD
        if (strlen($dateDebut) > 0 && strlen($dateFin) > 0){
            $sql .= "AND dateDebutExperienceProfessionnel >= $dateDebut AND dateFinExperienceProfessionnel <= $dateFin ";
        }
        elseif (strlen($dateDebut) > 0){
            $sql .= "AND dateDebutExperienceProfessionnel = '$dateDebut' ";
        }
        elseif (strlen($dateFin) > 0){
            $sql .= "AND dateFinExperienceProfessionnel = '$dateFin' ";
        }
        if (strlen($codePostal) > 0){
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if(isset($optionTri)){
            if ($optionTri == "datePublication"){
                $sql .= "ORDER BY datePublication ASC";
            }
            if ($optionTri == "datePublicationInverse") {
                $sql .= "ORDER BY datePublication DESC";
            }
            if ($optionTri == "salaireCroissant"){
                $sql .= "ORDER BY gratificationStage ASC";
            }
            if ($optionTri == "salaireDecroissant") {
                $sql .= "ORDER BY gratificationStage DESC";
            }
        }

        $requete = $pdo->query($sql);
        $stageTriee = [];
        foreach ($requete as $result){
            $stageTriee[] = self::construireDepuisTableau($result);
        }
        return $stageTriee;
    }

    public static function search(string $keywords): array{
        $sql = "SELECT *
                FROM ExperienceProfessionnel e
                JOIN Stages s ON s.idStage = e.idExperienceProfessionnel
                JOIN Entreprises en ON en.siret = e.siret
                WHERE numEtudiant IS NULL
                AND en.estValide = true
                AND (sujetExperienceProfessionnel LIKE :keywordsTag
                OR thematiqueExperienceProfessionnel LIKE :keywordsTag
                OR tachesExperienceProfessionnel LIKE :keywordsTag
                OR codePostalExperienceProfessionnel LIKE :keywordsTag
                OR adresseExperienceProfessionnel LIKE :keywordsTag
                OR e.siret LIKE :keywordsTag)
                ORDER BY datePublication";

        $requestStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "keywordsTag" => '%' . $keywords . '%'
        );

        $requestStatement->execute($values);

        $AllStage = [];
        foreach ($requestStatement as $stageTab){
            $AllStage[] = self::construireDepuisTableau($stageTab);
        }
        return $AllStage;
    }
}