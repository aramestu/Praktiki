<?php

namespace App\SAE\Model\Repository;

use App\SAE\Config\Conf;
use PDO;

class Model
{
    private static ?Model $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        // Configuration de la première base de données
        $dbConfig1 = Conf::getDatabaseConfiguration(0);

        // Configuration de la deuxième base de données
        $dbConfig2 = Conf::getDatabaseConfiguration(1);

        $timeout = 2; // Définir un timeout en secondes (2 secondes dans cet exemple)

        try {
            // Tentative de connexion à la première base de données avec timeout
            $this->pdo = new PDO(
                "mysql:host={$dbConfig1['hostname']};port={$dbConfig1['port']};dbname={$dbConfig1['database']}",
                $dbConfig1['login'],
                $dbConfig1['password'],
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_TIMEOUT => $timeout
                )
            );
        } catch (PDOException $e) {
            die('Impossible de se connecter à la base de données 00.');
            // En cas d'échec, basculez sur la deuxième base de données sans attendre
            try{
                $this->pdo = new PDO(
                            "mysql:host={$dbConfig2['hostname']};port={$dbConfig2['port']};dbname={$dbConfig2['database']}",
                            $dbConfig2['login'],
                            $dbConfig2['password'],
                            array(
                                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                                PDO::ATTR_TIMEOUT => $timeout
                            )
                        );
            }
            catch (PDOException $e) {
                die('Impossible de se connecter à la base de données 01.');
            }
        }

        // Activez le mode d'affichage des erreurs et le lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
?>