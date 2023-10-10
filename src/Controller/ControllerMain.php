<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\DataObject\Stage;

class ControllerMain
{
    public static function home()
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Accueil',
                        'cheminVueBody' => 'SAE/home.php',
                    ]
                );
    }

    public static function error(string $messageErreur)
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Erreur',
                        'cheminVueBody' => 'SAE/error.php',
                        'messageErreur' => $messageErreur,
                    ]
                );
    }

    public static function connect()
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Connexion',
                        'cheminVueBody' => 'SAE/connect.php',
                    ]
                );
    }

    public static function createAccount()
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Créer un compte',
                        'cheminVueBody' => 'SAE/createAccount.php',
                    ]
                );
    }

    public static function createOffer(){
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Créer une offre',
                        'cheminVueBody' => 'SAE/createOffer.php',
                    ]
                );
    }

    public static function displayOffer(){
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Offre',
                        'cheminVueBody' => 'SAE/offerList.php',
                    ]
                );
    }

    public static function creerOffreDepuisFormulaire(): void {
        if($_POST["typeOffre"] =="stage"){
            $stage = StageRepository::construireDepuisTableau([
                                                        "sujet" => $_POST["sujet"],
                                                        "thematique" => $_POST["thematique"],
                                                        "taches" => $_POST["taches"],
                                                        "codePostal" => $_POST["codePostal"],
                                                        "adresse" => $_POST["adressePostale"],
                                                        "dateDebut" => $_POST["dateDebut"],
                                                        "dateFin" => $_POST["dateFin"],
                                                        "siret" => $_POST["siret"],
                                                        "gratification" => $_POST["gratification"]
                                                    ]);
            StageRepository::save($stage);
        }else if($_POST["typeOffre"] =="alternance"){
            $alternance = AlternanceRepository::construireDepuisTableau([
                                                        "sujet" => $_POST["sujet"],
                                                        "thematique" => $_POST["thematique"],
                                                        "taches" => $_POST["taches"],
                                                        "codePostal" => $_POST["codePostal"],
                                                        "adresse" => $_POST["adressePostale"],
                                                        "dateDebut" => $_POST["dateDebut"],
                                                        "dateFin" => $_POST["dateFin"],
                                                        "siret" => $_POST["siret"],
                                                    ]);
            AlternanceRepository::save($alternance);
        }
    }

    // EN COURS
    public static function afficherFormulaireModification(){
        $idExpPro = $_GET["experiencePro"];
        $pagetitle = 'Modification Offre';
        $cheminVueBody = 'SAE/editOffer.php';
        $expPro = StageRepository::getStageParId($idExpPro);
        // Si c'est un stage
        if(! is_null($expPro)){
            ControllerMain::afficheVue('view.php', [
                "pagetitle" => $pagetitle,
                "cheminVueBody" => $cheminVueBody,
                "id" => $idExpPro
            ]);
        }

    }

    // EN COURS
    public static function modifierDepuisFormulaire(){

    }


    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . '/../View/' . $cheminVue;
    }
}

?>
