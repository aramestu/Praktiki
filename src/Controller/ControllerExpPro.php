<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\OffreNonDefiniRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\Stage;

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

    public static function getNbExpProTotal(): int
    {
        $listExpPro = AbstractExperienceProfessionnelRepository::rechercheAllOffreFiltree("");
        return count($listExpPro);
    }

    public static function getNbStageTotal(): int
    {
        $listExpPro = AbstractExperienceProfessionnelRepository::rechercheAllOffreFiltree("", null, null, null, "stage");
        $listExpPro = array_filter($listExpPro, function ($expPro) {
            return !($expPro instanceof \App\SAE\Model\DataObject\OffreNonDefini);
        });
        return count($listExpPro);
    }

    public static function getNbAlternanceTotal(): int
    {
        $listExpPro = AbstractExperienceProfessionnelRepository::rechercheAllOffreFiltree("", null, null, null, "alternance");
        $listExpPro = array_filter($listExpPro, function ($expPro) {
            return !($expPro instanceof \App\SAE\Model\DataObject\OffreNonDefini);
        });
        return count($listExpPro);
    }

    public static function getNbOffreNonDefiniTotal(): int
    {
        $listExpPro = AbstractExperienceProfessionnelRepository::rechercheAllOffreFiltree("", null, null, null, "offreNonDefini");
        return count($listExpPro);
    }


    public static function getExpProRecent(): void{
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, null, null, null,null,
                                                        null,null,"lastWeek",null,null);;
        extract($listeExpPro);
        require __DIR__ ."/../View/offer/offerTable.php";
    }

    public static function getExpProEntreprise(): void
    {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        extract($listeExpPro);
        require __DIR__ ."/../View/offer/offerTable.php";
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
        if (isset($_GET['BUT2'])){
            $BUT2 = $_GET['BUT2'];
        }
        if (isset($_GET['BUT3'])){
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
        if (isset($_GET['BUT2'])){
            $BUT2 = $_GET['BUT2'];
        }
        if (isset($_GET['BUT3'])){
            $BUT3 = $_GET['BUT3'];
        }
        if(isset($_GET['keywords'])){
            $keywords = urldecode($_GET['keywords']);
        }
        else{
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


        if(empty($listeExpPro)){
            require __DIR__ ."/../View/offer/noOfferFound.php";
        }else{
            for($i=0;$i<count($listeExpPro);$i++){
                $expPro = $listeExpPro[$i];
                require __DIR__ ."/../View/offer/smallOffer.php";
            }
        }
    }


    public static function modifierDepuisFormulaire(): void
    {
        $msg = "Offre modifiée avec succés !";
        $tab = [
            "sujetExperienceProfessionnel" => $_POST["sujet"],
            "thematiqueExperienceProfessionnel" => $_POST["thematique"],
            "tachesExperienceProfessionnel" => $_POST["taches"],
            "niveauExperienceProfessionnel" => $_POST["niveau"],
            "codePostalExperienceProfessionnel" => $_POST["codePostal"],
            "adresseExperienceProfessionnel" => $_POST["adressePostale"],
            "dateDebutExperienceProfessionnel" => $_POST["dateDebut"],
            "dateFinExperienceProfessionnel" => $_POST["dateFin"],
            "siret" => $_POST["siret"]
        ];
        // Si c'est un stage
        if ($_POST["typeOffre"] == "stage") {
            $tab["gratificationStage"] = $_POST["gratification"]; // Un stage a une gratification à renseigner en plus
            $tab["idStage"] = $_POST["id"];
            $rep = new StageRepository();
            $stage = $rep->construireDepuisTableau($tab);
            $rep->mettreAJour($stage);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        } // Si c'est une alternance
        elseif ($_POST["typeOffre"] == "alternance") {
            $tab["idAlternance"] = $_POST["id"];
            $rep = new AlternanceRepository();
            $alternance = $rep->construireDepuisTableau($tab);
            $rep->mettreAJour($alternance);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        } // Si c'est une offre non défini
        elseif ($_POST["typeOffre"] == "offreNonDefini") {
            $tab["idOffreNonDefini"] = $_POST["id"];
            $rep = new OffreNonDefiniRepository();
            $stalternance = $rep->construireDepuisTableau($tab);
            $rep->mettreAJour($stalternance);
            self::afficherVueEndOffer($msg); // Redirection vers une page
        } // Si ce n'est aucun des 3 alors ce n'est pas normal
        else {
            ControllerGenerique::error("Ce type d'offre n'existe pas");
        }
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
            ControllerGenerique::afficheVue('view.php', [
                "pagetitle" => $pagetitle,
                "cheminVueBody" => $cheminVueBody,
                "experiencePro" => $stage
            ]);
        } // On vérifie que c'est une alternance sinon on affiche un message d'erreur
        else {
            // On vérifie que c'est une alternance
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                ControllerGenerique::afficheVue('view.php', [
                    "pagetitle" => $pagetitle,
                    "cheminVueBody" => $cheminVueBody,
                    "experiencePro" => $alternance
                ]);
            } else {
                $rep = new OffreNonDefiniRepository();
                $offreNonDefini = $rep->getById($idExpPro);
                if (!is_null($offreNonDefini)) {
                    ControllerGenerique::afficheVue('view.php', [
                        "pagetitle" => $pagetitle,
                        "cheminVueBody" => $cheminVueBody,
                        "experiencePro" => $offreNonDefini
                    ]);
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
            ControllerGenerique::afficheVue('view.php', [
                "pagetitle" => "Stage",
                "cheminVueBody" => "offer/offer.php",
                "expPro" => $stage
            ]);
        } else {
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro);
            if (!is_null($alternance)) {
                ControllerGenerique::afficheVue('view.php', [
                    "pagetitle" => "Alternance",
                    "cheminVueBody" => "offer/offer.php",
                    "expPro" => $alternance
                ]);
            } else {
                $rep = new OffreNonDefiniRepository();
                $offreNonDefini = $rep->getById($idExpPro);
                if (!is_null($offreNonDefini)) {
                    ControllerGenerique::afficheVue('view.php', [
                        "pagetitle" => "Offre non définie",
                        "cheminVueBody" => "offer/offer.php",
                        "expPro" => $offreNonDefini
                    ]);
                } else {
                    $messageErreur = 'Cette offre n existe pas !';
                    ControllerGenerique::error($messageErreur);
                }
            }
        }
    }

    public static function creerOffreDepuisFormulaire(): void
    {
        $msg = "Offre crée avec succés !";
        if(ConnexionUtilisateur::estConnecte()){
            $siret=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        }
        else{
            $siret= $_POST["siret"];
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
    }

    public static function supprimerOffre(): void
    {
        $idExpPro = $_GET["experiencePro"];
        $rep = new StageRepository();
        $stage = $rep->getById($idExpPro);

        // Si c'est un stage alors c'est good
        if (!is_null($stage)) {
            $rep->supprimer($idExpPro);
            self::afficherVueEndOffer("Stage supprimée avec succès");
        } else {
            $rep = new AlternanceRepository();
            $alternance = $rep->getById($idExpPro); //Dans un else pour éviter de faire 2 requêtes s'il n'y a pas besoin
            if (!is_null($alternance)) {
                $rep->supprimer($idExpPro);
                self::afficherVueEndOffer("Alternance supprimée avec succès");
            } else {
                $rep = new OffreNonDefiniRepository();
                $nonDefini = $rep->getById($idExpPro);
                if (!is_null($nonDefini)) {
                    $rep->supprimer($idExpPro);
                    self::afficherVueEndOffer("Offre non défini supprimée avec succès");
                } else {
                    $messageErreur = 'Cette offre n existe pas !';
                    ControllerGenerique::error($messageErreur);
                }
            }
        }
    }

    public static function createOffer(): void
    {
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Créer une offre',
                'cheminVueBody' => 'offer/createOffer.php',
            ]
        );
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
        if($rep->save($exp)){
            self::afficherVueEndOffer($msg);
        }
        else{
            self::error("L'offre n'a pas pu être créeé");
        }
    }
}


