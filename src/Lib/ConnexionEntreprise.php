<?php
namespace App\SAE\Lib;

use App\SAE\Model\HTTP\Session;
use App\SAE\Model\Repository\EntrepriseRepository;

class ConnexionEntreprise
{
    // L'Entreprise connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_entrepriseConnecte";

    public static function connecter(string $loginEntreprise): void
    {
        $session=Session::getInstance();
        $session->enregistrer(self::$cleConnexion,$loginEntreprise);
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

    public static function getLoginEntrepriseConnecte(): ?string
    {
        // À compléter
        if (self::estConnecte()){
            $session=Session::getInstance();
            return $session->lire(self::$cleConnexion);
        }
        return null;
    }
    public static function estEntreprise($login): bool{
        return (self::getLoginEntrepriseConnecte()==$login);
    }

}