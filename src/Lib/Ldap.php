<?php

namespace App\SAE\Lib;

/**
 * Classe Ldap gérant les interactions avec un serveur LDAP.
 */
class Ldap {

    /**
     * @var string La clé API pour l'authentification LDAP.
     */
    static private string $ldapApiKey = "LdapAPIPassword";

    /**
     * @var string L'adresse du serveur LDAP.
     */
    static private string $adresseServeur = "https://webinfo.iutmontp.univ-montp2.fr/~francoisn/LDAP_API.php";

    /**
     * Génère la requête http qui sera envoyé au serveur
     *
     * @param string $fonction La fonction LDAP à exécuter.
     * @param string $login Le login de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @param string $homeDirectory Le répertoire personnel de l'utilisateur.
     * @return array Les options de la requête HTTP.
     */
    static private function getHTTPRequest(string $fonction, string $login, string $password="", string $homeDirectory=""): array
    {
        return array('http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query([
                'API_Key' => self::$ldapApiKey,
                'fonction' => $fonction,
                'login' => $login,
                'password' => $password,
                'homeDirectory' => $homeDirectory
            ])
        ]);
    }

    /**
     * Établit une connexion LDAP en utilisant le login et le mot de passe fournis.
     *
     * @param string $login Le login de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @return UserInformation|false Les informations de l'utilisateur en cas de succès, false sinon.
     */
    static public function connection(string $login, string $password): UserInformation | false {
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("bind", $login, $password)));
        if ($reponse == "error") {
            return false;
        }
        if ($reponse) {
            $infosUser = self::getInfos($login);
            return new UserInformation(
                $infosUser["gecos"][0],
                $infosUser["givenname"][0],
                $infosUser["sn"][0],
                $infosUser["mail"][0],
                explode('/', $infosUser["homedirectory"][0])[2]
            );
        }
        return false;
    }

    /**
     * Emule une connexion LDAP pour les membres du personnel en utilisant le login fourni.
     *
     * @param string $login Le login de l'utilisateur.
     * @return UserInformation|false Les informations de l'utilisateur en cas de succès, false sinon.
     */
    static public function connectionBrutForcePersonnel(string $login): UserInformation | false {
        $infosUser = self::getInfos($login, "/home/personnel");
        if (!$infosUser) {
            return false;
        } else {
            return new UserInformation(
                $infosUser["gecos"][0],
                $infosUser["givenname"][0],
                $infosUser["sn"][0],
                $infosUser["mail"][0],
                explode('/', $infosUser["homedirectory"][0])[2]
            );
        }
    }

    /**
     * Obtient les informations de l'utilisateur à partir du serveur LDAP.
     *
     * @param string $login Le login de l'utilisateur.
     * @param string $homeDirectory Le répertoire personnel de l'utilisateur.
     * @return false|array Les informations de l'utilisateur en cas de succès, false sinon.
     */
    private static function getInfos(string $login, string $homeDirectory=""): false|array {
        $reponse = file_get_contents(self::$adresseServeur, false, stream_context_create(self::getHTTPRequest("getInfos", $login, "", $homeDirectory)));
        if ($reponse == "error" || !$reponse) {
            return false;
        }
        return json_decode($reponse, true);
    }
}

/**
 * Classe UserInformation représentant les informations d'un utilisateur LDAP.
 */
class UserInformation {

    /**
     * @var string Le login de l'utilisateur.
     */
    private string $login;

    /**
     * @var string Le nom de l'utilisateur.
     */
    private string $name;

    /**
     * @var string Le prénom de l'utilisateur.
     */
    private string $surname;

    /**
     * @var string L'adresse email de l'utilisateur.
     */
    private string $mail;

    /**
     * @var string Le répertoire personnel de l'utilisateur.
     */
    private string $homeDirectory;

    /**
     * Constructeur de la classe UserInformation.
     *
     * @param string $login Le login de l'utilisateur.
     * @param string $name Le nom de l'utilisateur.
     * @param string $surname Le prénom de l'utilisateur.
     * @param string $mail L'adresse email de l'utilisateur.
     * @param string $homeDirectory Le répertoire personnel de l'utilisateur.
     */
    public function __construct(string $login, string $name, string $surname, string $mail, string $homeDirectory) {
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->mail = $mail;
        $this->homeDirectory = $homeDirectory;
    }

    /**
     * Obtient le login de l'utilisateur.
     *
     * @return string Le login de l'utilisateur.
     */
    public function getLogin(): string {
        return $this->login;
    }

    /**
     * Obtient le nom de l'utilisateur.
     *
     * @return string Le nom de l'utilisateur.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Obtient le prénom de l'utilisateur.
     *
     * @return string Le prénom de l'utilisateur.
     */
    public function getSurname(): string {
        return $this->surname;
    }

    /**
     * Obtient l'adresse email de l'utilisateur.
     *
     * @return string L'adresse email de l'utilisateur.
     */
    public function getMail(): string {
        return $this->mail;
    }

    /**
     * Obtient le répertoire personnel de l'utilisateur.
     *
     * @return string Le répertoire personnel de l'utilisateur.
     */
    public function getHomeDirectory(): string {
        return $this->homeDirectory;
    }
}
