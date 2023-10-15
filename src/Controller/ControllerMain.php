<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\DepartementRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
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
                $isFirstLine = true;
                $fileName = $_FILES["file"]["tmp_name"];
                if ($_FILES["file"]["size"] > 0) {
                    $file = fopen($fileName, "r");

                    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                        if ($isFirstLine) {
                            $isFirstLine = false;
                            continue;
                        }
                        for ($i = 0; $i < 11; $i++) {


                        if ($i == 0) {//Departements
                            $sql = "INSERT into $tab[$i] (nomDepartement)
             values (:nomdepartement)";
                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "nomdepartement" => $column[10],
                            );
                            $pdoStatement->execute($values);
                        }

                        else if ($i == 1) {//TuteurProfessionnel
                            TuteurProfessionnelRepository::get($column[79],$column[78],$column[77],
                                $column[81],$column[80]);
                        }

                        else if ($i == 2) {//AnneeUniversitaire
                            $sql = "INSERT into $tab[$i] (nomAnneeUniversitaire)
                 values (:nomAnnee)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "nomAnnee" => $column[36],
                            );
                            $pdoStatement->execute($values);
                        }

                        else if ($i == 3) {//Etudiants
                            EtudiantRepository::get($column[1],$column[2],
                                $column[3], $column[6],$column[7],$column[5],$column[45]);

                        }

                        else if ($i == 4) {//Entreprises
                            EntrepriseRepository::import($column[55],$column[54],$column[59],
                                $column[64],$column[66],$column[69]);

                        }

                        else if ($i == 5) {//Enseignants
                            EnseignantRepository::get($column[31],$column[29],$column[30]);
                        }

                        else if ($i == 6) {//ExperienceProfessionnel
                            $sql = "INSERT into $tab[$i] (sujetExperienceProfessionnel, thematiqueExperienceProfessionnel , tachesExperienceProfessionnel,
                       codePostalExperienceProfessionnel, adresseExperienceProfessionnel, dateDebutExperienceProfessionnel,
                         dateFinExperienceProfessionnel, numEtudiant, mailEnseignant, siret, mailTuteurProfessionnel)
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
                        }

                        else if ($i == 7) {//stages
                            $sql = "INSERT into $tab[$i]
                 values (:id,:gratif)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "id" => ExperienceProfessionnelRepository::lastExperienceProfessionnel(),
                                "gratif" => $column[25]
                            );
                            $pdoStatement->execute($values);

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
                        }*/

                        else if ($i == 10) {//Inscriptions
                            $sql = "INSERT into $tab[$i] 
                 values (:numEtu,:idAnnee,:codedepartement)";

                            $pdoStatement = Model::getPdo()->prepare($sql);
                            $values = array(
                                "numEtu" => $column[1],
                                "idAnnee" => AnneeUniversitaireRepository::lastAnneeUniversitaire(),
                                "codedepartement" => DepartementRepository::lastDepartement()
                            );
                            $pdoStatement->execute($values);

                        }
                    }


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
