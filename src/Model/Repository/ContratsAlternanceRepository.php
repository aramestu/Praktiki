<?php

namespace App\SAE\Model\Repository;

use App\SAE\Controller\ControllerGenerique;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ContratsAlternance;

class ContratsAlternanceRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "ContratsAlternances";
    }

    public function construireDepuisTableau(array $objetFormatTableau): AbstractDataObject
    {
        return new ContratsAlternance($objetFormatTableau["numEtudiant"], $objetFormatTableau["idAnneeUniversitaire"]);
    }

    protected function getNomClePrimaire(): string
    {
        return "numEtudiant, idAnneeUniversitaire";
    }

    protected function getNomsColonnes(): array
    {
        return ["numEtudiant", "idAnneeUniversitaire"];
    }

    /**
     * Retourne toujours null car ne peut pas être executé pour cette table
     * @param string $valeurClePrimaire
     * @return AbstractDataObject|null
     */
    public function getById(string $valeurClePrimaire): ?AbstractDataObject
    {
        return null;
    }

    public function getByIds(string $numEtudiant, int $idAnneeUniversitaire): ?AbstractDataObject
    {
        $nomTable = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $sql = "SELECT * from ContratsAlternances WHERE numEtudiant = :numEtudiantTag 
                                    AND idAnneeUniversitaire = :idAnneeUniversitaireTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "numEtudiantTag" => $numEtudiant,
            "idAnneeUniversitaireTag" => $idAnneeUniversitaire
        );

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
}