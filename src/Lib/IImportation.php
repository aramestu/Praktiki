<?php

namespace App\SAE\Lib;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Service\ServiceConvention;

abstract class IImportation
{
    protected abstract function verifierEtCreer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject;
    protected abstract function mettreAJour(array $column, AbstractDataObject $dataObject): void;
    public function import(string $fileName): void {
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
            var_dump("MAJ");
            $this->mettreAJour($column, $dataObject);
        }

        // Fermer le fichier après traitement
        fclose($file);
    }
}
