<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

class ExperienceProfessionnelRepository{

    public static function getAll(){
        return array_merge(
            (new StageRepository())->getAll(),
            (new AlternanceRepository())->getAll(),
            (new OffreNonDefiniRepository())->getAll()
        );
    }

    public static function search(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = "datePublication", string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null){
        $tabStage = (new StageRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabAlternance = (new AlternanceRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabOffreNonDefini = (new OffreNonDefiniRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);

        if (isset($stage) && ! isset($alternance)) {
            // S'il n'y a pas une option de trie
            return self::sortExperienceProfessionnel($tabStage, $tabOffreNonDefini, $optionTri);
        }
        // Si c'est filtré par alternance et aps par stage
        else if (isset($alternance) && ! isset($stage)) {
            return self::sortExperienceProfessionnel($tabAlternance, $tabOffreNonDefini, $optionTri);
        }
        // S'il n'y a pas de filtre ou que c'est filtré par stage et alternance
        else {
            return self::sortExperienceProfessionnel(self::sortExperienceProfessionnel($tabStage, $tabAlternance, $optionTri), $tabOffreNonDefini, $optionTri);
        }
    }

    public static function sortExperienceProfessionnel(array $stages, array $alternances, string $option): array {
        if($option == "salaireCroissant" || $option == "salaireDecroissant" ){
            return array_merge($stages, $alternances);
        }
        $allExperienceProfessionnel = array();
        while(!empty($stages) && !empty($alternances)){
            $order = match ($option){
                "datePublication" => strtotime($stages[0]->getDatePublication()) - strtotime($alternances[0]->getDatePublication()),
                "datePublicationInverse" => strtotime($alternances[0]->getDatePublication()) - strtotime($stages[0]->getDatePublication())
            };
            if($order>=0){
                $allExperienceProfessionnel[] = array_shift($stages);
            }else{
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);

    }
}