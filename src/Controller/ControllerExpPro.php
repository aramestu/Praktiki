<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\Stage;

class ControllerExpPro extends ControllerGenerique{
    public static function getExpProByDefault(): void
    {
        $listeExpPro = ExperienceProfessionnelRepository::getAll();
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function getExpProBySearch(){
        $keywords = urldecode($_GET['keywords']);
        $listeExpPro = ExperienceProfessionnelRepository::search($keywords);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'keywords' => $keywords,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function getExpProBySearch(){
        $keywords = urldecode($_GET['keywords']);
        $listeExpPro = ExperienceProfessionnelRepository::search($keywords);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'keywords' => $keywords,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function getExpProByFiltre(): void
    {
        $dateDebut = null;
        $dateFin = null;
        $optionTri = null;
        $stage = null;
        $alternance = null;
        $codePostal = null;
        if (isset($_GET['dateDebut'])){
            $dateDebut = $_GET['dateDebut'];
        }
        if (isset($_GET['dateFin'])){
            $dateFin = $_GET['dateFin'];
        }
        if (isset($_GET['optionTri'])){
            $optionTri = $_GET['optionTri'];
        }
        if (isset($_GET['stage'])){
            $stage = $_GET['stage'];
        }
        if (isset($_GET['alternance'])){
            $alternance = $_GET['alternance'];
        }
        if (isset($_GET['codePostal'])){
            $codePostal = $_GET['codePostal'];
        }
        $listeExpPro = ExperienceProfessionnelRepository::filtre($dateDebut, $dateFin, $optionTri, $stage, $alternance, $codePostal);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function modifierDepuisFormulaire()
    {
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
        if ($_POST["typeOffre"] == "stage") {
            $tab["gratification"] = $_POST["gratification"]; // Un stage a une gratification à renseigner en plus
            $tab["idStage"] = $_POST["id"];
            $stage = StageRepository::construireDepuisTableau($tab);
            StageRepository::mettreAJour($stage);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        } // Si c'est une alternance
        elseif ($_POST["typeOffre"] == "alternance") {
            $tab["idAlternance"] = $_POST["id"];
            $alternance = AlternanceRepository::construireDepuisTableau($tab);
            AlternanceRepository::mettreAJour($alternance);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        } // Si ce n'est aucun des 2 alors ce n'est pas normal
        else {
            ControllerGenerique::error("Ce type d'offer n'existe pas");
        }
    }

    public static function afficherVueEndOffer($msg)
    {
        ControllerGenerique::afficheVue("view.php", [
            "pagetitle" => "Gestion d'offer",
            "cheminVueBody" => "offer/endOffer.php",
            "message" => $msg
        ]);
    }

    public static function afficherFormulaireModification()
    {
        $idExpPro = $_GET["experiencePro"];
        $pagetitle = 'Modification Offre';
        $cheminVueBody = 'offer/editOffer.php';

        $stage = StageRepository::get($idExpPro);


        // Si c'est un stage alors c'est good
        if (!is_null($stage)) {
            ControllerGenerique::afficheVue('view.php', [
                "pagetitle" => $pagetitle,
                "cheminVueBody" => $cheminVueBody,
                "experiencePro" => $stage
            ]);
        } // On vérifie que c'est une alternance sinon on affiche un message d'erreur
        else {
            // On vérifie que c'est une alternance
            $alternance = AlternanceRepository::get($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                ControllerGenerique::afficheVue('view.php', [
                    "pagetitle" => $pagetitle,
                    "cheminVueBody" => $cheminVueBody,
                    "experiencePro" => $alternance
                ]);
            } else {
                $messageErreur = 'Cette offer n existe pas !';
                ControllerGenerique::error($messageErreur);
            }
        }
    }

    public static function afficherOffre()
    {
        $idExpPro = $_GET["experiencePro"];

        $stage = StageRepository::get($idExpPro);

        if (!is_null($stage)) {
            ControllerGenerique::afficheVue('view.php', [
                "pagetitle" => "Affichage offer",
                "cheminVueBody" => "offer/offer.php",
                "expPro" => $stage
            ]);
        } else {
            $alternance = AlternanceRepository::get($idExpPro);
            if (!is_null($alternance)) {
                ControllerGenerique::afficheVue('view.php', [
                    "pagetitle" => "Affichage offer",
                    "cheminVueBody" => "offer/offer.php",
                    "expPro" => $alternance
                ]);
            } else {
                $messageErreur = 'Cette offer n existe pas !';
                ControllerGenerique::error($messageErreur);
            }
        }
    }

    public static function creerOffreDepuisFormulaire(): void
    {
        $msg = "Offre crée avec succés !";
        if ($_POST["typeOffre"] == "stage") {
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
        } else if ($_POST["typeOffre"] == "alternance") {
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

    public static function supprimerOffre()
    {
        $idExpPro = $_GET["experiencePro"];
        $stage = StageRepository::get($idExpPro);

        // Si c'est un stage alors c'est good
        if (!is_null($stage)) {
            StageRepository::supprimer($stage);
            self::afficherVueEndOffer("Stage supprimée avec succès");
        } else {
            $alternance = AlternanceRepository::get($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                AlternanceRepository::supprimer($alternance);
                self::afficherVueEndOffer("Alternance supprimée avec succès");
            } else {
                ControllerGenerique::error("L'offer à supprimer n'existe pas");
            }
        }
    }

    public static function createOffer()
    {
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer une offer',
                'cheminVueBody' => 'offer/createOffer.php',
            ]
        );
    }

    public static function displayOffer()
    {
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }
}


