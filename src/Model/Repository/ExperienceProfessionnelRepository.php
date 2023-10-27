<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

class ExperienceProfessionnelRepository {
    public static function save(ExperienceProfessionnel $e) : bool
    {
        try {
            $pdo = Model::getPdo();
            $requestStatement = $pdo->prepare("INSERT INTO ExperienceProfessionnel(sujetExperienceProfessionnel, thematiqueExperienceProfessionnel,
                                                                                    tachesExperienceProfessionnel, codePostalExperienceProfessionnel,
                                                                                    adresseExperienceProfessionnel, dateDebutExperienceProfessionnel, 
                                                                                    dateFinExperienceProfessionnel, siret) 
                                                    VALUES(:sujetExperienceProfessionnelTag, :thematiqueExperienceProfessionnelTag,
                                                            :tachesExperienceProfessionnelTag, :codePostalExperienceProfessionnelTag,
                                                            :adresseExperienceProfessionnelTag, :dateDebutExperienceProfessionnelTag, 
                                                            :dateFinExperienceProfessionnelTag, :siretTag)");
            $values = array("sujetExperienceProfessionnelTag" => $e->getSujetExperienceProfessionnel(),
                "thematiqueExperienceProfessionnelTag" => $e->getThematiqueExperienceProfessionnel(),
                "tachesExperienceProfessionnelTag" => $e->getTachesExperienceProfessionnel(),
                "codePostalExperienceProfessionnelTag" => $e->getCodePostalExperienceProfessionnel(),
                "adresseExperienceProfessionnelTag" => $e->getAdresseExperienceProfessionnel(),
                "dateDebutExperienceProfessionnelTag" => $e->getDateDebutExperienceProfessionnel(),
                "dateFinExperienceProfessionnelTag" => $e->getDateFinExperienceProfessionnel(),
                "siretTag" => $e->getSiret());
            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function construireDepuisTableau($stalternanceFormatTableau): ExperienceProfessionnel
    {
        $exp = new ExperienceProfessionnel($stalternanceFormatTableau["sujetExperienceProfessionnel"],$stalternanceFormatTableau["thematiqueExperienceProfessionnel"],
            $stalternanceFormatTableau["tachesExperienceProfessionnel"],$stalternanceFormatTableau["codePostalExperienceProfessionnel"],
            $stalternanceFormatTableau["adresseExperienceProfessionnel"],$stalternanceFormatTableau["dateDebutExperienceProfessionnel"],
            $stalternanceFormatTableau["dateFinExperienceProfessionnel"],$stalternanceFormatTableau["siret"]);
            if(array_key_exists("idExperienceProfessionnel", $stalternanceFormatTableau)){
                $exp->setIdExperienceProfessionnel($stalternanceFormatTableau["idExperienceProfessionnel"]);
            }
            if(array_key_exists("numEtudiant", $stalternanceFormatTableau)){
                if(!empty($stalternanceFormatTableau["numEtudiant"])){
                    $exp->setNumEtudiant($stalternanceFormatTableau["numEtudiant"]);
                }
            }
            if(array_key_exists("mailEnseignant", $stalternanceFormatTableau)){
                 if(!empty($stalternanceFormatTableau["mailEnseignant"])){
                    $stage->setMailEnseignant($stalternanceFormatTableau["mailEnseignant"]);
                 }
            }
            if(array_key_exists("mailTuteurProfessionnel", $stalternanceFormatTableau)){
                 if(!empty($stalternanceFormatTableau["mailTuteurProfessionnel"])){
                    $stage->setMailTuteurProfessionnel($stalternanceFormatTableau["mailTuteurProfessionnel"]);
                 }
            }
            if(array_key_exists("datePublication", $stalternanceFormatTableau)){
                $exp->setDatePublication($stalternanceFormatTableau["datePublication"]);
            }
        return $exp;
    }

    public static function getAll() : array{
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
                    $stalternance[] = self::construireDepuisTableau($alternanceTab);
                }
                $stage = array_merge($alternance, $stage);
        return array_merge($stalternance, $stage);
    }

    public static function get(string $id) :?ExperienceProfessionnel {
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
            if (! $stalternance) {
                return null;
            } else {
                return ExperienceProfessionnelRepository::construireDepuisTableau($stalternance);
            }
        }

    public static function filtre(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null) : array
    {
        $tabStages = StageRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        $tabAlternance = AlternanceRepository::filtre($dateDebut, $dateFin, $optionTri, $codePostal, $datePublication);
        //$tabStalternance =
        if (isset($stage)){
            return $tabStages;
        }
        elseif (isset($alternance)){
            return $tabAlternance;
        }
        else{
            if (!isset($optionTri)) {
                return array_merge($tabStages, $tabAlternance);
            }else{
                return self::sort($tabStages, $tabAlternance, $optionTri);
            }

        }
    }

    private static function sort(array $stages, array $alternances, string $option): array{
        if($option == "salaireCroissant" || $option == "salaireDecroissant" ){
            return array_merge($stages, $alternances);
        }
        $allExperienceProfessionnel = array();
        while(!empty($stages) && !empty($alternances)){
            $order = match ($option){
                "datePublication" => strtotime($stages[0]->getDatePublication()) - strtotime($alternances[0]->getDatePublication()),
                "datePublicationInverse" => strtotime($alternances[0]->getDatePublication()) - strtotime($stages[0]->getDatePublication())
            };
            if($order<0){
                $allExperienceProfessionnel[] = array_shift($stages);
            }else{
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);
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

    public static function supprimer(ExperienceProfessionnel $exp): void {
        $sql = "DELETE FROM ExperienceProfessionnel WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $exp->getIdExperienceProfessionnel()
        );

        $pdoStatement->execute($values);
    }

    public static function search(string $keywords){
        $stage = StageRepository::search($keywords);
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
                foreach ($requestStatement as $stalternanceTab){
                    $stalternance[] = self::construireDepuisTableau($stalternanceTab);
                }
        $alternance = self::sort($alternance, $stalternance, "datePublication");
        return self::sort($alternance, $stage, "datePublication");
    }
}