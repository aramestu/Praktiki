<?php

namespace App\SAE\Model\HTTP;

/**
 * Classe utilitaire pour la gestion des cookies HTTP.
 *
 * @package App\SAE\Model\HTTP
 */
class Cookie
{
    /**
     * Enregistre un cookie avec une clé, une valeur, et éventuellement une durée d'expiration.
     *
     * @param string $cle La clé du cookie.
     * @param mixed $valeur La valeur à enregistrer.
     * @param int|null $dureeExpiration La durée d'expiration en secondes (optionnelle).
     */
    public static function enregistrer(string $cle, $valeur, ?int $dureeExpiration = null): void
    {
        if (!is_null($dureeExpiration)) {
            setcookie($cle, serialize($valeur), time() + $dureeExpiration, "/");
        } else {
            setcookie($cle, serialize($valeur), null, "/");
        }
    }

    /**
     * Lit la valeur d'un cookie enregistré avec la clé spécifiée.
     *
     * @param string $cle La clé du cookie à lire.
     * @return mixed|null La valeur du cookie, ou null si le cookie n'existe pas.
     */
    public static function lire(string $cle)
    {
        if (isset($_COOKIE[$cle])) {
            return unserialize($_COOKIE[$cle]);
        } else {
            return null;
        }
    }

    /**
     * Vérifie si un cookie avec la clé spécifiée existe.
     *
     * @param string $cle La clé du cookie à vérifier.
     * @return bool True si le cookie existe, sinon false.
     */
    public static function contient($cle): bool
    {
        return isset($_COOKIE[$cle]);
    }

    /**
     * Supprime un cookie avec la clé spécifiée.
     *
     * @param string $cle La clé du cookie à supprimer.
     */
    public static function supprimer($cle): void
    {
        unset($_COOKIE[$cle]);
        setcookie($cle, "", time() - 3600, "/");
    }
}
