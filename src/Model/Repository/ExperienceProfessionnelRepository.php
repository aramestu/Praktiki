<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\DataObject\Stage;

class ExperienceProfessionnelRepository{

    public static function getAllStage(){
        return (new StageRepository())->getAll();
    }

    public static function getAllAlternance(){
        return (new StageRepository())->getAll();
    }

    public static function getAllOffreNonDefini(){
        return (new StageRepository())->getAll();
    }

    public static function getAll(){
        return array_merge(self::getAllStage(),array_merge(self::getAllAlternance(),self::getAllOffreNonDefini()));
    }

    public static function searchStage(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null){
        return (new StageRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
    }

    public static function searchAlternance(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null){
        return (new AlternanceRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
    }

    public static function searchOffreNonDefini(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null){
        return (new OffreNonDefiniRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
    }

    public static function search(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null){
        $tabStage = self::searchStage($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabAlternance = self::searchAlternance($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabOffreNonDefini = self::searchOffreNonDefini($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);

        if (isset($stage) && ! isset($alternance)) {
            // S'il n'y a pas une option de trie
            if(! isset($optionTri)){
                return array_merge($tabStage, $tabOffreNonDefini);
            }
            else{
                return AbstractExperienceProfessionnelRepository::sort($tabStage, $tabOffreNonDefini, $optionTri);
            }
        }
        // Si c'est filtré par alternance et aps par stage
        else if (isset($alternance) && ! isset($stage)) {
            if(! isset($optionTri)){
                return array_merge($tabAlternance, $tabOffreNonDefini);
            }
            else{
                return AbstractExperienceProfessionnelRepository::sort($tabAlternance, $tabOffreNonDefini, $optionTri);
            }
        }
        // S'il n'y a pas de filtre ou que c'est filtré par stage et alternance
        else {
            if (!isset($optionTri)) {
                return array_merge(array_merge($tabStage, $tabAlternance), $tabOffreNonDefini);
            } else {
                return AbstractExperienceProfessionnelRepository::sort(AbstractExperienceProfessionnelRepository::sort($tabStage, $tabOffreNonDefini, $optionTri), $tabAlternance, $optionTri);
            }

        }




    }

    public static function getDatePublication(ExperienceProfessionnel $e){
        return AbstractExperienceProfessionnelRepository::getDatePublication($e);
    }


}