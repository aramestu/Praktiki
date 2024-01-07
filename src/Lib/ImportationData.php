<?php

namespace App\SAE\Lib;

use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Service\ServiceConvention;

class ImportationData {

    public static function importFromPstage($fileName) {
        $file = fopen($fileName, "r");
        $anneeUniversitaireCourante = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire();
        $isFirstLine = true;
        while (($column = fgetcsv($file, 10000, ",")) !== false) {
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }
            $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            if($convention == null){
                (new ConventionRepository())->creerConvention($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire()); //création de la convention
                $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            }
            $attributs = [
                "estValideePstage" => $column[28] == "Oui"
            ];

            (new ServiceConvention())->mettreAJour($convention, $attributs);
        }
    }
}