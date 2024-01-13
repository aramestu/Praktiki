<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Personnel;
/**
 * Repository pour la gestion des personnels.
 */
class PersonnelRepository extends AbstractRepository
{
    /**
     * Construit un objet Personnel à partir d'un tableau de données formaté.
     *
     * @param array $personnelFormatTableau Le tableau de données du ppersonnel.
     * @return Personnel L'objet Personnel créé.
     */
    public function construireDepuisTableau(array $personnelFormatTableau): Personnel
    {
        return new Personnel($personnelFormatTableau["mailPersonnel"], $personnelFormatTableau["nomPersonnel"], $personnelFormatTableau["prenomPersonnel"]);
    }

    /**
     * Récupère un personnel par son adresse e-mail.
     *
     * @param string $valeurEmail L'adresse e-mail du ppersonnel à récupérer.
     * @return Personnel|null L'objet Personnel ou null s'il n'existe pas.
     */
    public function getByEmail(string $valeurEmail): ?Personnel{
        $sql = "SELECT * from Personnels WHERE mailPersonnel = :EmailTag";
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
            return (new PersonnelRepository())->construireDepuisTableau($objetFormatTableau);
        }
    }

    /**
     * Retourne le nom de la table des personnels.
     *
     * @return string Le nom de la table des personnels.
     */
    protected function getNomTable(): string
    {
        return "Personnels";
    }

    /**
     * Retourne le nom de la clé primaire de la table des personnels.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "mailPersonnel";
    }

    /**
     * Retourne les noms des colonnes de la table des personnels.
     *
     * @return array Les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array("mailPersonnel", "nomPersonnel", "prenomPersonnel");
    }
}
