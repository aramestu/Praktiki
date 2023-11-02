<?php

namespace App\SAE\Lib;

use LDAP\Connection;

class Ldap
{
    static private string $ldapApiKey = "LdapAPIPassword";

    static private string $adresseServeur = "https://webinfo.iutmontp.univ-montp2.fr/~francoisn/LDAP_API.php";

    static private function getHTTPRequest($fonction, $login, $password)
    {
        return array('http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query(['API_Key' => self::$ldapApiKey,
                'fonction' => $fonction,
                'login' => $login,
                'password' => $password])
        ]);
    }

    static public function bind($login, $password): ?bool
    {
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("bind", $login, $password)));
        if ($reponse == "error") {
            return null;
        }
        return (bool)$reponse;
    }

    static public function getInfos($login, $password): ?array
    {
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("getInfos", $login, $password)));
        if ($reponse == "error") {
            return null;
        }
        return json_decode($reponse, true);
    }
}