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

    public static function zoneDetest(): void{
        self::afficheVue('view.php', ['pagetitle' => 'Zone de test', 'cheminVueBody' => 'SAE/zoneDeTest.php']);
    }


    public static function redirectionVersURL(string $type,string $message,string $url): void
    {
        MessageFlash::ajouter($type,$message);
        header("Location: frontController.php?action=$url");
        exit();
    }
}