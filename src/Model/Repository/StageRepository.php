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
        if(array_key_exists("datePublication", $stageFormatTableau)){
            if(!empty($stageFormatTableau["datePublication"])){
                $stage->setDatePublication($stageFormatTableau["datePublication"]);
            }
        }
        return $stage;
    }

    public static function getAll() : array{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT idStage, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                                                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                                                dateFinExperienceProfessionnel AS dateFin, siret, datePublication, numEtudiant AS etudiant, mailEnseignant AS enseignant, 
                                                mailTuteurProfessionnel AS tuteurProfessionnel, gratificationStage AS gratification
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



    public static function mettreAJour(Stage $stage): void
    {
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

    public static function supprimer(Stage $stage): void
    {
        $sql = "DELETE FROM Stages WHERE idStage= :idTag;";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $stage->getId()
        );

        $pdoStatement->execute($values);
        ExperienceProfessionnelRepository::supprimer($stage);
    }

    public static function search(string $keywords): void
    {
        $pdo = Model::getPdo();
        $sqlBase = "SELECT * FROM Stages s
                    JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = s.idStage";
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null) : array{
        $pdo = Model::getPdo();
        $sql = "SELECT idStage, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                                                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                                                dateFinExperienceProfessionnel AS dateFin, siret, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel,
                                                gratificationStage AS gratification FROM Stages s JOIN ExperienceProfessionnel e ON s.idStage = e.idExperienceProfessionnel ";
        if (strlen($dateDebut) > 0){
            $sql .= "AND dateDebutExperienceProfessionnel = '$dateDebut' ";
        }
        if (strlen($dateFin) > 0){
            $sql .= "AND dateFinExperienceProfessionnel = '$dateFin' ";
        }
        if (strlen($codePostal) > 0){
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if(isset($optionTri)){
            if ($optionTri == "datePublication"){
                //TODO : $sql .= "ORDER BY datePublication ASC"
            }
            if ($optionTri == "datePublicationInverse") {
                //TODO : $sql .= "ORDER BY datePublication DESC"
            }
            if ($optionTri == "salaireCroissant" && isset($stage)){
                $sql .= "ORDER BY gratificationStage ASC";
            }
            if ($optionTri == "salaireDecroissant" && isset($stage)) {
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
}