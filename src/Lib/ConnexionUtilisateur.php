<?php

namespace App\SAE\Lib;

use App\SAE\Model\HTTP\Session;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;

/**
 * Classe ConnexionUtilisateur gérant les fonctionnalités de connexion, déconnexion et vérification du statut utilisateur.
 */
class ConnexionUtilisateur {

    /**
     * @var string La clé associée à l'utilisateur connecté en session.
     */
    private static string $cleConnexion = "_utilisateurConnecte";

    /**
     * Connecte un utilisateur en enregistrant son login en session.
     *
     * @param string $loginUtilisateur Le login de l'utilisateur à connecter.
     */
    public static function connecter(string $loginUtilisateur): void
    {
        $session = Session::getInstance();
        $session->enregistrer(self::$cleConnexion, $loginUtilisateur);
    }

    /**
     * Vérifie si un utilisateur est connecté.
     *
     * @return bool True si un utilisateur est connecté, false sinon.
     */
    public static function estConnecte(): bool
    {
        $session = Session::getInstance();
        return $session->contient(self::$cleConnexion);
    }

    /**
     * Déconnecte l'utilisateur en supprimant son login de la session.
     */
    public static function deconnecter(): void
    {
        $session = Session::getInstance();
        $session->supprimer(self::$cleConnexion);
    }

    /**
     * Obtient le login de l'utilisateur connecté.
     *
     * @return string|null Le login de l'utilisateur connecté, ou null s'il n'est pas connecté.
     */
    public static function getLoginUtilisateurConnecte(): ?string
    {
        if (self::estConnecte()) {
            $session = Session::getInstance();
            return $session->lire(self::$cleConnexion);
        }
        return null;
    }

    /**
     * Vérifie si l'utilisateur connecté est celui spécifié.
     *
     * @param string $login Le login à vérifier.
     * @return bool True si l'utilisateur connecté correspond au login spécifié, false sinon.
     */
    public static function estUtilisateur(string $login): bool
    {
        return (self::getLoginUtilisateurConnecte() == $login);
    }

    /**
     * Vérifie si l'utilisateur connecté est un étudiant.
     *
     * @return bool True si l'utilisateur connecté est un étudiant, false sinon.
     */
    public static function estEtudiant(): bool
    {
        if (self::estConnecte())
            return (bool)(new EtudiantRepository())->getByEmail(self::getLoginUtilisateurConnecte());
        return false;
    }

    /**
     * Vérifie si l'utilisateur connecté est une entreprise.
     *
     * @return bool True si l'utilisateur connecté est une entreprise, false sinon.
     */
    public static function estEntreprise(): bool
    {
        if (self::estConnecte())
            return (bool)(new EntrepriseRepository())->getEntrepriseAvecEtatFiltree(null, self::getLoginUtilisateurConnecte());
        return false;
    }

    /**
     * Vérifie si l'utilisateur connecté est un enseignant.
     *
     * @return bool True si l'utilisateur connecté est un enseignant, false sinon.
     */
    public static function estEnseignant(): bool
    {
        if (self::estConnecte())
            return (bool)(new EnseignantRepository())->getByEmail(self::getLoginUtilisateurConnecte());
        return false;
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     *
     * @return bool True si l'utilisateur connecté est un administrateur, false sinon.
     */
    public static function estAdministrateur(): bool
    {
        if (self::estEnseignant()) {
            return (new EnseignantRepository())->estAdmin(self::getLoginUtilisateurConnecte());
        } else {
            return false;
        }
    }
}
