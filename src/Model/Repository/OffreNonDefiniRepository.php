<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

/**
 * Repository corcernant les offresNonDefini
 */
class OffreNonDefiniRepository extends AbstractExperienceProfessionnelRepository {

    /**
     * Renvoie le nom de la classe DataObject associée.
     *
     * @return string Le nom de la classe DataObject.
     */
    protected function getNomDataObject(): string
    {
        return "OffreNonDefini";
    }


    /**
     * Renvoie le nom de la clé primaire dans la table.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "idOffreNonDefini";
    }

    /**
     * Renvoie le nom de la table associée.
     *
     * @return string Le nom de la table.
     */
    protected function getNomTable(): string
    {
        return "OffreNonDefini";
    }

    /**
     * Renvoie les noms des colonnes supplémentaires spécifiques à cette classe.
     *
     * @return array Les noms des colonnes supplémentaires.
     */
    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idOffreNonDefini");
    }

    /**
     * Construit une instance d'ExperienceProfessionnel depuis un tableau de données.
     *
     * @param array $expProFormatTableau Le tableau de données formaté.
     * @return ExperienceProfessionnel L'instance d'ExperienceProfessionnel.
     */
    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new OffreNonDefini(
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

        // Utilise la méthode updateAttribut pour mettre à jour les attributs de l'instance.
        $this->updateAttribut($expProFormatTableau, $exp);

        return $exp;
    }
}
