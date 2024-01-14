<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

/**
 * Repository pour les différentes ExperienceProfessionels
 */

class ExperienceProfessionnelRepository{

    /**
     * Récupère toutes les expériences professionnelles (stages, alternances, offres non définies).
     *
     * @return array La liste de toutes les expériences professionnelles.
     */
    public function getAll(): array
    {
        return array_merge(
            (new StageRepository())->getAll(),
            (new AlternanceRepository())->getAll(),
            (new OffreNonDefiniRepository())->getAll()
        );
    }

    /**
     * Met à jour une expérience professionnelle.
     *
     * @param ExperienceProfessionnel $experienceProfessionnel L'expérience professionnelle à mettre à jour.
     */
    public function mettreAJour(ExperienceProfessionnel $experienceProfessionnel):void{
        $repository = "App\SAE\Model\Repository\\" . $experienceProfessionnel->getNomExperienceProfessionnel() . "Repository";
        (new $repository())->mettreAJour($experienceProfessionnel);
    }

    /**
     * Supprime une expérience professionnelle en fonction de son identifiant.
     *
     * @param string $id L'identifiant de l'expérience professionnelle à supprimer.
     */
    public function supprimer(string $id): void{
        (new StageRepository())->supprimer($id);
        (new AlternanceRepository())->supprimer($id);
        (new OffreNonDefiniRepository())->supprimer($id);
    }

    /**
     * Recherche des expériences professionnelles en fonction des critères fournis.
     *
     * @param string|null $keywords Les mots-clés de recherche.
     * @param string|null $dateDebut La date de début de l'expérience.
     * @param string|null $dateFin La date de fin de l'expérience.
     * @param string|null $optionTri L'option de tri à appliquer.
     * @param string|null $stage Filtre pour les stages.
     * @param string|null $alternance Filtre pour les alternances.
     * @param string|null $codePostal Le code postal pour la recherche.
     * @param string|null $datePublication La date de publication.
     * @param string|null $BUT2 Filtre pour les étudiants de BUT2.
     * @param string|null $BUT3 Filtre pour les étudiants de BUT3.
     * @return array La liste des expériences professionnelles filtrée.
     */
    public function search(?string $keywords = null, ?string $dateDebut = null, ?string $dateFin = null, ?string $optionTri = null, ?string $stage = null, ?string $alternance = null, ?string $codePostal = null, ?string $datePublication = null, ?string $BUT2 = null, ?string $BUT3 = null): array
    {
        if ($optionTri == null) {
            $optionTri = "datePublication";
        }

        $tabStage = (new StageRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabAlternance = (new AlternanceRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabOffreNonDefini = (new OffreNonDefiniRepository())->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);

        if (isset($stage) && !isset($alternance)) {
            // S'il n'y a pas une option de trie
            return self::sortExperienceProfessionnel($tabStage, $tabOffreNonDefini, $optionTri);
        } // Si c'est filtré par alternance et aps par stage
        else if (isset($alternance) && !isset($stage)) {
            return self::sortExperienceProfessionnel($tabAlternance, $tabOffreNonDefini, $optionTri);
        } // S'il n'y a pas de filtre ou que c'est filtré par stage et alternance
        else {
            return self::sortExperienceProfessionnel(self::sortExperienceProfessionnel($tabStage, $tabAlternance, $optionTri), $tabOffreNonDefini, $optionTri);
        }
    }

    /**
     * Trie et fusionne les expériences professionnelles.
     *
     * @param array $stages La liste des stages.
     * @param array $alternances La liste des alternances.
     * @param string $option L'option de tri.
     * @return array La liste triée et fusionnée des expériences professionnelles.
     */
    private static function sortExperienceProfessionnel(array $stages, array $alternances, string $option): array
    {
        if ($option == "salaireCroissant" || $option == "salaireDecroissant") {
            return array_merge($stages, $alternances);
        }
        $allExperienceProfessionnel = array();
        while (!empty($stages) && !empty($alternances)) {
            $order = match ($option) {
                "datePublication" => strtotime($stages[0]->getDatePublication()) - strtotime($alternances[0]->getDatePublication()),
                "datePublicationInverse" => strtotime($alternances[0]->getDatePublication()) - strtotime($stages[0]->getDatePublication())
            };
            if ($order >= 0) {
                $allExperienceProfessionnel[] = array_shift($stages);
            } else {
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);
    }

    /**
     * Obtient le nombre total d'expériences professionnelles.
     *
     * @return int Le nombre total d'expériences professionnelles.
     */
    public function getNbExperienceProfessionnel() : int{
        $sql = "SELECT COUNT(*) FROM ExperienceProfessionnel";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }
}