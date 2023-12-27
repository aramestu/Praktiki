<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\OffreNonDefiniRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Service\ServiceAlternance;
use App\SAE\Service\ServiceOffreNonDefini;
use App\SAE\Service\ServiceStage;

class ControllerExpPro extends ControllerGenerique
{
    public static function getExpProByDefault(): void
    {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search("");
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function getNbTotal(): int
    {
        return (new ExperienceProfessionnelRepository())->getNbExperienceProfessionnel();
    }

    public static function getNbStageTotal(): int
    {
        return (new StageRepository())->getNbOffre();
    }

    public static function getNbAlternanceTotal(): int
    {
        return (new AlternanceRepository())->getNbOffre();
    }

    public static function getNbOffreNonDefiniTotal(): int
    {
        return (new OffreNonDefiniRepository())->getNbOffre();
    }


    public static function getExpProRecent(): void
    {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, null, null, null, null,
            null, null, "lastWeek", null, null);;
        extract($listeExpPro);
        require __DIR__ . "/../View/offer/offerTable.php";
    }

    public static function getExpProEntreprise(): void
    {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        extract($listeExpPro);
        require __DIR__ . "/../View/offer/offerTable.php";
    }


    public static function getExpProBySearch(): void
    {
        $keywords = urldecode($_GET['keywords']);
        $listeExpPro = (new ExperienceProfessionnelRepository())->search($keywords);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
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
        $datePublication = null;
        $BUT2 = null;
        $BUT3 = null;
        if (isset($_GET['dateDebut'])) {
            $dateDebut = $_GET['dateDebut'];
        }
        if (isset($_GET['dateFin'])) {
            $dateFin = $_GET['dateFin'];
        }
        if (isset($_GET['optionTri'])) {
            $optionTri = $_GET['optionTri'];
        }
        if (isset($_GET['stage'])) {
            $stage = $_GET['stage'];
        }
        if (isset($_GET['alternance'])) {
            $alternance = $_GET['alternance'];
        }
        if (isset($_GET['codePostal'])) {
            $codePostal = $_GET['codePostal'];
        }
        if (isset($_GET['datePublication'])) {
            $datePublication = $_GET['datePublication'];
        }
        if (isset($_GET['BUT2'])) {
            $BUT2 = $_GET['BUT2'];
        }
        if (isset($_GET['BUT3'])) {
            $BUT3 = $_GET['BUT3'];
        }
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, $dateDebut, $dateFin, $optionTri, $stage, $alternance, $codePostal, $datePublication, $BUT2, $BUT3);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    public static function getFilteredOffers(): void
    {
        $dateDebut = null;
        $dateFin = null;
        $optionTri = null;
        $stage = null;
        $alternance = null;
        $codePostal = null;
        $datePublication = null;
        $BUT2 = null;
        $BUT3 = null;
        if (isset($_GET['dateDebut'])) {
            $dateDebut = $_GET['dateDebut'];
        }
        if (isset($_GET['dateFin'])) {
            $dateFin = $_GET['dateFin'];
        }
        if (isset($_GET['optionTri'])) {
            $optionTri = $_GET['optionTri'];
        }
        if (isset($_GET['stage'])) {
            $stage = $_GET['stage'];
        }
        if (isset($_GET['alternance'])) {
            $alternance = $_GET['alternance'];
        }
        if (isset($_GET['codePostal'])) {
            $codePostal = $_GET['codePostal'];
        }
        if (isset($_GET['datePublication'])) {
            $datePublication = $_GET['datePublication'];
        }
        if (isset($_GET['BUT2'])) {
            $BUT2 = $_GET['BUT2'];
        }
        if (isset($_GET['BUT3'])) {
            $BUT3 = $_GET['BUT3'];
        }
        if (isset($_GET['keywords'])) {
            $keywords = urldecode($_GET['keywords']);
        } else {
            $keywords = null;
        }

        $listeExpPro = (new ExperienceProfessionnelRepository())->search(
            $keywords,
            $dateDebut,
            $dateFin,
            $optionTri,
            $stage,
            $alternance,
            $codePostal,
            $datePublication,
            $BUT2,
            $BUT3
        );


        if (empty($listeExpPro)) {
            require __DIR__ . "/../View/offer/noOfferFound.php";
        } else {
            for ($i = 0; $i < count($listeExpPro); $i++) {
                $expPro = $listeExpPro[$i];
                require __DIR__ . "/../View/offer/smallOffer.php";
            }
        }
    }


