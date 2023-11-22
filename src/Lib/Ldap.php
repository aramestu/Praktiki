<?php

namespace App\SAE\Lib;

class Ldap {
    static private string $ldapApiKey = "LdapAPIPassword";
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

    static public function connection($login, $password): UserInformation | bool{
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("bind", $login, $password)));
        if ($reponse == "error") {
            return false;
        }
        if($reponse == true){
            $infosUser = self::getInfos($login, $password);
            return new UserInformation(
                $infosUser["gecos"][0],
                $infosUser["givenname"][0],
                $infosUser["sn"][0],
                $infosUser["mail"][0]
            );
        }
        return false;
    }

    private static function getInfos($login, $password): ?array{
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("getInfos", $login, $password)));
        if ($reponse == "error") {
            return null;
        }
        return json_decode($reponse, true);
    }
}

class UserInformation {

    private string $login;
    private string $name;
    private string $surname;
    private string $mail;

    public function __construct(string $login, string $name, string $surname, string $mail){
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->mail = $mail;
    }

    public function getLogin(): string{
        return $this->login;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getSurname(): string{
        return $this->surname;
    }

    public function getMail(): string{
        return $this->mail;
    }

}