<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
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

    public static function afficherVueEndOffer($msg){
        self::afficheVue("view.php", [
            "pagetitle" => "Gestion d'offre",
            "cheminVueBody" => "SAE/endOffer.php",
            "message" => $msg
        ]);
    }

    public static function creerOffreDepuisFormulaire(): void {
        $msg = "Offre crée avec succés !";
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
            self::afficherVueEndOffer($msg); // Redirection vers une page
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
            self::afficherVueEndOffer($msg); // Redirection vers une page
        }
    }

    public static function afficherFormulaireModification(){
        $idExpPro = $_GET["experiencePro"];
        $pagetitle = 'Modification Offre';
        $cheminVueBody = 'SAE/editOffer.php';

        $stage = StageRepository::get($idExpPro);


        // Si c'est un stage alors c'est good
        if(! is_null($stage)){
            ControllerMain::afficheVue('view.php', [
                "pagetitle" => $pagetitle,
                "cheminVueBody" => $cheminVueBody,
                "experiencePro" => $stage
            ]);
        }
        // On vérifie que c'est une alternance sinon on affiche un message d'erreur
        else{
            // On vérifie que c'est une alternance
            $alternance = AlternanceRepository::get($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (! is_null($alternance)){
                ControllerMain::afficheVue('view.php', [
                    "pagetitle" => $pagetitle,
                    "cheminVueBody" => $cheminVueBody,
                    "experiencePro" => $alternance
                ]);
            }
            else{
                $messageErreur = 'Cette offre n existe pas !';
                self::error($messageErreur);
            }
        }
    }

    // EN COURS
    public static function modifierDepuisFormulaire(){
        $msg = "Offre modifiée avec succés !";
        $tab = [
            "sujet" => $_POST["sujet"],
            "thematique" => $_POST["thematique"],
            "taches" => $_POST["taches"],
            "codePostal" => $_POST["codePostal"],
            "adresse" => $_POST["adressePostale"],
            "dateDebut" => $_POST["dateDebut"],
            "dateFin" => $_POST["dateFin"],
            "siret" => $_POST["siret"],
        ];
        // Si c'est un stage
        if($_POST["typeOffre"] == "stage"){
            $tab["gratification"] = $_POST["gratification"]; // Un stage a une gratification à renseigner en plus
            $tab["idStage"] = $_POST["id"];
            $stage = StageRepository::construireDepuisTableau($tab);
            StageRepository::mettreAJour($stage);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        }
        // Si c'est une alternance
        elseif($_POST["typeOffre"] == "alternance"){
            $tab["idAlternance"] = $_POST["id"];
            $alternance = AlternanceRepository::construireDepuisTableau($tab);
            AlternanceRepository::mettreAJour($alternance);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        }
        // Si ce n'est aucun des 2 alors ce n'est pas normal
        else{
            self::error("Ce type d'offre n'existe pas");
        }
    }

    public static function supprimerOffre(){
        $idExpPro = $_GET["experiencePro"];
        $stage = StageRepository::get($idExpPro);

        // Si c'est un stage alors c'est good
        if(! is_null($stage)){
            StageRepository::supprimer($stage);
            self::afficherVueEndOffer("Stage supprimée avec succès");
        }
        else{
            $alternance = AlternanceRepository::get($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (! is_null($alternance)){
                AlternanceRepository::supprimer($alternance);
                self::afficherVueEndOffer("Alternance supprimée avec succès");
            }
            else{
                self::error("L'offre à supprimer n'existe pas");
            }
        }
    }

    public static function afficherOffre() {
        $idExpPro = $_GET["experiencePro"];

        $stage = StageRepository::get($idExpPro);

        if(! is_null($stage)) {
            ControllerMain::afficheVue('view.php', [
                "pagetitle" => "Affichage offre",
                "cheminVueBody" => "SAE/offer.php",
                "expPro" => $stage
            ]);
        }
        else{
            $alternance = AlternanceRepository::get($idExpPro);
            if (! is_null($alternance)){
                ControllerMain::afficheVue('view.php', [
                    "pagetitle" => "Affichage offre",
                    "cheminVueBody" => "SAE/offer.php",
                    "expPro" => $alternance
                ]);
            }
            else{
                $messageErreur = 'Cette offre n existe pas !';
                self::error($messageErreur);
            }
        }
    }


    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . '/../View/' . $cheminVue;
    }
}

?>
