<?php

namespace App\SAE\Controller;

use App\SAE\Lib\MessageFlash;
use JetBrains\PhpStorm\NoReturn;

/**
 * Classe abstraite représentant un contrôleur générique avec des méthodes utilitaires.
 */
abstract class ControllerGenerique
{
    /**
     * Affiche une vue avec les paramètres spécifiés.
     *
     * @param string $cheminVue Le chemin vers la vue.
     * @param array $parametres Les paramètres à passer à la vue.
     * @return void
     */
    protected static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . '/../View/' . $cheminVue;
    }

    /**
     * Affiche la page d'accueil.
     *
     * @return void
     */
    public static function home(): void
    {
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Accueil',
                'cheminVueBody' => 'SAE/home.php',
            ]
        );
    }

    /**
     * Affiche une page d'erreur avec le message spécifié.
     *
     * @param string $messageErreur Le message d'erreur à afficher.
     * @return void
     */
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

    /**
     * Affiche la zone de test.
     *
     * @return void
     */
    public static function zoneDetest(): void{
        self::afficheVue('view.php', ['pagetitle' => 'Zone de test', 'cheminVueBody' => 'SAE/zoneDeTest.php']);
    }


    /**
     * Effectue une redirection vers une URL spécifiée avec un message flash.
     *
     * @param string $type Le type du message flash (success, danger, warning, etc.).
     * @param string $message Le message flash à afficher.
     * @param string $url L'URL de la redirection.
     * @return void
     *
     * @throws NoReturn
     */
    #[NoReturn] public static function redirectionVersURL(string $type, string $message, string $url): void
    {
        MessageFlash::ajouter($type,$message);
        header("Location: frontController.php?action=$url");
        exit();
    }
}