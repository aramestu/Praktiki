<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;

/**
 * Repository pour la gestion des entités Stage.
 */
class StageRepository extends AbstractExperienceProfessionnelRepository
{
    /**
     * Obtient le nom de la classe DataObject correspondante.
     *
     * @return string
     */
    protected function getNomDataObject(): string
    {
        return "Stage";
    }

    /**
     * Obtient les noms des colonnes supplémentaires pour l'entité Stage.
     *
     * @return array
     */
    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idStage", "gratificationStage");
    }

    /**
     * Obtient le nom de la clé primaire pour l'entité Stage.
     *
     * @return string
     */
    protected function getNomClePrimaire(): string
    {
        return "idStage";
    }

    /**
     * Obtient le nom de la table de base de données correspondante.
     *
     * @return string
     */
    protected function getNomTable(): string
    {
        return "Stages";
    }

    /**
     * Construit une entité Stage à partir d'un tableau.
     *
     * @param array $expProFormatTableau La représentation en tableau de l'entité Stage.
     * @return ExperienceProfessionnel
     */
    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new Stage(
            $expProFormatTableau["sujetExperienceProfessionnel"],
            $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"],
            $expProFormatTableau["niveauExperienceProfessionnel"],
            $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"],
            $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"],
            $expProFormatTableau["siret"],
            $expProFormatTableau["gratificationStage"]
        );
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }
}