    public static function modifierDepuisFormulaire(): void {

        if(!isset($_POST["id"])){
            self::redirectionVersURL("warning", "Aucune offre selectionnée", "home");
            return;
        }
        if(!isset($_POST["typeOffre"])){
            self::redirectionVersURL("warning", "Aucun type d'offre fourni", "home");
            return;
        }

        $tab = [];
        if(isset($_POST["sujet"])){
            $tab["sujetExperienceProfessionnel"] = $_POST["sujet"];
        }
        if(isset($_POST["thematique"])){
            $tab["thematiqueExperienceProfessionnel"] = $_POST["thematique"];
        }
        if(isset($_POST["taches"])){
            $tab["tachesExperienceProfessionnel"] = $_POST["taches"];
        }
        if(isset($_POST["niveau"])){
            $tab["niveauExperienceProfessionnel"] = $_POST["niveau"];
        }
        if(isset($_POST["codePostal"])){
            $tab["codePostalExperienceProfessionnel"] = $_POST["codePostal"];
        }
        if(isset($_POST["adressePostale"])){
            $tab["adresseExperienceProfessionnel"] = $_POST["adressePostale"];
        }
        if(isset($_POST["dateDebut"])){
            $tab["dateDebutExperienceProfessionnel"] = $_POST["dateDebut"];
        }
        if(isset($_POST["dateFin"])){
            $tab["dateFinExperienceProfessionnel"] = $_POST["dateFin"];
        }

        // Si c'est un stage
        if ($_POST["typeOffre"] == "stage") {
            if(isset($_POST["gratification"])){
                $tab["gratificationStage"] = $_POST["gratification"];
            }
            $stage = (new StageRepository())->getById($_POST["id"]);
            if( !self::utilisateurPeutModifier($stage) ){
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
                return;
            }
            (new ServiceStage())->mettreAJour($stage, $tab);
        } // Si c'est une alternance
        elseif ($_POST["typeOffre"] == "alternance") {
            $alternance = (new AlternanceRepository())->getById($_POST["id"]);
            if( !self::utilisateurPeutModifier($alternance) ){
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
                return;
            }
            (new ServiceAlternance())->mettreAJour($alternance, $tab);
        } // Si c'est une offre non défini
        elseif ($_POST["typeOffre"] == "offreNonDefini") {
            $offreNonDefini = (new OffreNonDefiniRepository())->getById($_POST["id"]);
            if( !self::utilisateurPeutModifier($offreNonDefini) ){
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
                return;
            }
            (new ServiceOffreNonDefini())->mettreAJour($offreNonDefini, $tab);
        } // Si ce n'est aucun des 3 alors ce n'est pas normal
        else {
            self::redirectionVersURL("danger", "Le type d'offre fourni n'existe pas", "home");
            return;
        }

        self::redirectionVersURL("success", "Offre modifié avec succès", "home");
    }

    private static function utilisateurPeutModifier(ExperienceProfessionnel $experienceProfessionnel) {
        return ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $experienceProfessionnel->getSiret();
    }

    public static function afficherVueEndOffer($msg): void
    {
        ControllerGenerique::afficheVue("view.php", [
            "pagetitle" => "Gestion d'offre",
            "cheminVueBody" => "offer/endOffer.php",
            "message" => $msg
        ]);
    }

