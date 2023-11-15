<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;
use App\SAE\Model\DataObject\TuteurProfessionnel;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\DepartementRepository;
use App\SAE\Model\Repository\EnseignantRepository;

;

use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\InscriptionRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\Repository\TuteurProfessionnelRepository;

class ControllerMain extends ControllerGenerique
{


    public static function createAccount(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer un compte',
                'cheminVueBody' => 'user/createAccount.php',
            ]
        );
    }

    public static function forgetPassword(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer un compte',
                'cheminVueBody' => 'user/forgetPassword.php',
            ]
        );
    }

    public static function resetPassword(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'changer le mot de passe',
                'cheminVueBody' => 'user/resetPassword.php',
            ]
        );
    }

    public static function preference():void{
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Préférence',
                'cheminVueBody' => 'user/preference.php',
            ]
        );
    }



    public static function import(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Importer',
                'cheminVueBody' => 'SAE/index.php',
            ]
        );
    }

    public static function importation(): void
    {
        if (isset($_POST["import"])) {
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

                        if ($i == 1) {//TuteurProfessionnel
                            (new TuteurProfessionnelRepository())->save(new TuteurProfessionnel($column[79], $column[78], $column[77],
                                $column[81], $column[80]));
                        } else if ($i == 2) {//Etudiants
                            (new EtudiantRepository())->save(new Etudiant($column[1], $column[2],
                                $column[3], $column[6], $column[7], $column[5], $column[45]));
                        } else if ($i == 3) {//Entreprises
                            (new EntrepriseRepository())->save(new Entreprise($column[55], $column[54], $column[59],
                                $column[64], $column[66], $column[69],"","","",""));
                        } else if ($i == 4) {//Enseignants
                            (new EnseignantRepository())->save(new Enseignant($column[31], $column[29], $column[30]));
                        } else if ($i == 5) {//stages
                            $stage = new Stage($column[19], $column[18], $column[20],
                                $column[59], $column[57], $column[13], $column[14], $column[55], $column[25]);
                            $stage->setNumEtudiant($column[1]);
                            $stage->setMailEnseignant($column[31]);
                            $stage->setMailTuteurProfessionnel($column[79]);
                            StageRepository::save($stage);
                        } else if ($i == 6) {//Inscriptions
                            (new DepartementRepository())->save(new Departement($column[36]));
                            (new AnneeUniversitaireRepository())->save(new AnneeUniversitaire($column[10]));
                            EtudiantRepository::inscrire($column[1], $column[36], $column[10]);

                        }
                    }


                }


            }
        }
        if (!empty($result)) {
            $messageErreur = 'Cette offer n existe pas !';
            self::error($messageErreur);
        } else {
            self::home();
        }
    }

    public static function displayTDBetu()
    {
        $listeExpPro = AbstractExperienceProfessionnelRepository::offreMoins7jours();
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
            ]
        );
    }

    public static function displayTDBentreprise()
    {
        $listeExpPro = AbstractExperienceProfessionnelRepository::search(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'user/tableauDeBord/entreprise.php',
            ]
        );
    }
}
