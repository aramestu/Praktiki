<?php

namespace App\SAE\Controller;

use App\SAE\Lib\MessageFlash;

abstract class ControllerGenerique
{

    protected static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . '/../View/' . $cheminVue;
    }

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

    public static function error(string $messageErreur): void
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

    // nomData ex: Alternance / Stage / TuteurProfessionnel
    protected static function getBySearch(string $nomData, string $keywords): void
    {
        $keywords = urldecode($_GET['keywords']);
        $listeExpPro = $nomRepository::search($keywords);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Recherche',
                'listeExpPro' => $listeExpPro,
                'cheminVueBody' => 'offer/offerList.php',
            ]
        );
    }


    public static function redirectionVersURL(string $type,string $message,string $url): void
    {
        MessageFlash::ajouter($type,$message);
        header("Location: frontController.php?action=$url");
        exit();
    }
}