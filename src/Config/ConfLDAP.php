<?php

namespace App\SAE\Config;

use Exception;
use LDAP\Connection;

class ConfLDAP
{

    /**
     * @var array|string[] configuration des parametres pour se connecter au serveur LDAP de l'IUT
     */
    static private array $ldapConfig = array(
        'ldap_host' => '10.10.1.30',
        'ldap_basedn' => "dc=info,dc=iutmontp,dc=univ-montp2,dc=fr",
        'ldap_port' => '389',
        'ldap_conn' => 'false'
    );

    static public function getHost()
    {
        return self::$ldapConfig['ldap_host'];
    }

    static public function getBasedn()
    {
        return self::$ldapConfig['ldap_basedn'];
    }

    static public function getPort()
    {
        return self::$ldapConfig['ldap_port'];
    }

    static public function getConnection()
    {
        return self::$ldapConfig['ldap_conn'];
    }

    /**
     * Effectue le lien de connexion sur le serveur LDAP de l'iut
     *
     * @deprecated fonction fournit par l'IUT, retravaillé par Norman {@see Ldap}
     * @return Connection
     * @throws Exception si la connexion est un échec
     */
    static public function connect(): Connection
    {
        $ldap_conn = ldap_connect(self::getHost(), self::getPort());
        if ($ldap_conn) {
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            self::$ldapConfig['ldap_conn'] = $ldap_conn;
            return $ldap_conn;
        } else {
            throw new Exception('LDAP connexion');
        }
    }
}
