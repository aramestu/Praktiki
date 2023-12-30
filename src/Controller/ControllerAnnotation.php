<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\Annotation;
use App\SAE\Model\Repository\AnnotationRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Service\ServiceAnnotation;

class ControllerAnnotation extends ControllerGenerique
{
    // http://localhost/S3/PHP/sae_web_s1/web/frontController.php?controller=Annotation&action=afficherFormulaireAnnotation
    public static function afficherFormulaireAnnotation() : void {
        //$siret = $_POST["siret"];
        $siret = "01234567890123";
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Annoter',
                'cheminVueBody' => 'user/annotation/creerAnnotation.php',
                'siret' => $siret
            ]
        );
    }

    public static function enregistrerAnnotation(): void
    {
        $message = $_POST["message"];
        $siret = $_POST["siret"];

        // Pour récupérer le mail du prof
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        //$mail = "antoine.lefevre@umontpellier.fr";
        $user = (new EnseignantRepository())->getById($mail);

        if(strlen($message) > 500){
            self::redirectionVersURL("warning", "Le contenu est trop long", "afficherAllAnnotationEntreprise&controller=Annotation");
        }
        else if (!is_null($user)) {
            $annotation = new Annotation($siret, $mail, $message, false);
            $save = (new AnnotationRepository())->save($annotation);
            // Si l'insertion n'a pas fonctionné
            if(! $save){
                self::redirectionVersURL("warning", "L'annotation n'a pas pu être enregistré", "afficherAllAnnotationEntreprise&controller=Annotation");
            }
            else{ // Si ça a fonctionné
                self::redirectionVersURL("success", "Annotation crée avec succés", "afficherAllAnnotationEntreprise&controller=Annotation");
            }
        }
        else{
            self::error('Vous n avez pas la permission');
        }
    }

    public static function afficherAllAnnotationEntreprise() : void {
        $login = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        // Si personne n'est connecté
        if(is_null($login)){
            self::error("Vous n'avez pas la permission pour faire ça");
        }
        // Si l'utilisateur connecté est un prof
        else if(ConnexionUtilisateur::estEnseignant()) {
            //$siret = $_POST["siret"];
            $siret = "01234567890123";
            $listAnnotationEtPersonne = (new AnnotationRepository())->getAnnotationEtPersonneBySiret($siret);

            $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();

            $entreprise = (new EntrepriseRepository())->getById($siret);

            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Annoter',
                    'cheminVueBody' => 'user/annotation/annotationList.php',
                    'listAnnotationPersonne' => $listAnnotationEtPersonne,
                    'entreprise' => $entreprise
                ]
            );
        }
        else{
            self::error("Vous n'avez pas la permission pour faire ça");
        }
    }

    public static function afficherFormulaireModificationAnnotation(): void
    {
        $id = $_GET["idAnnotation"];
        $annotation = (new AnnotationRepository())->getById($id);

        if(is_null($annotation)){
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation");
        }
        else if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
            self::afficheVue(
                'view.php',
                [
                    'pagetitle' => 'Modifier message',
                    'cheminVueBody' => 'user/annotation/modifierAnnotation.php',
                    'annotation' => $annotation
                ]
            );
        }
        else{
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }

    public static function modifierAnnotation(): void
    {
        if(!isset($_POST["idAnnotation"])){
            self::redirectionVersURL("warning", "Aucune idAnnotation fourni", "afficherAllAnnotationEntreprise&controller=Annotation");
            return;
        }
        $id = $_POST["idAnnotation"];
        $annotation = (new AnnotationRepository())->getById($id);
        $attributs["contenu"] = $_POST["message"];

        if(is_null($annotation)){
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation");
        }
        else if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
            (new ServiceAnnotation())->mettreAJour($annotation, $attributs);
            self::redirectionVersURL("success", "Annotation a été modifié avec succés", "afficherAllAnnotationEntreprise&controller=Annotation");
        }
        else{
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }

    public static function supprimerAnnotation() : void {
        $id = $_GET["idAnnotation"];
        $rep = new AnnotationRepository();
        $annotation = $rep->getById($id);
        if(is_null($annotation)){
            self::redirectionVersURL("warning", "L'annotation n'existe pas", "afficherAllAnnotationEntreprise&controller=Annotation");
        }
        // Si l'utilisateur connecté est le même que celui qui a posté le message ou qu'il est admin
        else if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant() || ConnexionUtilisateur::estAdministrateur()) {
            $rep->supprimer($id);
            self::redirectionVersURL("success", "Annotation supprimé avec succès", "afficherAllAnnotationEntreprise&controller=Annotation");
            //self::afficherAllAnnotationEntreprise();
        }
        else{
            self::error("Vous n'avez pas la permission de faire ça !");
        }
    }
}