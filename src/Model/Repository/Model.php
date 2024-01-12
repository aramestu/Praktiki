<?php

namespace App\SAE\Model\Repository;

use App\SAE\Config\Conf;

use Exception;
use PDO;

/**
 * Repository pour la base de données
 */
class Model
{
    /**
     * Instance unique de la classe Model.
     *
     * @var Model|null
     */
    private static ?Model $instance = null;

    /**
     * Objet PDO pour la connexion à la base de données.
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Constructeur privé pour empêcher l'instanciation directe de la classe.
     * @throws Exception
     */
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

    /**
     * Obtient l'objet PDO pour la connexion à la base de données.
     *
     * @return PDO L'objet PDO.
     */
    public static function getPdo(): PDO
    {
        return self::getInstance()->pdo;
    }

    /**
     * Obtient l'instance unique de la classe Model.
     *
     * @return Model L'instance de la classe Model.
     */
    private static function getInstance(): Model
    {
        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }
}
