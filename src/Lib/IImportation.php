<?php

namespace App\SAE\Lib;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;

/**
 * Classe abstraite définissant une interface pour l'importation de données à partir d'un fichier.
 *
 * @package App\SAE\Lib
 */
abstract class IImportation
{
    /**
     * Vérifie et crée un objet de données à partir d'une ligne du fichier.
     *
     * @param array $column Les données de la ligne du fichier.
     * @param int $idAnneeUniversitaire L'ID de l'année universitaire en cours.
     *
     * @return AbstractDataObject|null L'objet de données créé ou null si la vérification échoue.
     */
    protected abstract function verifierEtCreer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject;

    /**
     * Met à jour un objet de données existant avec les données de la ligne du fichier.
     *
     * @param array $column Les données de la ligne du fichier.
     * @param AbstractDataObject $dataObject L'objet de données à mettre à jour.
     *
     * @return void
     */
    protected abstract function mettreAJour(array $column, AbstractDataObject $dataObject): void;

    /**
     * Importe des données à partir d'un fichier.
     *
     * @param string $fileName Le chemin du fichier à importer.
     *
     * @return void
     */
    public function import(string $fileName): void {
        // Ouvrir le fichier en mode lecture
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
            $dataObject = $this->verifierEtCreer($column, $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            if($dataObject == null){
                continue;
            }
            // Mettre à jour l'objet de données
            $this->mettreAJour($column, $dataObject);
        }

        // Fermer le fichier après traitement
        fclose($file);
    }
}
