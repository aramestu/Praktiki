<?php

namespace App\SAE\Lib;

use Exception;

/**
 * Classe MotDePasse gérant le hachage et la vérification des mots de passe.
 */
class MotDePasse
{

    /**
     * @var string Le poivre utilisé pour renforcer le hachage des mots de passe.
     */
    private static string $poivre = "6pbFwtXjgJe4hq8XXi859L";

    /**
     * Hache le mot de passe clair en utilisant le poivre.
     *
     * @param string $mdpClair Le mot de passe en clair.
     * @return string Le mot de passe haché.
     */
    public static function hacher(string $mdpClair): string
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, MotDePasse::$poivre);
        return password_hash($mdpPoivre, PASSWORD_DEFAULT);
    }

    /**
     * Vérifie si le mot de passe clair correspond au mot de passe haché.
     *
     * @param string $mdpClair Le mot de passe en clair.
     * @param string $mdpHache Le mot de passe haché à vérifier.
     * @return bool True si le mot de passe clair correspond au mot de passe haché, false sinon.
     */
    public static function verifier(string $mdpClair, string $mdpHache): bool
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, MotDePasse::$poivre);
        return password_verify($mdpPoivre, $mdpHache);
    }

    /**
     * Génère une chaîne aléatoire pour être utilisée comme poivre.
     *
     * @param int $nbCaracteres Le nombre de caractères de la chaîne générée.
     * @return string La chaîne aléatoire générée.
     * @throws Exception
     */
    public static function genererChaineAleatoire(int $nbCaracteres = 22): string
    {
        // 22 caractères par défaut pour avoir au moins 128 bits aléatoires
        // 1 caractère = 6 bits car 64=2^6 caractères en base_64
        // et 128 <= 22*6 = 132
        $octetsAleatoires = random_bytes(ceil($nbCaracteres * 6 / 8));
        return substr(base64_encode($octetsAleatoires), 0, $nbCaracteres);
    }
}

// Pour créer votre poivre (une seule fois)
