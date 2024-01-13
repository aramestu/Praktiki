<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Enseignant;
/**
 * Repository pour la gestion des enseignants.
 */
class EnseignantRepository extends AbstractRepository
{
    /**
     * Construit un objet Enseignant à partir d'un tableau de données formaté.
     *
     * @param array $enseignantFormatTableau Le tableau de données de l'enseignant.
     * @return Enseignant L'objet Enseignant créé.
     */
    public function construireDepuisTableau(array $enseignantFormatTableau): Enseignant
    {
        return new Enseignant($enseignantFormatTableau["mailEnseignant"], $enseignantFormatTableau["nomEnseignant"], $enseignantFormatTableau["prenomEnseignant"],$enseignantFormatTableau["estAdmin"]);
    }

    /**
     * Récupère un enseignant par son adresse e-mail.
     *
     * @param string $valeurEmail L'adresse e-mail de l'enseignant à récupérer.
     * @return Enseignant|null L'objet Enseignant ou null s'il n'existe pas.
     */
    public function getByEmail(string $valeurEmail): ?Enseignant{
        $sql = "SELECT * from Enseignants WHERE mailEnseignant = :EmailTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "EmailTag" => ConnexionUtilisateur::getLoginUtilisateurConnecte(),
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();

        if(!$objetFormatTableau){
            return null;
        }
        else{
            return (new EnseignantRepository())->construireDepuisTableau($objetFormatTableau);
        }
    }

    /**
     * Vérifie si un enseignant a le rôle d'administrateur.
     *
     * @param string $mail L'adresse e-mail de l'enseignant à vérifier.
     * @return bool True si l'enseignant est administrateur, sinon false.
     */
    public function estAdmin(string $mail): bool
    {
        $sql="SELECT estAdmin FROM Enseignants WHERE mailEnseignant=:Tag";
        $pdoStatement=Model::getPdo()->prepare($sql);
        $array=array(
            "Tag"=>$mail
        );
        $pdoStatement->execute($array);
        foreach ($pdoStatement as $item) {
            if ($item["estAdmin"]=="1"){
                return true;
            }
        }
        return false;
    }

    /**
     * Retourne le nom de la table des enseignants.
     *
     * @return string Le nom de la table des enseignants.
     */
    protected function getNomTable(): string
    {
        return "Enseignants";
    }

    /**
     * Retourne le nom de la clé primaire de la table des enseignants.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "mailEnseignant";
    }

    /**
     * Retourne les noms des colonnes de la table des enseignants.
     *
     * @return array Les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array("mailEnseignant", "nomEnseignant", "prenomEnseignant", "estAdmin");
    }
}
