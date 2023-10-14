<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\TuteurProfessionnelRepository;

class ControllerMain extends ControllerGenerique
{




    public static function connect()
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Connexion',
                'cheminVueBody' => 'user/connect.php',
            ]
        );
    }

    public static function createAccount()
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer un compte',
                'cheminVueBody' => 'user/createAccount.php',
            ]
        );
    }

    public static function import()
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Importer',
                'cheminVueBody' => 'SAE/index.php',
            ]
        );
    }

    public static function importation()
    {
        if (isset($_POST["import"])) {
            $tab = array("Departements", "TuteurProfessionnel", "AnneeUniversitaire",
                "Etudiants", "Entreprises", "Enseignants", "ExperienceProfessionnel", "Stages",
                "Soutenances", "Alternances", "Inscriptions");
            for ($i = 0; $i < 12; $i++) {
                $isFirstLine = true;
                $fileName = $_FILES["file"]["tmp_name"];
                if ($_FILES["file"]["size"] > 0) {
                    $file = fopen($fileName, "r");

                    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                        if ($isFirstLine) {
                            $isFirstLine = false;
                            continue;
                        }


                        /*if ($i == 0) {//Departements
                            $sql = "INSERT into $tab[$i] (nomDepartement)
             values (:nomdepartement)";
                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "nomdepartement" => $column[10],
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(Conf::conn(), $sql);
                        }*/

                        else if ($i == 1) {//TuteurProfessionnel
                            if (TuteurProfessionnelRepository::get($column[79]) == null) {
                                $sql = "INSERT into TuteurProfessionnel 
                             values ( :mailtuteur, :prenomtuteur, :nomtuteur, :fonctiontuteur, :telephonetuteur)";

                                $pdoStatement = Model::getPdo()->prepare($sql);
                                $values = array(
                                    "mailtuteur" => $column[79],
                                    "prenomtuteur" => $column[78],
                                    "nomtuteur" => $column[77],
                                    "fonctiontuteur" => $column[81],
                                    "telephonetuteur" => $column[80]);
                                $pdoStatement->execute($values);
                            }
                        }/*

                        else if ($i == 2) {//AnneeUniversitaire
                            $sql = "INSERT into $tab[$i] (nomAnneeUniversitaire)
                 values (:nomAnnee)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "nomAnnee" => $column[36],
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        else if ($i == 3) {//Etudiants
                            $sql = "INSERT into $tab[$i]
                 values ( :numEtu, :nomEtu, :prenomEtu,
                 :mailPerso,:mailUniv,:telephonePort,
                 :codePostal)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "numEtu" => $column[1],
                                "nomEtu" => $column[2],
                                "prenomEtu" => $column[3],
                                "mailPerso" => $column[6],
                                "mailUniv" => $column[7],
                                "telephonePort" => $column[5],
                                "codePostal" => $column[45]
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        else if ($i == 4) {//Entreprises
                            if (EntrepriseRepository::getStatic($column[55]) == null) {
                                $sql = "INSERT into $tab[$i]
                 values (:siret,:nomEnt,:codePostalEnt,
                 :effectEnt,:telEnt,:siteEnt)";

                                $pdoStatement = Model::getPdo()->prepare($sql);
                                $values = array(
                                    "siret" => $column[55],
                                    "nomEnt" => $column[54],
                                    "codePostalEnt" => $column[59],
                                    "effectEnt" => $column[64],
                                    "telEnt" => $column[66],
                                    "siteEnt" => $column[69]
                                );
                                $pdoStatement->execute($values);

                                $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                            }
                        }

                        else if ($i == 5) {//Enseignants
                            //if(EnseignantRepository::get($column[31])==null) {
                            $sql = "INSERT into $tab[$i]
                 values (:mailEnsei, :nomEnsei, :prenonEnsei)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "mailEnsei" => $column[31],
                                "nomEnsei" => $column[29],
                                "prenomEnsei" => $column[30],
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                            // }
                        }

                        else if ($i == 6) {//ExperienceProfessionnel
                            $sql = "INSERT into $tab[$i] (sujetExperienceProfessionnel, thematiqueExperienceProfessionnel , tacheExperienceProfessionnel,
                       codePostalExperienceProfessionnel, adresseExperienceProfessionnel, dateDebutExperienceProfessionnel,
                         dateFinExperienceProfessionnel, mailEtudiant, mailEnseignant, siret, mailTuteurProfessionnel)
                 values (:sujet,:thematique,:taches, :codePostal,:adresse,:dateDeb,:dateFin
                 ,:numEtu,:mailEnsei,:siret,:mailTuteur)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "sujet" => $column[19],
                                "thematique" => $column[18],
                                "taches" => $column[20],
                                "codePostal" => $column[59],
                                "adresse" => $column[57],
                                "dateDeb" => $column[13],
                                "dateFin" => $column[14],
                                "numEtu" => $column[1],
                                "mailEnsei" => $column[31],
                                "siret" => $column[55],
                                "mailTuteur" => $column[79]
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        else if ($i == 7) {//stages
                            $sql = "INSERT into $tab[$i] (gratificationStage)
                 values (:gratif)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "gratif" => $column[25]
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        /*else if ($i == 8) {//Soutenances
                            $sql = "INSERT into $tab[$i] (dateSoutenance,heureDebutSoutenance,heureFinSoutenance,
                        salleSoutenance,noteSoutenance,mailEnseignant,idStage)
                        values ('" . $column[?] . "','" . $column[?] . "','" . $column[?] . "'
                        ,'" . $column[?] . "','" . $column[?] . "','" . $column[31] . "'
                        ,'" . $column[?] . "')";
                        $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        else if ($i == 9) {//Alternances
                            $sql = "INSERT into $tab[$i]
                 values ()";
                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }

                        else if ($tab[$i] == 10) {//Inscriptions
                            $sql = "INSERT into $tab[$i] (numEtudiant)
                 values (:numEtu)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "numEtu" => $column[1]
                            );
                            $pdoStatement->execute($values);

                            $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                        }
                    }*/


                    }


                }
            }
            if (!empty($result)) {
                $messageErreur = 'Cette offer n existe pas !';
                self::error($messageErreur);}
            else{
                self::home();
            }
        }

    }
}
