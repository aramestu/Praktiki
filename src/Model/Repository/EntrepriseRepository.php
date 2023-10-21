<?php
namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\Entreprise;
class EntrepriseRepository extends AbstractRepository {

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise{
        $entreprise = new Entreprise($entrepriseFormatTableau["siret"],$entrepriseFormatTableau["nomEntreprise"], $entrepriseFormatTableau["codePostalEntreprise"], $entrepriseFormatTableau["effectifEntreprise"], $entrepriseFormatTableau["telephoneEntreprise"], $entrepriseFormatTableau["siteWebEntreprise"], $entrepriseFormatTableau["estValide"]);
        return $entreprise;
    }

    protected function getNomTable(): string {
        return "Entreprises";
    }

    protected function getNomClePrimaire(): string {
        return "siret";
    }

    protected function getNomsColonnes(): array {
        return array("siret", "nomEntreprise", "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "siteWebEntreprise", "estValide");
    }

    /* Retourne la liste des entreprises qui n'ont pas encore été validé */
    public static function getEntrepriseEnAttente(): array {
        $sql = "SELECT *
                FROM Entreprises e
                WHERE e.estValide = false";

        $request = Model::getPdo()->query($sql);

        $entrepriseRepository = new EntrepriseRepository();
        $objects = [];
        foreach ($request as $objectFormatTableau) {
            $objects[] = $entrepriseRepository->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    /* Modifie l'état d'une entreprise, cad qu'elle peut être :
    *   - accepté ou validé (true/1)
     *  - en attente (false/0)
     *  - refusé (null)
     *  TEMPORAIRE, NULL ET FALSE SERONT INVERSES POUR PLUS LOGIQUE
    */
    private static function changerEtatEntreprise(string $siret, bool $etat = null){
        $sql = "UPDATE Entreprises
                SET estValide = :etatTag
                WHERE siret= :siretTag";

        $requete = Model::getPdo()->prepare($sql);

        $values = array(
            "etatTag"=> $etat,
            "siretTag" => $siret
        );

        $requete->execute($values);
    }

    /* Change l'état d'une entreprise lorsqu'elle a été validée */
    public static function accepter(string $siret){
        self::changerEtatEntreprise($siret, true);
    }

    /* Change l'état d'une entreprise lorsqu'elle a été refusée */
    public static function refuser(string $siret){
        self::changerEtatEntreprise($siret);
    }




}