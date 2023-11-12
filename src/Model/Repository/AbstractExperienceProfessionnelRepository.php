<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

abstract class AbstractExperienceProfessionnelRepository extends AbstractRepository
{
    protected abstract function getNomsColonnesSupplementaires(): array;
    protected abstract function getNomDataObject(): string;
    public abstract function construireDepuisTableau(array $objetFormatTableau): ExperienceProfessionnel;

    protected function getNomsColonnes(): array
    {
        return array("idExperienceProfessionnel","sujetExperienceProfessionnel", "thematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel", "codePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel", "dateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel", "siret", "numEtudiant", "mailEnseignant", "mailTuteurProfessionnel", "datePublication");
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

    public function getAll(): array
    {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $requestStatement =  $pdo->query("SELECT * FROM $nomTable 
        JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire");

        $objects = [];
        foreach ($requestStatement as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    public function get(string $id): ?ExperienceProfessionnel
    {
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $sql = "SELECT * 
                FROM $nomTable 
                JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire
                WHERE e.idExperienceProfessionnel = :id";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $exp = $pdoStatement->fetch();

        // S'il n'y a pas d'offre associée
        if (! $exp) {
            return null;
        }
        return $this->construireDepuisTableau($exp);
    }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null): array
    {
        $tabStages = StageRepository::filtres($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        $tabAlternance = AlternanceRepository::filtres($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
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
        // Mise à jour de la table Experience Pro
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

        // Mise à jour de la sous table s'il n'y a pas que la clé primaire
        $colonnes = $this->getNomsColonnesSupplementaires();
        if(sizeof($colonnes) > 1){
            $nomTable = $this->getNomTable();
            $nomClePrimaire = $this->getNomClePrimaire();
            $values2 = array();
            $formatTableau = $exp->formatTableau();
            $sql2 = "UPDATE $nomTable SET ";
            // Je rempli la requête et le tableau de valeur grâce au format Tableau
            for($i = 1; $i < sizeof($colonnes); $i++){
                $nomColonne = $colonnes[$i];
                $sql2 .= " $nomColonne= :$nomColonne" . "Tag";
                $values2[$nomColonne . "Tag"] = $formatTableau[$nomColonne . "Tag"];
            }
            // Ajout condition WHERE pour
            $sql2 .= " WHERE $nomClePrimaire= :$nomClePrimaire" . "Tag";
            $values2[$nomClePrimaire . "Tag"] = $formatTableau["idExperienceProfessionnelTag"];
            $pdoStatement = Model::getPdo()->prepare($sql2);
            $pdoStatement->execute($values2);
        }

    }

    public function supprimer(string $id): void
    {
        // On supprime d'abord les sous classes puis dans ExpPro
        parent::supprimer($id);

        $sql = "DELETE FROM ExperienceProfessionnel WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $id
        );

        $pdoStatement->execute($values);
    }

    public static function search(string $keywords): array
    {
        $stage = StageRepository::search($keywords);
        $alternance = AlternanceRepository::search($keywords);
        /*$sql = "SELECT *
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
        $alternance = self::sort($alternance, $stalternance, "datePublication"); */
        return self::sort($alternance, $stage, "datePublication");
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