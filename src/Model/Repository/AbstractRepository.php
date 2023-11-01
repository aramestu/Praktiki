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

    protected abstract function getNomTable() : string;
    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;
    protected abstract function getNomClePrimaire():string;
    protected abstract function getNomsColonnes(): array;
}