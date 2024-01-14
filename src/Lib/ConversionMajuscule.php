<?php

namespace App\SAE\Lib;

/**
 * Classe ConversionMajuscule gérant la conversion des caractères d'une chaîne en majuscules avec prise en compte des accents.
 */
class ConversionMajuscule {

    /**
     * Convertit une chaîne en majuscules en prenant en compte les carractères accentués.
     *
     * @param string $string La chaîne à convertir.
     * @return string La chaîne convertie en majuscules avec gestion des accentuation.
     */
    public static function convertirEnMajuscules(string $string): string
    {
        // Tableau de conversion des caractères avec accents
        $conversion = array(
            'à' => 'À', 'â' => 'Â', 'ä' => 'Ä', 'á' => 'Á', 'å' => 'Å',
            'ç' => 'Ç'
        );

        // Conversion en majuscules
        $string = mb_strtoupper($string, 'UTF-8');

        // Remplacement des caractères avec accents
        return strtr($string, $conversion);
    }
}
