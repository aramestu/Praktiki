<?php

namespace App\SAE\Lib;

use LDAP\Connection;

class Ldap
{
    static private string $ldapApiKey = "LdapAPIPassword";
    static private array $userInformations;
    static private string $adresseServeur = "https://webinfo.iutmontp.univ-montp2.fr/~francoisn/LDAP_API.php";

    static private function getHTTPRequest($fonction, $login, $password){
        return array('http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query(['API_Key' => self::$ldapApiKey,
                'fonction' => $fonction,
                'login' => $login,
                'password' => $password])
        ]);
    }

    static public function connection($login, $password): ?bool{
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("bind", $login, $password)));
        if ($reponse == "error") {
            return null;
        }
        if($reponse == true){
            self::$userInformations = self::getInfos($login, $password);
        }
        return (bool)$reponse;
    }

    static public function getUserMail(): string{
        return self::$userInformations["mail"][0];
    }

    static public function getUserLogin(): string{
        return self::$userInformations["gecos"][0];
    }

    static public function getUserName(): string{
        return self::$userInformations["givenname"][0];
    }

    static public function getUserSurname(): string{
        return self::$userInformations["sn"][0];
    }

    static public function getUserAnnee():string{
        return explode('/',self::$userInformations["homedirectory"][0])[2];
    }

    private static function getInfos($login, $password): ?array{
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("getInfos", $login, $password)));
        if ($reponse == "error") {
            return null;
        }
        return json_decode($reponse, true);
    }
}