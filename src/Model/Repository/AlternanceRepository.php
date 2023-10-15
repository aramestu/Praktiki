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
        $alternance = new Alternance($alternanceFormatTableau["sujet"], $alternanceFormatTableau["thematique"], $alternanceFormatTableau["taches"], $alternanceFormatTableau["codePostal"], $alternanceFormatTableau["adresse"], $alternanceFormatTableau["dateDebut"], $alternanceFormatTableau["dateFin"], $alternanceFormatTableau["siret"]);
        if (array_key_exists("idAlternance", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["idAlternance"])) {
                $alternance->setId($alternanceFormatTableau["idAlternance"]);
            }
        }
        if (array_key_exists("etudiant", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["etudiant"])) {
                $alternance->setEtudiant($alternanceFormatTableau["etudiant"]);
            }
        }
        if (array_key_exists("enseignant", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["enseignant"])) {
                $alternance->setEnseignant($alternanceFormatTableau["enseignant"]);
            }

        }
        if (array_key_exists("tuteurProfessionnel", $alternanceFormatTableau)) {
            if (!empty($alternanceFormatTableau["tuteurProfessionnel"])) {
                $alternance->setTuteurProfessionnel($alternanceFormatTableau["tuteurProfessionnel"]);
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
        $requestStatement = $pdo->query(" SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                                                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                                                dateFinExperienceProfessionnel AS dateFin, siret, datePublication, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel 
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
        $sql = "SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                dateFinExperienceProfessionnel AS dateFin, siret, datePublication, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel
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

    public static function supprimer(Alternance $alternance): void
    {
        $sql = "DELETE FROM Alternances WHERE idAlternance= :idTag;";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $alternance->getId()
        );

        $pdoStatement->execute($values);
        ExperienceProfessionnelRepository::supprimer($alternance);
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null): array
    {
        date_default_timezone_set('Europe/Paris');
        $pdo = Model::getPdo();
        $sql = "SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                dateFinExperienceProfessionnel AS dateFin, siret, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel, datePublication FROM Alternances a JOIN ExperienceProfessionnel e ON a.idalternance = e.idExperienceProfessionnel WHERE numEtudiant IS NULL ";
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
        $sql = "SELECT idAlternance, sujetExperienceProfessionnel AS sujet, thematiqueExperienceProfessionnel AS thematique, tachesExperienceProfessionnel AS taches,
                codePostalExperienceProfessionnel AS codePostal, adresseExperienceProfessionnel AS adresse, dateDebutExperienceProfessionnel AS dateDebut,
                dateFinExperienceProfessionnel AS dateFin, siret, datePublication, numEtudiant AS etudiant, mailEnseignant AS enseignant, mailTuteurProfessionnel AS tuteurProfessionnel
                FROM ExperienceProfessionnel e
                JOIN Alternances a ON a.idAlternance = e.idExperienceProfessionnel
                WHERE numEtudiant IS NULL
                AND (sujetExperienceProfessionnel LIKE '%$keywords%'
                OR thematiqueExperienceProfessionnel LIKE '%$keywords%'
                OR tachesExperienceProfessionnel LIKE '%$keywords%'
                OR codePostalExperienceProfessionnel LIKE '%$keywords%'
                OR adresseExperienceProfessionnel LIKE '%$keywords%'
                OR siret LIKE '%$keywords%')";

        $requestStatement = Model::getPdo()->query($sql);

        $AllAlternance = [];
        foreach ($requestStatement as $alternanceTab) {
            $AllAlternance[] = self::construireDepuisTableau($alternanceTab);
        }
        return $AllAlternance;

    }
}