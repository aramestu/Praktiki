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
     * Retourne un étudiant si son numEtudiant existe, null sinon
     * @param array $column
     * @return AbstractDataObject|null
     */
    protected function verifier(array $column): ?AbstractDataObject
    {
        // Vérifier si l'étudiant existe dans la base de données
        return (new EtudiantRepository())->getById($column[1]);

    }

    /**
     * Crée une convention si l'étudiant n'en a pas et qu'il n'a pas d'alternance. Return null sinon
     * @param array $column
     * @param int $idAnneeUniversitaire
     * @return AbstractDataObject|null
     */
    protected function creer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject
    {
        // Récupérer ou créer la convention pour l'étudiant et l'année universitaire courante
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $idAnneeUniversitaire);
        if ($convention == null) {
            // Si l'étudiant n'a pas déjà une alternance alors la convention peut être crée (true)
            if((new ConventionRepository())->creerConvention($column[1], $idAnneeUniversitaire)) {
                $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $idAnneeUniversitaire);
            }
        }
        return $convention;
    }

    /**
     * Retourne les attributs à mettre à jour dans la convention
     * @param array $column
     * @return array
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
