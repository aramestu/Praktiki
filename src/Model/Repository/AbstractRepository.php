<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;

abstract class AbstractRepository {

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

    public function get(string $valeurClePrimaire): ?AbstractDataObject{
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

    public function supprimer(string $valeurClePrimaire){
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $requeteStatement = $pdo->prepare("DELETE FROM $nomTable
                                                 WHERE $clePrimaire = :clePrimaireTag");
        $values = array("clePrimaireTag" => $valeurClePrimaire);
        $requeteStatement->execute($values);
    }

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

    /*
     * - keyword est le mot clé que l'on recherche
     * - colonnes est un tableau de string où l'on recherche le keyword (optionnel). S'il n'est pas renseigné, alors on fait la recherche sur toutes les colonnes de l'objet associé au repository !
     *      Je spécifie les colonnes pour éviter de faire une recherche sur des mdp ou autres infos
     * - colonneTrie pour savoir par quel colonne on trie le résultat (optionnel)
     * - ordre pour savoir si on trie par ordre croissant (false) ou décroissant (true) (optionnel)
     *
     * Renvoie un tableau d'AbstractObject
     *
     * array( array("Inscriptions" => "numEtudiant") array("Etudiants" => "numEtudiant")) )
     *
     */
    public function search(string $keywords = null, array $colonnes = null, array $jointures = null ,string $colonneTrie = null, bool $ordre = null){
        if(is_null($jointures)){
            $jointures = array();
        }
        if(is_null($colonnes)){
            $colonnes = array();
        }

        $sql = "SELECT * 
                FROM " . $this->getNomTable() . " ";

        // S'il y a 2 valeurs alors on fait un JOIN
        if(sizeof($jointures) == 2){
            //echo $this->jointure($jointures[0],$jointures[1]);
            $sql = $sql . $this->jointures($jointures[0],$jointures[1]);
        }

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

    /* Retourne une chaine de caractère correspondant aux joins SQL. Prérequis : table et colonne existent
    *  qui associe la première valeur du tableau à sa valeur
     * ex: array("Inscriptions" => "numEtudiant") array("Etudiants" => "numEtudiant"))
     * qui fait une jointure entre Inscription et Etudiant sur les colonnes indiqués
     * et Etudiants à numEtudiant
     * SQL : JOIN Inscriptions ON Inscriptions.numEtudiant = Etudiants.numEtudiants
    */
    public function jointures(array $tab1, array $tab2){
        // S'ils n'ont pas la même taille ou qu'ils sont vide, je ne fais pas de jointure
        if(sizeof($tab1) != sizeof($tab2) || sizeof($tab1) == 0){
            return "";
        }
        $chaine = " JOIN ";
        // Je récupère la liste des clés des tableaux
        $cleTab1 = array_keys($tab1);
        $cleTab2 = array_keys($tab2);

        for($i = 0; $i < sizeof($tab1); $i++){
            $table1 = $cleTab1[$i]; // nom de la table de tab1 à l'indice i
            $colonne1 = $tab1[$table1]; // nom de la colonne de tab1 à l'indice i
            $table2 = $cleTab2[$i];
            $colonne2 = $tab2[$table2];

            $chaine = $chaine . $table1 . " ON " . $table1 . "." . $colonne1 . "=" . $table2 . "." . $colonne2 . " ";
        }
        return $chaine;
    }

    /*
     * Retourne un string. Utilisé dans la clause
     * WHERE d'une requête SQL de recherche avec un LIKE.
     * notamment pour la fonction search
     * ex: sujetExperienceProfessionnel LIKE :keywordsTag
    */
    public function colonneToSearch(array $colonnes) :string {
        $chaine = "(";
        $nbColonnes = sizeof($colonnes);

        // Si c'est vide alors je fais sur toutes les colonnes
        if($nbColonnes == 0){
            $colonnes = $this->getNomsColonnes();
            $nbColonnes = sizeof($colonnes);
        }

        for($i = 0; $i < $nbColonnes; $i++){
            // SI ce n'est pas le premier alors je met un OR
            if($i != 0){
                $chaine = $chaine . "OR ";
            }

            $chaine = $chaine . "$colonnes[$i] LIKE :keywordsTag ";
        }
        return $chaine . ") ";
    }

    protected abstract function getNomTable() : string;
    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;
    protected abstract function getNomClePrimaire():string;
    protected abstract function getNomsColonnes(): array;
}