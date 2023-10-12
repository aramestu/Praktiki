<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;

class StageRepository{
    public static function save(Stage $s): bool {
        try{
            ExperienceProfessionnelRepository::save($s);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Stages(idStage, gratificationStage) 
                                                 VALUES(:idStageTag, :gratificationStageTag)");
            $values = array("idStageTag" => $pdo->lastInsertId(),
                "gratificationStageTag" => $s->getGratification());

            $requestStatement->execute($values);
            return true;
        }catch (\PDOException $e){
            return false;
        }
    }

    public static function construireDepuisTableau($stageFormatTableau): Stage {
        $stage = new Stage($stageFormatTableau["sujet"], $stageFormatTableau["thematique"], $stageFormatTableau["taches"], $stageFormatTableau["codePostal"], $stageFormatTableau["adresse"], $stageFormatTableau["dateDebut"], $stageFormatTableau["dateFin"], $stageFormatTableau["siret"], $stageFormatTableau["gratification"]);
        if(array_key_exists("idStage", $stageFormatTableau)){
            $stage->setId($stageFormatTableau["idStage"]);
        }
        if(array_key_exists("etudiant", $stageFormatTableau)){
            if(!empty($stageFormatTableau["etudiant"])){
                $stage->setEtudiant($stageFormatTableau["etudiant"]);
            }
        }
        if(array_key_exists("enseignant", $stageFormatTableau)){
            if(!empty($stageFormatTableau["enseignant"])){
                $stage->setEnseignant($stageFormatTableau["enseignant"]);
            }

        }
        if(array_key_exists("tuteurProfessionnel", $stageFormatTableau)){
            if(!empty($stageFormatTableau["tuteurProfessionnel"])){
                $stage->setTuteurProfessionnel($stageFormatTableau["tuteurProfessionnel"]);
            }
        }
        return $stage;
    }

    public static function getAll() : array{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT idStage, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                                                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                                                dateFinExperienceProfessionnel AS dateFin, siret, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel,
                                                gratificationStage AS gratification
                                                FROM ExperienceProfessionnel e
                                                JOIN Stages s ON s.idStage = e.idExperienceProfessionnel");
        $AllStage = [];
        foreach ($requestStatement as $stageTab){
            $AllStage[] = self::construireDepuisTableau($stageTab);
        }
        return $AllStage;
    }

    public static function get(string $id) :?Stage{
        $sql = "SELECT idStage, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                dateFinExperienceProfessionnel AS dateFin, siret, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel,
                gratificationStage AS gratification
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



    public static function mettreAJour(Stage $stage){
        // Il faut modifier à la fois dans ExperienceProfessionnel et dans Stage
        ExperienceProfessionnelRepository::mettreAJour($stage);

        $sql = "UPDATE Stages SET
                gratificationStage= :gratificationTag
                WHERE idStage= :idTag";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "gratificationTag" => $stage->getGratification(),
            "idTag" => $stage->getId()
        );

        $pdoStatement->execute($values);
    }

    public static function supprimer(Stage $stage){
        $sql = "DELETE FROM Stages WHERE idStage= :idTag;";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $stage->getId()
        );

        $pdoStatement->execute($values);
        ExperienceProfessionnelRepository::supprimer($stage);
    }
}