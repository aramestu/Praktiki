<?php

namespace App\SAE\Lib;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ContratsAlternance;
use App\SAE\Model\Repository\ContratsAlternanceRepository;
use App\SAE\Model\Repository\EtudiantRepository;

class ImportationStudea extends IImportation
{
    /**
     * Crée un Contrat d'Alternance si l'étudiant (s'il existe) n'en a pas. Return null sinon
     * @param array $column
     * @param int $idAnneeUniversitaire
     * @return AbstractDataObject|null
     */
    protected function verifierEtCreer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject
    {
        $etu = (new EtudiantRepository())->getByEmail($column[28]);
        if($etu == null){
            return null;
        }

        $numEtu = $etu->getNumEtudiant();
        $rep = new ContratsAlternanceRepository();
        // Récupérer ou créer le contrat d'alternance pour l'étudiant et l'année universitaire courante
        $contratAlternance = $rep->getByIds($numEtu, $idAnneeUniversitaire);
        if($contratAlternance == null){
            if($column[16] == "Oui"){
                //Si l'insertion s'est bien passé
                if($rep->save($rep->construireDepuisTableau(array("numEtudiant" => $numEtu, "idAnneeUniversitaire" => $idAnneeUniversitaire)))){
                    $contratAlternance = $rep->getByIds($numEtu, $idAnneeUniversitaire);
                }
            }
        }
        return $contratAlternance;
    }

    /**
     * Ne fait rien car on n'a pas besoin de le mettre à jour
     * @param array $column
     * @param AbstractDataObject $dataObject
     * @return void
     */
    protected function mettreAJour(array $column, AbstractDataObject $dataObject): void
    {
        // Rien à faire içi
    }
}