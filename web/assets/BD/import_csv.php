<?php
// Connect to database
namespace App\SAE\web\assets\BD;
include("../../../src/Model/Repository/EnseignantRepository.php");
include("../../../src/Config/Conf.php");

if (isset($_POST["import"])) {
    $tab = array("Departements", "Utilisateurs", "TuteurProfessionnel", "AnneeUniversitaire",
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
             values ('" . $column[10] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }*/

                /*else if ($i == 2) {//TuteurProfessionnel
                    $sql = "INSERT into $tab[$i]
             values ('" . $column[79] . "','" .  $column[78]  . "','" . $column[77] . "',
             '" . $column[81] . "','" . $column[80] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($i == 3) {//AnneeUniversitaire
                    $sql = "INSERT into $tab[$i] (nomAnneeUniversitaire)
             values ('" . $column[36] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }


                else if ($i == 4) {//Etudiants
                    $sql = "INSERT into $tab[$i]
             values ('" . $column[1] . "','" .  $column[2]  . "','" .  $column[3]  . "',
             '" .  $column[6]  . "','" .  $column[7]  . "','" .  $column[5]  . "',
             '" .  $column[45]  . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($i == 5) {//Entreprises
                    $sql = "INSERT into $tab[$i]
             values ('" . $column[55] . "','" .  $column[54]  . "','" .  $column[59]  . "',
             '" .  $column[64]  . "','" .  $column[66]  . "','" .  $column[69]  . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }*/

                if ($i == 6) {//Enseignants
                    if(\App\SAE\Model\Repository\EnseignantRepository::get($column[31])==null) {
                        $sql = "INSERT into $tab[$i]
             values ('" . $column[31] . "','" . $column[29] . "','" . $column[30] . "')";
                        $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                    }
                }/*

                else if ($i == 7) {//ExperienceProfessionnel
                    $sql = "INSERT into $tab[$i] (sujetExperienceProfessionnel, thematiqueExperienceProfessionnel , tacheExperienceProfessionnel,
                   codePostalExperienceProfessionnel, adresseExperienceProfessionnel, dateDebutExperienceProfessionnel,
                     dateFinExperienceProfessionnel, mailEtudiant, mailEnseignant, siret, mailTuteurProfessionnel)
             values ('" . $column[19] . "','" .  $column[18]  . "','" .  $column[20]  . "',
             '" .  $column[59]  . "','" .  $column[57]  . "','" .  $column[13]  . "','" .  $column[14]  . "'
             ,'" .  $column[1]  . "','" .  $column[31]  . "','" .  $column[55]  . "','" .  $column[79]  . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($i == 8) {//stages
                    $sql = "INSERT into $tab[$i] (gratificationStage)
             values ('" . $column[25] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($i == 9) {//Soutenances
                    $sql = "INSERT into $tab[$i] (dateSoutenance,heureDebutSoutenance,heureFinSoutenance,
                    salleSoutenance,noteSoutenance,mailEnseignant,idStage)
             values ('" . $column[?] . "','" . $column[?] . "','" . $column[?] . "'
                ,'" . $column[?] . "','" . $column[?] . "','" . $column[31] . "'
                ,'" . $column[?] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($i == 10) {//Alternances
                    $sql = "INSERT into $tab[$i]
             values ()";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }

                else if ($tab[$i] == 11) {//Inscriptions
                    $sql = "INSERT into $tab[$i] (numEtudiant)
             values ('" . $column[1] . "')";
                    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
                }*/




            }


            if (!empty($result)) {
                $type = "success";
                $message = "Les Données sont importées dans la base de données";
            } else {
                $type = "error";
                $message = "Problème lors de l'importation de données CSV";
            }
        }

    }
}
//Retourner à la page index.php
header('Location: index.php');
exit;
?>