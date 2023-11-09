<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

abstract class AbstractExperienceProfessionnelRepository extends AbstractRepository
{
    protected abstract function getNomsColonnesSupplementaires(): array;
    protected abstract function getNomDataObject(): string;

    protected function getNomsColonnes(): array
    {
        return array("idExperienceProfessionnel","sujetExperienceProfessionnel", "thematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel", "codePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel", "dateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel", "siret");
    }

    protected function getNomClePrimaire(): string
    {
        return "idExperienceProfessionnel";
    }

    protected function getNomTable(): string
    {
        return "ExperienceProfessionnel";
    }

    public function save(AbstractDataObject $e): bool
    {
        try {
            $pdo = Model::getPdo();
            $sql = "INSERT INTO ExperienceProfessionnel(sujetExperienceProfessionnel, thematiqueExperienceProfessionnel,
                                                                                    tachesExperienceProfessionnel, codePostalExperienceProfessionnel,
                                                                                    adresseExperienceProfessionnel, dateDebutExperienceProfessionnel, 
                                                                                    dateFinExperienceProfessionnel, siret";
            if ($e->getNumEtudiant() != "") {
                $sql = $sql . ', numEtudiant';
            }
            if ($e->getMailEnseignant() != "") {
                $sql = $sql . ', mailEnseignant';
            }
            if ($e->getMailTuteurProfessionnel() != "") {
                $sql = $sql . ', mailTuteurProfessionnel';
            }
            if ($e->getDatePublication() != "") {
                $sql = $sql . ', datePublication';
            }
            $sql = $sql . ') VALUES(:sujetExperienceProfessionnelTag, :thematiqueExperienceProfessionnelTag,
                                                            :tachesExperienceProfessionnelTag, :codePostalExperienceProfessionnelTag,
                                                            :adresseExperienceProfessionnelTag, :dateDebutExperienceProfessionnelTag, 
                                                            :dateFinExperienceProfessionnelTag, :siretTag ';
            $values = array("sujetExperienceProfessionnelTag" => $e->getSujetExperienceProfessionnel(),
                "thematiqueExperienceProfessionnelTag" => $e->getThematiqueExperienceProfessionnel(),
                "tachesExperienceProfessionnelTag" => $e->getTachesExperienceProfessionnel(),
                "codePostalExperienceProfessionnelTag" => $e->getCodePostalExperienceProfessionnel(),
                "adresseExperienceProfessionnelTag" => $e->getAdresseExperienceProfessionnel(),
                "dateDebutExperienceProfessionnelTag" => $e->getDateDebutExperienceProfessionnel(),
                "dateFinExperienceProfessionnelTag" => $e->getDateFinExperienceProfessionnel(),
                "siretTag" => $e->getSiret());
            if ($e->getNumEtudiant() != "") {
                $sql = $sql . ', :numEtudiantTag';
                $values["numEtudiantTag"] = $e->getNumEtudiant();
            }
            if ($e->getMailEnseignant() != "") {
                $sql = $sql . ', :mailEnseignantTag';
                $values["mailEnseignantTag"] = $e->getMailEnseignant();
            }
            if ($e->getMailTuteurProfessionnel() != "") {
                $sql = $sql . ', :mailTuteurProfessionnelTag';
                $values["mailTuteurProfessionnelTag"] = $e->getMailTuteurProfessionnel();
            }
            if ($e->getDatePublication() != "") {
                $sql = $sql . ', :datePublicationTag';
                $values["datePublicationTag"] = $e->getDatePublication();
            }
            $sql = $sql . ')';
            $requestStatement = $pdo->prepare($sql);

            $requestStatement->execute($values);

            $formatTab = $e->formatTableau(); // Pour récupérer les colonnes
            $formatTab[$this->getNomClePrimaire() . "Tag"] = $pdo->lastInsertId(); // Pour ajouter la bonne clé primaire aux colonnes
            $sql = "INSERT INTO " . $this->getNomTable() . " VALUES(";
            $colonne = $this->getNomsColonnesSupplementaires(); // Colonnes supplémentaires déjà dans formatTableau
            $value = array();
            for($i = 0; $i < sizeof($colonne); $i++){
                $sql = $sql . ":" . $colonne[$i] . "Tag";
                if($i != sizeof($colonne) - 1){
                    $sql .= " , ";
                }
                $value[$colonne[$i] . "Tag"] = $formatTab[$colonne[$i] . "Tag"];
            }
            $sql = $sql . ")";
            $pdo->prepare($sql)->execute($value);
            return true;
        } catch (\PDOException $e) {
            echo $e;
            return false;
        }
    }


