<?php

namespace App\SAE\Lib;

class ConversionMajuscule {
    public static function convertirEnMajuscules($string) {
        $conversion = array(
            'à' => 'À', 'â' => 'Â', 'ä' => 'Ä', 'á' => 'Á', 'å' => 'Å',
            'ç' => 'Ç'
        );

        $string = mb_strtoupper($string, 'UTF-8');
        $string = strtr($string, $conversion);

        return $string;
    }
}