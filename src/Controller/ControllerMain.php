<?php

namespace App\SAE\Controller;

use App\SAE\Model\ModelSAE;

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
                        'cheminVueBody' => 'SAE/offer.php',
                    ]
                );
    }

    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . '/../View/' . $cheminVue;
    }
}

?>