    public static function afficherFormulaireModification(): void
    {
        $idExpPro = $_GET["experiencePro"];
        $pagetitle = "Modification d'offre";
        $cheminVueBody = 'offer/editOffer.php';

        $rep = new StageRepository();
        $stage = $rep->getById($idExpPro);
        // Si c'est un stage alors c'est good
        if (!is_null($stage)) {
            if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $stage->getSiret()) {
                ControllerGenerique::afficheVue('view.php', [
                    "pagetitle" => $pagetitle,
                    "cheminVueBody" => $cheminVueBody,
                    "experiencePro" => $stage
                ]);
            } else {
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
            }
        } // On vérifie que c'est une alternance sinon on affiche un message d'erreur
        else {
            // On vérifie que c'est une alternance
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $alternance->getSiret()) {
                    ControllerGenerique::afficheVue('view.php', [
                        "pagetitle" => $pagetitle,
                        "cheminVueBody" => $cheminVueBody,
                        "experiencePro" => $alternance
                    ]);
                } else {
                    self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
                }
            } else {
                $rep = new OffreNonDefiniRepository();
                $offreNonDefini = $rep->getById($idExpPro);
                if (!is_null($offreNonDefini)) {
                    if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $offreNonDefini->getSiret()) {
                        ControllerGenerique::afficheVue('view.php', [
                            "pagetitle" => $pagetitle,
                            "cheminVueBody" => $cheminVueBody,
                            "experiencePro" => $offreNonDefini
                        ]);
                    } else {
                        self::redirectionVersURL("danger", "Vous n'avez pas les droits pour modifier cette offre", "home");
                    }
                } else {
                    $messageErreur = 'Cette offre n existe pas !';
                    ControllerGenerique::error($messageErreur);
                }
            }
        }
    }

    public static function afficherOffre(): void
    {
        $idExpPro = $_GET["experiencePro"];

        $rep = new StageRepository();
        $stage = $rep->getById($idExpPro);

        if (!is_null($stage)) {
            if (!ConnexionUtilisateur::getLoginUtilisateurConnecte() == $stage->getSiret() && ConnexionUtilisateur::estEntreprise()) {
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
            }else{
                ControllerGenerique::afficheVue('view.php', [
                "pagetitle" => "Stage",
                "cheminVueBody" => "offer/offer.php",
                "expPro" => $stage
            ]);
            }
        } else {
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro);
            if (!is_null($alternance)) {
                if (!ConnexionUtilisateur::getLoginUtilisateurConnecte() == $alternance->getSiret() && ConnexionUtilisateur::estEntreprise()) {
                    self::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
                }else {
                    ControllerGenerique::afficheVue('view.php', [
                        "pagetitle" => "Alternance",
                        "cheminVueBody" => "offer/offer.php",
                        "expPro" => $alternance
                    ]);
                }
            } else {
                $rep = new OffreNonDefiniRepository();
                $offreNonDefini = $rep->getById($idExpPro);
                if (!is_null($offreNonDefini)) {
                    if (!ConnexionUtilisateur::getLoginUtilisateurConnecte() == $offreNonDefini->getSiret() && ConnexionUtilisateur::estEntreprise()) {
                        self::redirectionVersURL("danger", "Vous n'avez pas les droits pour afficher cette offre", "home");
                    }else {
                        ControllerGenerique::afficheVue('view.php', [
                            "pagetitle" => "Offre non définie",
                            "cheminVueBody" => "offer/offer.php",
                            "expPro" => $offreNonDefini
                        ]);
                    }
                } else {
                    $messageErreur = 'Cette offre n existe pas !';
                    ControllerGenerique::error($messageErreur);
                }
            }
        }
    }

    public static function creerOffreDepuisFormulaire(): void
    {
        if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::estEntreprise()) {
            $msg = "Offre crée avec succés !";
            if (ConnexionUtilisateur::estConnecte()) {
                $siret = ConnexionUtilisateur::getLoginUtilisateurConnecte();
            } else {
                $siret = $_POST["siret"];
            }
            $tabInfo = [
                "sujetExperienceProfessionnel" => $_POST["sujet"],
                "thematiqueExperienceProfessionnel" => $_POST["thematique"],
                "tachesExperienceProfessionnel" => $_POST["taches"],
                "niveauExperienceProfessionnel" => $_POST["niveau"],
                "codePostalExperienceProfessionnel" => $_POST["codePostal"],
                "adresseExperienceProfessionnel" => $_POST["adressePostale"],
                "dateDebutExperienceProfessionnel" => $_POST["dateDebut"],
                "dateFinExperienceProfessionnel" => $_POST["dateFin"],
                "siret" => $siret];
            if ($_POST["typeOffre"] == "stage") {
                $rep = new StageRepository();
                $tabInfo["gratificationStage"] = $_POST["gratification"];
                self::saveExpByFormulairePost($rep, $msg, $tabInfo);

            } else if ($_POST["typeOffre"] == "alternance") {
                $rep = new AlternanceRepository();
                self::saveExpByFormulairePost($rep, $msg, $tabInfo); // Redirection vers une page
            } else if ($_POST["typeOffre"] == "offreNonDefini") {
                $rep = new OffreNonDefiniRepository();
                self::saveExpByFormulairePost($rep, $msg, $tabInfo); // Redirection vers une page
            } else {
                ControllerGenerique::error("Ce type d'offre n'existe pas");
            }
        } else {
            self::redirectionVersURL("danger", "Vous n'êtes pas habilité à créer une offre", "home");
        }
    }

    public static function supprimerOffre(): void
    {
        $idExpPro = $_GET["experiencePro"];
        $rep = new StageRepository();
        $stage = $rep->getById($idExpPro);
        // Si c'est un stage alors c'est good
        if (!is_null($stage)) {
            if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $stage->getSiret()) {
                $rep->supprimer($idExpPro);
                self::afficherVueEndOffer("Stage supprimée avec succès");
            } else {
                self::redirectionVersURL("danger", "Vous n'avez pas les droits pour supprimer cette offre", "home");
            }
        } else {
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $alternance->getSiret()) {
                    $rep->supprimer($idExpPro);
                    self::afficherVueEndOffer("Alternance supprimée avec succès");
                } else {
                    self::redirectionVersURL("danger", "Vous n'avez pas les droits pour supprimer cette offre", "home");
                }
            } else {
                $rep = new OffreNonDefiniRepository();
                $nonDefini = $rep->getById($idExpPro);
                if (!is_null($nonDefini)) {
                    if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte() == $nonDefini->getSiret()) {
                        $rep->supprimer($idExpPro);
                        self::afficherVueEndOffer("Offre non défini supprimée avec succès");
                    } else {
                        self::redirectionVersURL("danger", "Vous n'avez pas les droits pour supprimer cette offre", "home");
                    }
                } else {
                    $messageErreur = 'Cette offre n existe pas !';
                    ControllerGenerique::error($messageErreur);
                }
            }
        }
    }

    public static function createOffer(): void
    {
        if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::estEntreprise()) {
            ControllerGenerique::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Créer une offre',
                    'cheminVueBody' => 'offer/createOffer.php',
                ]
            );
        } else {
            self::redirectionVersURL("danger", "Vous n'êtes pas habilité à créer une offre", "home");
        }
    }

    public static function displayOffer(): void
    {
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Offre',
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }

    /**
     * @param AlternanceRepository $rep
     * @param string $msg
     * @return void
     */
    public static function saveExpByFormulairePost(AbstractExperienceProfessionnelRepository $rep, string $msg, array $tab): void
    {
        $exp = $rep->construireDepuisTableau($tab);
        if ($rep->save($exp)) {
            self::afficherVueEndOffer($msg);
        } else {
            self::error("L'offre n'a pas pu être créeé");
        }
    }
}


