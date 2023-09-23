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

    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . '/../View/' . $cheminVue;
    }
}

?>
