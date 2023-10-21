<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Alternance;

class AlternanceRepository
{
    public static function save(Alternance $a): bool
    {
        try {
            ExperienceProfessionnelRepository::save($a);
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO Alternances(idAlternance)
                                                 VALUES(:idAlternanceTag)");
            $values = array("idAlternanceTag" => $pdo->lastInsertId());

            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function construireDepuisTableau($alternanceFormatTableau): Alternance
    {
        $alternance = new Alternance($alternanceFormatTableau["sujetExperienceProfessionnel"], $alternanceFormatTableau["thematiqueExperienceProfessionnel"], $alternanceFormatTableau["tachesExperienceProfessionnel"], $alternanceFormatTableau["codePostalExperienceProfessionnel"], $alternanceFormatTableau["adresseExperienceProfessionnel"], $alternanceFormatTableau["dateDebutExperienceProfessionnel"], $alternanceFormatTableau["dateFinExperienceProfessionnel"], $alternanceFormatTableau["siret"]);
        if (array_key_exists("idAlternance", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["idAlternance"])) {
                $alternance->setIdExperienceProfessionnel($alternanceFormatTableau["idAlternance"]);
            }
        }
        if (array_key_exists("numEtudiant", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["numEtudiant"])) {
                $alternance->setNumEtudiant($alternanceFormatTableau["numEtudiant"]);
            }
        }
        if (array_key_exists("mailEnseignant", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["mailEnseignant"])) {
                $alternance->setMailEnseignant($alternanceFormatTableau["mailEnseignant"]);
            }

        }
        if (array_key_exists("mailTuteurProfessionnel", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["mailTuteurProfessionnel"])) {
                $alternance->setMailTuteurProfessionnel($alternanceFormatTableau["mailTuteurProfessionnel"]);
            }
        }
        if (array_key_exists("datePublication", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["datePublication"])) {
                $alternance->setDatePublication($alternanceFormatTableau["datePublication"]);
            }
        }
        return $alternance;
    }

    public static function getAll(): array
    {
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT * 
                                                FROM ExperienceProfessionnel e
                                                JOIN Alternances a ON a.idAlternance = e.idExperienceProfessionnel");
        $AllAlternance = [];
        foreach ($requestStatement as $alternanceTab) {
            $AllAlternance[] = self::construireDepuisTableau($alternanceTab);
        }
        return $AllAlternance;
    }

    public static function get(string $id): ?Alternance
    {
        $sql = "SELECT *
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
        if (!$alternance) {
            return null;
        } else {
            return AlternanceRepository::construireDepuisTableau($alternance);
        }
    }

    public static function mettreAJour(Alternance $alternance): void
    {

        // Il faut modifier à la fois dans ExperienceProfessionnel
        ExperienceProfessionnelRepository::mettreAJour($alternance);
    }

    public static function supprimer(Alternance $alternance): void {
        $sql = "DELETE FROM Alternances WHERE idAlternance= :idTag;";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $alternance->getIdExperienceProfessionnel()
        );

        $pdoStatement->execute($values);
        ExperienceProfessionnelRepository::supprimer($alternance);
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null): array
    {
        date_default_timezone_set('Europe/Paris');
        $pdo = Model::getPdo();
        $sql = "SELECT * 
                FROM Alternances a JOIN ExperienceProfessionnel e ON a.idalternance = e.idExperienceProfessionnel WHERE numEtudiant IS NULL ";
        if (isset($datePublication)) {
            $sql .= match ($datePublication) {
                'last24' => "AND DATEDIFF(NOW(), datePublication) < 1 ",
                'lastWeek' => "AND DATEDIFF(NOW(), datePublication) < 7 ",
                'lastMonth' => "AND DATEDIFF(NOW(), datePublication) < 30 ",
            };
        }
        //TODO : A revoire quand Date dans BD
        if (strlen($dateDebut) > 0 && strlen($dateFin) > 0) {
            $sql .= "AND dateDebutExperienceProfessionnel >= $dateDebut AND dateFinExperienceProfessionnel <= $dateFin ";
        } elseif (strlen($dateDebut) > 0) {
            $sql .= "AND dateDebutExperienceProfessionnel = '$dateDebut' ";
        } elseif (strlen($dateFin) > 0) {
            $sql .= "AND dateFinExperienceProfessionnel = '$dateFin' ";
        }
        if (strlen($codePostal) > 0) {
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if (isset($optionTri)) {
            if ($optionTri == "datePublication") {
                $sql .= "ORDER BY datePublication ASC";
            }
            if ($optionTri == "datePublicationInverse") {
                $sql .= "ORDER BY datePublication DESC";
            }
        }

        $requete = $pdo->query($sql);
        $alternanceTriee = [];
        foreach ($requete as $result) {
            $alternanceTriee[] = self::construireDepuisTableau($result);
        }
        return $alternanceTriee;
    }

    public static function search(string $keywords): array
    {
        $sql = "SELECT *
                FROM ExperienceProfessionnel e
                JOIN Alternances a ON a.idAlternance = e.idExperienceProfessionnel
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

        $AllAlternance = [];
        foreach ($requestStatement as $alternanceTab) {
            $AllAlternance[] = self::construireDepuisTableau($alternanceTab);
        }
        return $AllAlternance;

    }
}