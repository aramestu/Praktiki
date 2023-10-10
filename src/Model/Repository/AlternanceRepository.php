<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Alternance;

class AlternanceRepository{
    public static function save(Alternance $a): bool {
        try{
            ExperienceProfessionnelRepository::save($a);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Alternances(idAlternance)
                                                 VALUES(:idAlternanceTag)");
            $values = array("idAlternanceTag" => $pdo->lastInsertId());

            $requestStatement->execute($values);
            return true;
        }catch(\PDOException $e){
            return false;
        }

    }

    public static function construireDepuisTableau($alternanceFormatTableau): Alternance {
        $alternance = new Alternance($alternanceFormatTableau["sujet"], $alternanceFormatTableau["thematique"], $alternanceFormatTableau["taches"], $alternanceFormatTableau["codePostal"], $alternanceFormatTableau["adresse"], $alternanceFormatTableau["dateDebut"], $alternanceFormatTableau["dateFin"], $alternanceFormatTableau["siret"]);
        if(array_key_exists("idAlternance", $alternanceFormatTableau)){
            if(!empty($alternanceFormatTableau["idAlternance"])){
                $alternance->setId($alternanceFormatTableau["idAlternance"]);
            }
        }
        if(array_key_exists("etudiant", $alternanceFormatTableau)){
            if(!empty($alternanceFormatTableau["etudiant"])){
                $alternance->setEtudiant($alternanceFormatTableau["etudiant"]);
            }
        }
        if(array_key_exists("enseignant", $alternanceFormatTableau)){
            if(!empty($alternanceFormatTableau["enseignant"])){
                $alternance->setEnseignant($alternanceFormatTableau["enseignant"]);
            }

        }
        if(array_key_exists("tuteurProfessionnel", $alternanceFormatTableau)){
            if(!empty($alternanceFormatTableau["tuteurProfessionnel"])){
                $alternance->setTuteurProfessionnel($alternanceFormatTableau["tuteurProfessionnel"]);
            }
        }
        return $alternance;
    }

    public static function getAllAlternance() : array{
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                                                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                                                dateFinExperienceProfessionnel AS dateFin, siret,numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel 
                                                FROM ExperienceProfessionnel e
                                                JOIN Alternances a ON a.idAlternance = e.idExperienceProfessionnel");
        $AllAlternance = [];
        foreach ($requestStatement as $alternanceTab){
            $AllAlternance[] = self::construireDepuisTableau($alternanceTab);
        }
        return $AllAlternance;
    }

    public static function getAlternanceParId(string $id) :?Alternance{
        $sql = "SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                dateFinExperienceProfessionnel AS dateFin, siret, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel
                FROM ExperienceProfessionnel e
                JOIN Alternances a ON a.idAlternance = e.idExperienceProfessionnel
                WHERE a.idAlternance = :id";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $alternance = $pdoStatement->fetch();

        // S'il n'y a pas d'alternance
        if (! $alternance) {
            return null;
        } else {
            return AlternanceRepository::construireDepuisTableau($alternance);
        }
    }
}