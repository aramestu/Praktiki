<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AnneeUniversitaire;

class AnneeUniversitaireRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "AnneeUniversitaire";
    }

    public function save(AnneeUniversitaire $a): bool
    {
        try {
            if ($this->get($a->getNomAnneeUniversitaire()) == null) {
                $pdo = Model::getPdo();
                $sql = "INSERT INTO AnneeUniversitaire (nomAnneeUniversitaire) VALUES (:nomAnneeUniversitaireTag)";
                $requestStatement = $pdo->prepare($sql);
                $values = array("nomAnneeUniversitaireTag" => $a->getNomAnneeUniversitaire());
                $requestStatement->execute($values);
                return true;
            }
            return false; // Le nom de l'année existe déjà, pas d'insertion nécessaire
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function get(string $nom): ?AnneeUniversitaire{
        $pdo = Model::getPdo();
        $sql= "SELECT count(*) FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" =>$nom);
        $requestStatement->execute($values);
        $AnneeUniversitaire = $requestStatement->fetchColumn();
        if($AnneeUniversitaire==0){
            return null;
        }
        return $this->construireDepuisTableau($this->getDepuisTableau($nom));
    }


    protected function construireDepuisTableau(array $AnneeUniversitaireFormatTableau): AnneeUniversitaire
    {
        $AnneeUniversitaire = new AnneeUniversitaire($AnneeUniversitaireFormatTableau["idAnneeUniversitaire"],
            $AnneeUniversitaireFormatTableau["nomAnneeUniversitaire"]);

        return $AnneeUniversitaire;
    }

    private function getDepuisTableau(string $nom)
    {
        $pdo = Model::getPdo();
        $sql = "SELECT * FROM AnneeUniversitaire WHERE nomAnneeUniversitaire = :nomAnnee";
        $requestStatement = $pdo->prepare($sql);
        $values = array("nomAnnee" =>$nom);
        $requestStatement->execute($values);
        $AnneeUniversitaire = $requestStatement->fetch();
        return $AnneeUniversitaire;
    }
}