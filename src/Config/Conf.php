<?php

namespace App\SAE\Config;
use mysqli;

class Conf
{

    static private array $databaseConfiguration = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        //
        // ou webinfo.iutmontp.univ-montp2.fr
        // pour accéder à webinfo depuis l'extérieur
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'francoisn',
        // À l'IUT, le port de MySQL est particulier : 3316
        // Ailleurs, on utilise le port par défaut : 3306
        'port' => '3316',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'francoisn',
        // A l'IUT, c'est le même mdp que PhpMyAdmin
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => 'rairflashi7tiounklex'
    );

    static public function getLogin(): string
    {
        // L'attribut statique $databaseConfiguration
        // s'obtient avec la syntaxe Conf::$databaseConfiguration
        // au lieu de $this->databaseConfiguration pour un attribut non statique
        return self::$databaseConfiguration['login'];
    }

    static public function getHostName(): string
    {
        return self::$databaseConfiguration['hostname'];
    }

    static public function getDataBase(): string
    {
        return self::$databaseConfiguration['database'];
    }

    static public function getPassword(): string
    {
        return self::$databaseConfiguration['password'];
    }

    static public function getPort(): string
    {
        return self::$databaseConfiguration['port'];
    }


    static public function conn(): mysqli
    {
        return mysqli_connect(self::getHostName(), self::getLogin(), self::getPassword(), self::getDataBase());
    }

    /**
     * Effectue une multiplication simple afin de supprimer une $_SESSION au besoin
     * TODO : Exemple de ce que cela donne dans le code, supprimer le param a la fin
     * @param string $exemple un exemple pour param
     * @return float|int le *produit* de la multiplication
     * */
    public static function getDelai(): float|int
    {
        return 30*60;
    }


    /**
     * Renvoie un URL afin de pouvoir envoyer des mails depuis un local host
     *
     * @return string l'*URL* du webinfo de Lorick vergnes
     */
    public static function getAbsoluteURL():string{
        return "https://webinfo.iutmontp.univ-montp2.fr/~vergnesl/SAE/sae_web_s1/web/frontController.php";
    }

}
