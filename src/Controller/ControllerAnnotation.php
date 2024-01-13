<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\Annotation;
use App\SAE\Model\Repository\AnnotationRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Service\ServiceAnnotation;

/**
 * Contrôleur gérant les actions liées aux annotations dans l'application.
 */
class ControllerAnnotation extends ControllerGenerique
{
    /**
     * Affiche le formulaire d'annotation.
     */
    public static function afficherFormulaireAnnotation(): void
    {
        $siret = $_GET["siret"];
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Annoter',
                'cheminVueBody' => 'user/annotation/creerAnnotation.php',
                'siret' => $siret
            ]
        );
    }

    /**
     * Enregistre une nouvelle annotation.
     */
    public static function enregistrerAnnotation(): void
    {
        $message = $_POST["message"];
        $siret = $_POST["siret"];

        // Pour récupérer le mail du prof
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        //$mail = "antoine.lefevre@umontpellier.fr";
        $user = (new EnseignantRepository())->getById($mail);

        if (strlen($message) > 500) {
            self::redirectionVersURL("warning", "Le contenu est trop long", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        } elseif (!is_null($user)) {
            $annotation = new Annotation($siret, $mail, $message, false);
            $save = (new AnnotationRepository())->save($annotation);
            // Si l'insertion n'a pas fonctionné
            if (!$save) {
                self::redirectionVersURL("warning", "L'annotation n'a pas pu être enregistrée", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
            } else { // Si ça a fonctionné
                self::redirectionVersURL("success", "Annotation créée avec succès", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
            }
        } else {
            self::error('Vous n\'avez pas la permission');
        }
    }

    /**
     * Affiche toutes les annotations pour une entreprise donnée.
     */
    public static function afficherAllAnnotationEntreprise(): void
    {
        $login = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        // Si personne n'est connecté
        if (is_null($login)) {
            self::error("Vous n'avez pas la permission pour faire ça");
        }
        // Si l'utilisateur connecté est un prof
        elseif (ConnexionUtilisateur::estEnseignant()) {
            $siret = $_GET["siret"];
            $listAnnotationEtPersonne = (new AnnotationRepository())->getAnnotationEtPersonneBySiret($siret);

            $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();

            $entreprise = (new EntrepriseRepository())->getById($siret);

            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Annoter',
                    'cheminVueBody' => 'user/annotation/annotationList.php',
                    'listAnnotationPersonne' => $listAnnotationEtPersonne,
                    'entreprise' => $entreprise,
                    'siret' => $siret
                ]
            );
        } else {
            self::error("Vous n'avez pas la permission pour faire ça");
        }
    }

    /**
     * Affiche le formulaire de modification d'une annotation.
     */
    public static function afficherFormulaireModificationAnnotation(): void
    {
        $id = $_GET["idAnnotation"];
        $siret = $_GET["siret"];
        $annotation = (new AnnotationRepository())->getById($id);

        if (is_null($annotation)) {
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        } elseif (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Modifier message',
                    'cheminVueBody' => 'user/annotation/modifierAnnotation.php',
                    'annotation' => $annotation,
                    'siret' => $siret
                ]
            );
        } else {
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }

    /**
     * Modifie le contenu d'une annotation.
     */
    public static function modifierAnnotation(): void
    {
        $siret = $_POST['siret'];
        if (!isset($_POST["idAnnotation"])) {
            self::redirectionVersURL("warning", "Aucun idAnnotation fourni", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
            return;
        }
        $id = $_POST["idAnnotation"];
        $annotation = (new AnnotationRepository())->getById($id);
        $attributs["contenu"] = $_POST["message"];

        if (is_null($annotation)) {
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        } elseif (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
            (new ServiceAnnotation())->mettreAJour($annotation, $attributs);
            self::redirectionVersURL("success", "Annotation a été modifiée avec succès", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        } else {
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }

    /**
     * Supprime une annotation.
     */
    public static function supprimerAnnotation(): void
    {
        $siret = $_GET["siret"];
        $id = $_GET["idAnnotation"];
        $rep = new AnnotationRepository();
        $annotation = $rep->getById($id);
        if (is_null($annotation)) {
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        }
        // Si l'utilisateur connecté est le même que celui qui a posté le message ou qu'il est admin
        elseif (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant() || ConnexionUtilisateur::estAdministrateur()) {
            $rep->supprimer($id);
            self::redirectionVersURL("success", "Annotation supprimée avec succès", "afficherAllAnnotationEntreprise&controller=Annotation&siret=".$siret);
        } else {
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }
}
