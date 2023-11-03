<?php

namespace App\SAE\Controller;

use App\SAE\Config\ConfLDAP;
use Exception;

class ControllerLDAP extends ControllerGenerique
{

    public static function getUser(): void
    {
        //On recherche toutes les entres du LDAP qui sont des personnes
        $search = ldap_search(ConfLDAP::getConnection(), ConfLDAP::getBasedn(), "(objectClass=person)");
        //On recupere toutes les entres de la recherche effectuees auparavant
        $resultats = ldap_get_entries(ConfLDAP::getConnection(), $search);
        //Pour chaque utilisateur, on recupere les informations utiles
        for ($i = 0; $i < count($resultats) - 1; $i++) {
            //On stocke le login, nom/prnom, la classe et la promotion de l’utilisateur courant $nomprenom = explode(" ", $resultats[$i][’displayname’][0]);
            $promotion = explode("=", explode(",", $resultats[$i]['dn'])[1])[1];
        }
    }

    /**
     * @throws Exception
     */
    public static function verify(): void
    {
        ConfLDAP::connect();
        $ldap_login = $_GET['username'];
        $ldap_password = $_GET['password'];
        $ldap_searchfilter = "(uid=$ldap_login)";
        $search = ldap_search(ConfLDAP::getConnection(), ConfLDAP::getBasedn(), $ldap_searchfilter, array());
        $user_result = ldap_get_entries(ConfLDAP::getConnection(), $search);
        // on verifie que l’entree existe bien
        $user_exist = $user_result["count"] == 1;
        // si l’utilisateur existe bien,
        if ($user_exist) {
            $dn = "uid=" . $ldap_login . ",ou=Ann2,ou=Etudiants,ou=People,dc=info,dc=iutmontp,dc=univ-montp2,dc=fr";
            $passwd_ok = ldap_bind(ConfLDAP::getConnection(), $dn, $ldap_password);
            self::afficheVue("view.php", ['pagetitle' => 'connection reussi', 'cheminVueBody' => 'user/connectionReussi.php']);
        } else {
            $messageErreur = "Compte non existant";
            self::afficheVue("view.php", ["pagetitle" => "Erreur Compte non existant", 'messageErreur' => $messageErreur, "cheminVueBody" => "SAE/error.php"]);
        }
    }

    public static function disconnect(): void
    {
        ldap_close(ConfLDAP::getConnection());
    }
}