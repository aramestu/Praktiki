<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Annotation;
use App\SAE\Model\Repository\AnnotationRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;

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
        //$mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $mail = "antoine.lefevre@umontpellier.fr";
        $user = (new EnseignantRepository())->getById($mail);

        $entreprise = (new EntrepriseRepository())->getById($siret);

        if (!is_null($user)) {
            $annotation = new Annotation($siret, $mail, $message, false);
            $save = (new AnnotationRepository())->save($annotation);
            $listAnnotation = (new AnnotationRepository())->getBySiret($siret);
            // Si l'insertion n'a pas fonctionné
            if(! $save){
                self::error("L'annotation n'a pas pu être enregistré");
            }
            else{ // Si ça a fonctionné
                self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Annoter',
                        'cheminVueBody' => 'user/annotation/annotationList.php',
                        'listAnnotation' => $listAnnotation,
                        'enseignant' => $user,
                        'entreprise' => $entreprise
                    ]
                );
            }
        }
        else{
            self::error('Vous n avez pas la permission');
        }
    }

    public static function afficherAllAnnotationEntreprise() : void {
        //$siret = $_POST["siret"];
        $siret = "01234567890123";
        $listAnnotation = (new AnnotationRepository())->getBySiret($siret);

        //$mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $mail = "antoine.lefevre@umontpellier.fr";
        $user = (new EnseignantRepository())->getById($mail);

        $entreprise = (new EntrepriseRepository())->getById($siret);

        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Annoter',
                'cheminVueBody' => 'user/annotation/annotationList.php',
                'listAnnotation' => $listAnnotation,
                'enseignant' => $user,
                'entreprise' => $entreprise
            ]
        );
    }
}