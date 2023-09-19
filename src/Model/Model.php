<?php

namespace App\SAE\Model;

use App\SAE\Config\Conf;

use PDO;

class Model
{
    private static ?Model $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        try {
            $hostname = Conf::getHostname();
            $databaseName = Conf::getDatabase();
            $login = Conf::getLogin();
            $password = Conf::getPassword();
            $port = Conf::getPort();
            // Connexion à la base de données
            // Le dernier argument sert à ce que toutes les chaînes de caractères
            // en entrée et sortie de MySQL soient dans le codage UTF-8
            $this->pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$databaseName", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // On active le mode d'affichage des erreurs et le lancement d'exception en cas d'erreur
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            die('Erreur connexion base de données');
        }
    }

    public static function getPdo(): PDO
    {
        return self::getInstance()->pdo;
    }

    private static function getInstance(): Model
    {
        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }
}
