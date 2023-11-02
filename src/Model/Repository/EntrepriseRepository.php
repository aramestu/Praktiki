<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;

class EntrepriseRepository extends AbstractRepository
{

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise
    {
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"], $entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"], $entrepriseFormatTableau["estValide"]);
        return $entreprise;
    }

    protected function getNomTable(): string
    {
        return "Entreprises";
    }

    protected function getNomClePrimaire(): string
    {
        return "siret";
    }

    protected function getNomsColonnes(): array
    {
        return array("siret", "nomEntreprise", "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "siteWebEntreprise", "estValide");
    }

    private static function getEntrepriseAvecEtat(bool $etat)
    {
        $sql = "SELECT *
                FROM Entreprises e
                WHERE e.estValide = :etatTag";

        $request = Model::getPdo()->prepare($sql);

        $values = array(
            "etatTag" => $etat
        );

        $request->execute($values);

        $entrepriseRepository = new EntrepriseRepository();
        $objects = [];
        foreach ($request as $objectFormatTableau) {
            $objects[] = $entrepriseRepository->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    /* Retourne la liste des entreprises qui n'ont pas encore été validé */
    public static function getEntrepriseEnAttente(): array
    {
        return self::getEntrepriseAvecEtat(false);
    }

    /* Retourne la liste des entreprises qui ont été validée */
    public static function getEntrepriseValide(): array
    {
        return self::getEntrepriseAvecEtat(true);
    }

    /* Modifie l'état d'une entreprise, cad qu'elle peut être :
    *   - accepté ou validé (true/1)
     *  - en attente (false/0) */
    public static function accepter(string $siret)
    {
        $sql = "UPDATE Entreprises
                SET estValide = true
                WHERE siret= :siretTag";

        $requete = Model::getPdo()->prepare($sql);

        $values = array(
            "siretTag" => $siret
        );

        $requete->execute($values);
    }

    /* Change l'état d'une entreprise lorsqu'elle a été refusée */
    public static function refuser(string $siret)
    {
        $sql = "DELETE FROM Entreprises WHERE siret= :siretTag";

        $requete = Model::getPdo()->prepare($sql);

        $values = array(
            "siretTag" => $siret
        );

        $requete->execute($values);
    }


}