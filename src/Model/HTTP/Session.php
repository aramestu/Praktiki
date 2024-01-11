<?php

namespace App\SAE\Model\HTTP;

use App\SAE\Config\Conf;
use Exception;

/**
 * Classe utilitaire pour la gestion des sessions PHP.
 *
 * @package App\SAE\Model\HTTP
 */
class Session
{
    /**
     * Instance unique de la classe Session.
     *
     * @var Session|null
     */
    private static ?Session $instance = null;

    /**
     * Constructeur privé pour empêcher l'instanciation directe de la classe.
     *
     * @throws Exception En cas d'échec du démarrage de la session.
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("La session n'a pas réussi à démarrer.");
        }
    }

    /**
     * Obtient l'instance unique de la classe Session.
     *
     * @return Session L'instance de la classe Session.
     */
    public static function getInstance(): Session
    {
        if (is_null(Session::$instance))
            Session::$instance = new Session();
        self::verifierDerniereActivite();
        return Session::$instance;
    }

    /**
     * Vérifie si la session contient une variable avec le nom spécifié.
     *
     * @param mixed $name Le nom de la variable à vérifier.
     * @return bool True si la variable existe, sinon false.
     */
    public function contient($name): bool
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Enregistre une variable dans la session.
     *
     * @param string $name Le nom de la variable.
     * @param mixed $value La valeur de la variable.
     */
    public function enregistrer(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Lit la valeur d'une variable dans la session.
     *
     * @param string $name Le nom de la variable à lire.
     * @return mixed La valeur de la variable.
     */
    public function lire(string $name)
    {
        return $_SESSION[$name];
    }

    /**
     * Supprime une variable de la session.
     *
     * @param mixed $name Le nom de la variable à supprimer.
     */
    public function supprimer($name): void
    {
        unset($_SESSION[$name]);
    }

    /**
     * Détruit la session en cours.
     */
    public function detruire(): void
    {
        session_unset();
        session_destroy();
        Cookie::supprimer(session_name());
        // Il faudra reconstruire la session au prochain appel de getInstance()
        $instance = null;
    }

    /**
     * Vérifie la dernière activité de la session et déconnecte l'utilisateur si nécessaire.
     */
    public static function verifierDerniereActivite(): void
    {
        if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > Conf::getDelai())) {
            //$test=time() - $_SESSION['derniereActivite'];
            $bool = false;
            if (isset($_SESSION["_entrepriseConnecte"])) $bool = true;
            session_unset(); // unset $_SESSION variable for the run-time
        }
        $_SESSION['derniereActivite'] = time(); // update last activity time stamp
    }
}
