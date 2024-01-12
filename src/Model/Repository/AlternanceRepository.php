<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

/**
 * Repository pour la gestion des objets "Alternance" en base de données.
 */
class AlternanceRepository extends AbstractExperienceProfessionnelRepository
{
    /**
     * Retourne le nom de la classe DataObject associée à ce repository.
     *
     * @return string Nom de la classe DataObject.
     */
    protected function getNomDataObject(): string
    {
        return "Alternance";
    }

    /**
     * Retourne les noms des colonnes supplémentaires spécifiques à la table "Alternances".
     *
     * @return array Tableau contenant les noms des colonnes supplémentaires.
     */
    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idAlternance");
    }

    /**
     * Retourne le nom de la clé primaire de la table "Alternances".
     *
     * @return string Nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "idAlternance";
    }

    /**
     * Retourne le nom de la table associée à ce repository.
     *
     * @return string Nom de la table.
     */
    protected function getNomTable(): string
    {
        return "Alternances";
    }

    /**
     * Construit un objet "Alternance" à partir d'un tableau formaté.
     *
     * @param array $expProFormatTableau Le tableau formaté représentant l'objet.
     * @return ExperienceProfessionnel Objet "Alternance" construit.
     */
    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new Alternance(
            $expProFormatTableau["sujetExperienceProfessionnel"],
            $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"],
            $expProFormatTableau["niveauExperienceProfessionnel"],
            $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"],
            $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"],
            $expProFormatTableau["siret"]
        );
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }
}
