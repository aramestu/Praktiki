<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Enseignant;

class EnseignantRepository extends AbstractRepository
{

    public function construireDepuisTableau(array $enseignantFormatTableau): Enseignant
    {
        $enseignant = new Enseignant($enseignantFormatTableau["mailEnseignant"], $enseignantFormatTableau["nomEnseignant"], $enseignantFormatTableau["prenomEnseignant"],$enseignantFormatTableau["estAdmin"]);
        return $enseignant;
    }

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

    protected function getNomTable(): string
    {
        return "Enseignants";
    }

    protected function getNomClePrimaire(): string
    {
        return "mailEnseignant";
    }

    protected function getNomsColonnes(): array
    {
        return array("mailEnseignant", "nomEnseignant", "prenomEnseignant", "estAdmin");
    }
}
