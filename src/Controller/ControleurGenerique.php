<?php
namespace App\SAE\Controller;

abstract class ControleurGenerique{

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
}