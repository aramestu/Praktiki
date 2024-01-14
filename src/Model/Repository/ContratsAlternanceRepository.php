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

    /**
     * Retourne vrai si l'étudiant a une alternance pour une année universitaire. Faux sinon
     * @param string $numEtu
     * @param int $idAnneeUniversitaire
     * @return bool
     */
    public function etudiantPossedeAlternance(string $numEtu, int $idAnneeUniversitaire): bool{
        $sql = "SELECT COUNT(*) FROM ContratsAlternances WHERE numEtudiant= :numEtuTag AND idAnneeUniversitaire= :idAnneeTag";

        $values = [
            "numEtuTag" => $numEtu,
            "idAnneeTag" => $idAnneeUniversitaire
        ];

        $request = Model::getPdo()->prepare($sql);
        $request->execute($values);

        $result = $request->fetchColumn();
        return $result == 1;
    }

    /**
     * Retoune vrai si l'étudiant a une alternance pour l'année universitaire actuelle. Faux sinon
     * @param string $numEtu
     * @return bool
     */
    public function etudiantPossedeActuellementAlternance(string $numEtu) : bool{
        $id = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire()->getIdAnneeUniversitaire();
        return $this->etudiantPossedeAlternance($numEtu, $id);
    }


    /**
     * Retourne la liste des étudiants avec une convention validée.
     *
     * @return array La liste des étudiants avec une convention validée.
     */
    public function getEtudiantAvecConventionValidee(): array
    {
        return $this->getEtudiantConventionValide(true,true);
    }
}