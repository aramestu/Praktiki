<?php

namespace App\SAE\Model\Repository;

use App\SAE\Controller\ControllerGenerique;
use App\SAE\Model\DataObject\AbstractDataObject;
use PDOException;

/**
 * Classe abstraite représentant un repository générique pour les objets de données.
 */

abstract class AbstractRepository {

    /**
     * Récupère tous les objets de la table associée.
     *
     * @return array Tableau d'objets de données.
     */
    public function getAll(): array {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $requestStatement =  $pdo->query("SELECT * FROM $nomTable");

        $objects = [];
        foreach ($requestStatement as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    /**
     * Compte le nombre total d'objets dans la table associée.
     *
     * @return int Nombre total d'objets.
     */
    public function count(): int {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $requestStatement =  $pdo->query("SELECT COUNT(*) FROM $nomTable");
        $nb = $requestStatement->fetch();
        return $nb[0];
    }

    /**
     * Récupère un objet par son identifiant primaire.
     *
     * @param string $valeurClePrimaire La valeur de la clé primaire.
     * @return AbstractDataObject|null L'objet associé ou null s'il n'existe pas.
     */
    public function getById(string $valeurClePrimaire): ?AbstractDataObject{
        $nomTable = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $sql = "SELECT * from $nomTable WHERE $clePrimaire = :clePrimaireTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "clePrimaireTag" => $valeurClePrimaire,
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
            return $this->construireDepuisTableau($objetFormatTableau);
        }
    }

    /**
     * Supprime un objet par son identifiant primaire et archive l'objet avant suppression.
     *
     * @param string $valeurClePrimaire La valeur de la clé primaire.
     * @return void
     */
    public function supprimer(string $valeurClePrimaire): void
    {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $this->archiver($valeurClePrimaire);
        $requeteStatement = $pdo->prepare("DELETE FROM $nomTable
                                                 WHERE $clePrimaire = :clePrimaireTag");
        $values = array("clePrimaireTag" => $valeurClePrimaire);
        $requeteStatement->execute($values);
    }

    /**
     * Met à jour un objet dans la base de données.
     *
     * @param AbstractDataObject $object L'objet à mettre à jour.
     * @return void
     */
    public function mettreAJour(AbstractDataObject $object): void{
        $pdo = Model::getPdo();
        $table = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $colonnes = $this->getNomsColonnes();
        $sql = "UPDATE $table SET ";
        for($i =0; $i<sizeof($colonnes); $i++){
            if($colonnes[$i]!=$clePrimaire){
                $sql = $sql . $colonnes[$i] ." = :" . $colonnes[$i] . "Tag";
                if($i!=sizeof($colonnes)-1){
                    $sql = $sql . ", ";
                }
            }
        }
        $sql = $sql . " WHERE $clePrimaire = :" . $clePrimaire . "Tag";
        $requeteStatement = $pdo->prepare($sql);
        $requeteStatement->execute($object->formatTableau());
    }

    /**
     * Sauvegarde un nouvel objet dans la base de données.
     *
     * @param AbstractDataObject $object L'objet à sauvegarder.
     * @return bool True si la sauvegarde est réussie, sinon false.
     */
    public function save(AbstractDataObject $object) : bool {
        try {
            $pdo = Model::getPdo();
            $table = $this->getNomTable();
            $colonnes = $this->getNomsColonnes();
            $sql = "INSERT INTO $table VALUES (";
            for($i =0; $i<sizeof($colonnes); $i++){
                $sql = $sql . ":" . $colonnes[$i] . "Tag";
                if($i!=sizeof($colonnes)-1){
                    $sql = $sql . ", ";
                }else{
                    $sql = $sql . ")";
                }
            }
            $requeteStatement = $pdo->prepare($sql);
            $requeteStatement->execute($object->formatTableau());
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Archive un objet en le déplaçant vers une table d'archives.
     *
     * @param string $valeurClePrimaire La valeur de la clé primaire.
     * @return void
     */
    public function archiver(string $valeurClePrimaire) : void{
        $pdo = Model::getPdo();
        $table = $this->getNomTable();
        $tableArchives = $table . "Archives";
        $clePrimaire = $this->getNomClePrimaire();
        $sql = "INSERT INTO $tableArchives SELECT * FROM $table WHERE $table.$clePrimaire = :clePrimaireTag";
        $values = array("clePrimaireTag" => $valeurClePrimaire);
        $requeteStatement = $pdo->prepare($sql);
        $requeteStatement->execute($values);
    }

    /**
     * Recherche des objets basés sur des mots-clés, colonnes spécifiques et options de tri.
     *
     * @param string|null $keywords Les mots-clés à rechercher.
     * @param array|null $colonnes Les colonnes sur lesquelles effectuer la recherche.
     * @param string|null $colonneTrie La colonne selon laquelle trier les résultats.
     * @param bool|null $ordre True pour un tri décroissant, false pour un tri croissant.
     * @return array Tableau d'objets de données résultants de la recherche.
     */
    public function searchs(string $keywords = null, array $colonnes = null ,string $colonneTrie = null, bool $ordre = null): array
    {
        $sql = "SELECT * 
                FROM " . $this->getNomTable() . " ";

        $values = array();
        // S'il y a un mot clé alors je "filtre" par le mot clé sur les colonnes données
        if(! is_null($keywords)){
            $sql = $sql . " WHERE " . $this->colonneToSearch($colonnes) . " ";
            $values = array(
                "keywordsTag" => '%' . $keywords . '%'
            );
        }
        // Si aucune colonne de trie n'a été renseigné alors on ne trie pas
        // Sinon je trie
        if(! is_null($colonneTrie)){
            $sql = $sql . " ORDER BY $colonneTrie ";

            // Si c'est true alors on trie par décroissant sinon croissant (de base)
            if($ordre === true){
                $sql = $sql . " DESC ";
            }
        }

        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute($values);

        $tab = [];
        foreach ($requestStatement as $result){
            $tab[] = $this->construireDepuisTableau($result);
        }
        return $tab;
    }


    /**
     * Construit la partie WHERE d'une requête SQL de recherche avec LIKE.
     *
     * @param array|null $colonnes Les colonnes sur lesquelles effectuer la recherche.
     * @return string La partie WHERE construite.
     */
    protected function colonneToSearch(array $colonnes = null) :string {
        $chaine = " (";
        if(is_null($colonnes)){
            $colonnes = array();
        }
        $nbColonnes = sizeof($colonnes);

        // Si c'est vide alors je fais sur toutes les colonnes
        if($nbColonnes == 0){
            $colonnes = $this->getNomsColonnes();
            $nbColonnes = sizeof($colonnes);
        }

        for($i = 0; $i < $nbColonnes; $i++){
            // SI ce n'est pas le premier alors je met un OR.
            if($i != 0){
                $chaine = $chaine . "OR ";
            }

            $chaine = $chaine . "$colonnes[$i] LIKE :keywordsTag ";
        }
        return $chaine . ") ";
    }

    /**
     * Méthode abstraite pour obtenir le nom de la table associée.
     *
     * @return string Nom de la table.
     */
    protected abstract function getNomTable() : string;

    /**
     * Méthode abstraite pour construire un objet de données depuis un tableau formaté.
     *
     * @param array $objetFormatTableau Le tableau formaté représentant l'objet.
     * @return AbstractDataObject L'objet de données construit.
     */
    public abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;

    /**
     * Méthode abstraite pour obtenir le nom de la clé primaire de la table.
     *
     * @return string Nom de la clé primaire.
     */
    protected abstract function getNomClePrimaire():string;

    /**
     * Méthode abstraite pour obtenir les noms des colonnes de la table.
     *
     * @return array Noms des colonnes.
     */
    protected abstract function getNomsColonnes(): array;
}