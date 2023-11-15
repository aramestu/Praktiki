<?php
namespace App\SAE\Lib;

use App\SAE\Model\HTTP\Session;

class ConnexionUtilisateur
{
    // L'Utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        $session=Session::getInstance();
        $session->enregistrer(self::$cleConnexion,$loginUtilisateur);
    }

    public static function estConnecte(): bool
    {
        // À compléter
        $session=Session::getInstance();
        return $session->contient(self::$cleConnexion);
    }

    public static function deconnecter(): void
    {
        // À compléter
        $session=Session::getInstance();
        $session->supprimer(self::$cleConnexion);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        // À compléter
        if (self::estConnecte()){
            $session=Session::getInstance();
            return $session->lire(self::$cleConnexion);
        }
        return null;
    }
    public static function estUtilisateur($login): bool{
        return (self::getLoginUtilisateurConnecte()==$login);
    }

}