<?php

namespace App\SAE\Lib;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Service\ServiceConvention;

abstract class IImportation
{

    protected abstract function verifier(array $column): ?AbstractDataObject;
    protected abstract function creer(array $column, int $idAnneeUniversitaire): ?AbstractDataObject;
    public function import(string $fileName, int $indiceNumEtudiant): void {
        $file = fopen($fileName, "r");

        // Récupération de l'année universitaire courante
        $anneeUniversitaireCourante = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire();

        $isFirstLine = true;
        while (($column = fgetcsv($file, 10000, ";")) !== false) {
            // Ignorer la première ligne du fichier
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            // Vérifier si l'étudiant existe dans la base de données
            if ($this->verifier($column) == null) {
                continue;
            }

            // Récupérer ou créer la convention pour l'étudiant et l'année universitaire courante
            $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
            if ($convention == null) {
                // Si l'étudiant n'a pas déjà une alternance alors la convention peut être crée (true)
                if((new ConventionRepository())->creerConvention($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire())) {
                    $convention = (new ConventionRepository())->getConventionAvecEtudiant($column[1], $anneeUniversitaireCourante->getIdAnneeUniversitaire());
                }
                else{
                    continue;
                }
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
