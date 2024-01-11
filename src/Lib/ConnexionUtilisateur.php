<?php

namespace App\SAE\Lib;

use App\SAE\Model\HTTP\Session;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\PersonnelRepository;

class ConnexionUtilisateur {
    // L'Utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        $session = Session::getInstance();
        $session->enregistrer(self::$cleConnexion, $loginUtilisateur);
    }

    public static function estConnecte(): bool
    {
        // À compléter
        $session = Session::getInstance();
        return $session->contient(self::$cleConnexion);
    }

    public static function deconnecter(): void
    {
        // À compléter
        $session = Session::getInstance();
        $session->supprimer(self::$cleConnexion);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        if (self::estConnecte()) {
            $session = Session::getInstance();
            return $session->lire(self::$cleConnexion);
        }
        return null;
    }

    public static function estUtilisateur($login): bool
    {
        return (self::getLoginUtilisateurConnecte() == $login);
    }

    public static function estEtudiant(): bool
    {
        if (self::estConnecte())
            return (bool)(new EtudiantRepository())->getByEmail(self::getLoginUtilisateurConnecte());
        return false;
    }

    public static function estEntreprise(): bool
    {
        if (self::estConnecte())
            return (bool)(new EntrepriseRepository())->getEntrepriseAvecEtatFiltree(null, self::getLoginUtilisateurConnecte());
        return false;
    }

    public static function estPersonnel(): bool
    {
        if (self::estConnecte())
            return (bool)(new PersonnelRepository())->getByEmail(self::getLoginUtilisateurConnecte());
        return false;
    }

    public static function estEnseignant(): bool
    {
        if (self::estConnecte())
            return (bool)(new EnseignantRepository())->getByEmail(self::getLoginUtilisateurConnecte());
        return false;
    }

    public static function estAdministrateur(): bool
    {
        if (self::estEnseignant()) {
            return (new EnseignantRepository())->estAdmin(self::getLoginUtilisateurConnecte());
        } else {
            return false;
        }
    }


}