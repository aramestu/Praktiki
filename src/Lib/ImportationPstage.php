<?php

namespace App\SAE\Lib;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Service\ServiceConvention;

/**
 * Classe ImportationPstage gérant l'importation de données depuis un fichier Pstage.
 */
class ImportationPstage extends IImportation {

    /**
     * Crée une convention si l'étudiant (s'il existe) n'en a pas et qu'il n'a pas d'alternance. Return null sinon
     * @param array $column
     * @param int $idAnneeUniversitaire
     * @return AbstractDataObject|null
     */
    protected function verifierEtCreer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject
    {
        // Vérifier si l'étudiant existe dans la base de données
        $etu = (new EtudiantRepository())->getById($column[1]);
        if($etu == null){
            return null;
        }

        $rep = new ConventionRepository();
        // Récupérer ou créer la convention pour l'étudiant et l'année universitaire courante
        $convention = $rep->getConventionAvecEtudiant($column[1], $idAnneeUniversitaire);
        if ($convention == null) {
            // Si l'étudiant n'a pas déjà une alternance alors la convention peut être crée (true)
            if($rep->creerConvention($column[1], $idAnneeUniversitaire)) {
                $convention = $rep->getConventionAvecEtudiant($column[1], $idAnneeUniversitaire);
            }
        }
        return $convention;
    }

    /**
     * Retourne les attributs à mettre à jour dans la convention
     * @param array $column
     * @param AbstractDataObject $dataObject
     * @return void
     */
    protected function mettreAJour(array $column, AbstractDataObject $dataObject): void
    {
        $attributs = [
            "estValideePstage" => $column[28] == "Oui"
        ];

        // Mettre à jour la convention avec les attributs spécifiés
        (new ServiceConvention())->mettreAJour($dataObject, $attributs);
    }
}