    /*public function save(AbstractDataObject $e): bool{
        // Puis on spécialise (Stage/Alternance/OffreNonDefini)
        try {
            $pdo = Model::getPdo();
            $table = $this->getNomTable();
            $colonnes = $this->getNomsColonnes();
            $sql = "INSERT INTO $table VALUES (";
            // Je commence à 1 pour ne pas enregistrer l'idExperienceProfessionnel
            for($i = 1; $i<sizeof($colonnes); $i++){
                $sql = $sql . ":" . $colonnes[$i] . "Tag";
                if($i!=sizeof($colonnes)-1){
                    $sql = $sql . ", ";
                }else{
                    $sql = $sql . ")";
                }
            }
            $requeteStatement = $pdo->prepare($sql);

            // Pour mettre Tag aux colonnes spécifiques aux offres
            $formatTab = $e->formatTableau();
            $values = array();
            foreach ($colonnes as $col){
                $values[$col . "Tag"] = $formatTab[$col];
            }
            $requeteStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }*/



    /* utilisé pour construireDepuisTableau afin de dupliquer du code avec StageRepository
     *
     */
    public function updateAttribut(array $expProFormatTableau, ExperienceProfessionnel $exp): void {
        $nomId = $this->getNomClePrimaire();
        // Les id ont des noms différents, je vérif qu'ils existent
        if (array_key_exists($nomId, $expProFormatTableau)) {
            $exp->setIdExperienceProfessionnel($expProFormatTableau[$nomId]);
        }
        if (array_key_exists("numEtudiant", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["numEtudiant"])) {
                $exp->setNumEtudiant($expProFormatTableau["numEtudiant"]);
            }
        }
        if (array_key_exists("mailEnseignant", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["mailEnseignant"])) {
                $exp->setMailEnseignant($expProFormatTableau["mailEnseignant"]);
            }
        }
        if (array_key_exists("mailTuteurProfessionnel", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["mailTuteurProfessionnel"])) {
                $exp->setMailTuteurProfessionnel($expProFormatTableau["mailTuteurProfessionnel"]);
            }
        }
        if (array_key_exists("datePublication", $expProFormatTableau)) {
            $exp->setDatePublication($expProFormatTableau["datePublication"]);
        }
    }

    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new ($this->getNomDataObject())($expProFormatTableau["sujetExperienceProfessionnel"], $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"], $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"], $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"], $expProFormatTableau["siret"]);
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }

    public function getAll(): array
    {
        $alternance = AlternanceRepository::getAll();
        $stage = StageRepository::getAll();
        $pdo = Model::getPdo();
        $requestStatement = $pdo->query(" SELECT *
                                                        FROM ExperienceProfessionnel e
                                                        WHERE NOT EXISTS (SELECT * FROM Stages
                                                        WHERE Stages.idStage = e.idExperienceProfessionnel)
                                                        AND NOT EXISTS (SELECT * FROM Alternances
                                                        WHERE Alternances.idAlternance = e.idExperienceProfessionnel)");
        $stalternance = [];
        foreach ($requestStatement as $alternanceTab) {
            $stalternance[] = $this->construireDepuisTableau($alternanceTab);
        }
        $stage = array_merge($alternance, $stage);
        return array_merge($stalternance, $stage);
    }

    public function get(string $id): ?ExperienceProfessionnel
    {
        $sql = "SELECT *
                    FROM ExperienceProfessionnel e
                    WHERE e.idExperienceProfessionnel = :id";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $stalternance = $pdoStatement->fetch();

        // S'il n'y a pas d'offre associée
        if (!$stalternance) {
            return null;
        } else {
            return ExperienceProfessionnelRepository::construireDepuisTableau($stalternance);
        }
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null): array
    {
        $tabStages = StageRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        $tabAlternance = AlternanceRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        //$tabStalternance =
        if (isset($stage)) {
            return $tabStages;
        } elseif (isset($alternance)) {
            return $tabAlternance;
        } else {
            if (!isset($optionTri)) {
                return array_merge($tabStages, $tabAlternance);
            } else {
                return self::sort($tabStages, $tabAlternance, $optionTri);
            }

        }
    }

    private static function sort(array $stages, array $alternances, string $option): array
    {
        if ($option == "salaireCroissant" || $option == "salaireDecroissant") {
            return array_merge($stages, $alternances);
        }
        $allExperienceProfessionnel = array();
        while (!empty($stages) && !empty($alternances)) {
            $order = match ($option) {
                "datePublication" => strtotime($stages[0]->getDatePublication()) - strtotime($alternances[0]->getDatePublication()),
                "datePublicationInverse" => strtotime($alternances[0]->getDatePublication()) - strtotime($stages[0]->getDatePublication())
            };
            if ($order < 0) {
                $allExperienceProfessionnel[] = array_shift($stages);
            } else {
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);
    }

    public function mettreAJour(AbstractDataObject $exp): void
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
            "sujetTag" => $exp->getSujetExperienceProfessionnel(),
            "thematiqueTag" => $exp->getThematiqueExperienceProfessionnel(),
            "tacheTag" => $exp->getTachesExperienceProfessionnel(),
            "codePostalTag" => $exp->getCodePostalExperienceProfessionnel(),
            "adresseTag" => $exp->getAdresseExperienceProfessionnel(),
            "dateDebutTag" => $exp->getDateDebutExperienceProfessionnel(),
            "dateFinTag" => $exp->getDateFinExperienceProfessionnel(),
            "idExpPro" => $exp->getIdExperienceProfessionnel()
        );
        $pdoStatement->execute($values);
    }

    public function supprimer(string $exp): void
    {
        $sql = "DELETE FROM ExperienceProfessionnel WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $exp->getIdExperienceProfessionnel()
        );

        $pdoStatement->execute($values);
    }

    public static function search(string $keywords)
    {
        /*$stage = StageRepository::search($keywords);
        $alternance = AlternanceRepository::search($keywords);
        $sql = "SELECT *
                        FROM ExperienceProfessionnel e
                        JOIN Entreprises en ON en.siret = e.siret
                        WHERE numEtudiant IS NULL
                        AND en.estValide = true
                        AND (sujetExperienceProfessionnel LIKE :keywordsTag
                        OR thematiqueExperienceProfessionnel LIKE :keywordsTag
                        OR tachesExperienceProfessionnel LIKE :keywordsTag
                        OR codePostalExperienceProfessionnel LIKE :keywordsTag
                        OR adresseExperienceProfessionnel LIKE :keywordsTag
                        OR e.siret LIKE :keywordsTag)
                        AND NOT EXISTS (SELECT * FROM Stages
                                                WHERE Stages.idStage = e.idExperienceProfessionnel)
                                                AND NOT EXISTS (SELECT * FROM Alternances
                                                WHERE Alternances.idAlternance = e.idExperienceProfessionnel)
                        ORDER BY datePublication
                        ";
        $requestStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "keywordsTag" => '%' . $keywords . '%'
        );

        $requestStatement->execute($values);

        $stalternance = [];
        foreach ($requestStatement as $stalternanceTab) {
            $stalternance[] = self::construireDepuisTableau($stalternanceTab);
        }
        $alternance = self::sort($alternance, $stalternance, "datePublication");
        return self::sort($alternance, $stage, "datePublication");*/
    }

    public static function getDatePublication(string $id): string
    {
        $sql = "SELECT get_delay_experience(:id) AS delai_experience FROM ExperienceProfessionnel WHERE idExperienceProfessionnel = :id;";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = array(
            "id" => $id // Utilisez "id" au lieu de "idExperienceProfessionnel" pour correspondre aux paramètres dans la requête SQL
        );
        $pdoStatement->execute($values);
        $result = $pdoStatement->fetch();
        return $result["delai_experience"]; // Utilisez le même alias que celui défini dans la requête SQL
    }

}