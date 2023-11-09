<?php

namespace App\SAE\Model\Repository;

use App\SAE\Controller\ControllerGenerique;
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

    public function sauvegarder(AbstractDataObject $object): bool
    {
        // on suppose que les attributs sont tous non nuls
        try {
            $sql = "INSERT INTO ".$this->getNomTable()." VALUES (";
            $colonnes = $this->getNomsColonnes();
            foreach ($colonnes as $nomsColonne) {
                if ($nomsColonne!=$this->getNomsColonnes()[0]){
                    $sql.=",";
                }
                $sql.=":".$nomsColonne."Tag";
                $values[$nomsColonne."Tag"]=$object->formatTableau()[$nomsColonne."Tag"];
            }
            $sql.=")";
            $requeteStatement = Model::getPdo()->prepare($sql);
            $requeteStatement->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /*
     * Retourne un string. Utilisé dans la clause
     * WHERE d'une requête SQL de recherche avec un LIKE.
     * notamment pour la fonction search
     * ex: sujetExperienceProfessionnel LIKE :keywordsTag OR ...
    */
    protected function colonneToSearch(array $colonnes = null) :string {
        $chaine = " (";
        $nbColonnes = sizeof($colonnes);

        // Si c'est vide alors je fais sur toutes les colonnes
        if($nbColonnes == 0 || is_null($colonnes)){
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