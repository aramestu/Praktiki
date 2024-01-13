<?php

namespace App\SAE\Lib;

use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Service\ServiceConvention;

/**
 * Classe ImportationData gérant l'importation de données depuis un fichier Pstage.
 */
class ImportationData {

    /**
     * Importe des données depuis un fichier Pstage.
     *
     * @param string $fileName Le nom du fichier à importer.
     */
    public static function importFromPstage(string $fileName): void {
        $file = fopen($fileName, "r");

        // Récupération de l'année universitaire courante
        $anneeUniversitaireCourante = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire();

        $isFirstLine = true;
        while (($column = fgetcsv($file, 10000, ",")) !== false) {
            // Ignorer la première ligne du fichier
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            // Vérifier si l'étudiant existe dans la base de données
            if ((new EtudiantRepository())->getById($column[1]) == null) {
                continue;
            }

            // Récupérer ou créer la convention pour l'étudiant et l'année universitaire courante
            $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            if ($convention == null) {
                (new ConventionRepository())->creerConvention($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
                $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            }

            // Attributs à mettre à jour dans la convention
            $attributs = [
                "estValideePstage" => $column[28] == "Oui"
            ];

            // Mettre à jour la convention avec les attributs spécifiés
            (new ServiceConvention())->mettreAJour($convention, $attributs);
        }

        // Fermer le fichier après traitement
        fclose($file);
    }
}
