<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Entreprise;

class EntrepriseRepository extends AbstractRepository
{

    protected function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise {
        $entreprise = new Entreprise(
            $entrepriseFormatTableau["siret"],
            $entrepriseFormatTableau["nomEntreprise"],
            $entrepriseFormatTableau["codePostalEntreprise"],
            $entrepriseFormatTableau["effectifEntreprise"],
            $entrepriseFormatTableau["telephoneEntreprise"],
            $entrepriseFormatTableau["siteWebEntreprise"],
            $entrepriseFormatTableau["mailEntreprise"],
            $entrepriseFormatTableau["mdpHache"],
            $entrepriseFormatTableau["mailAValider"],
            $entrepriseFormatTableau["nonce"]);
        if(isset($entrepriseFormatTableau["estValide"])){
            $entreprise->setEstValide($entrepriseFormatTableau["estValide"]);
        }
        return $entreprise;
    }

    protected function getNomTable(): string{
        return "Entreprises";
    }

    protected function getNomClePrimaire(): string
    {
        return "siret";
    }

    protected function getNomsColonnes(): array
    {
        return array("siret", "nomEntreprise", "codePostalEntreprise", "effectifEntreprise", "telephoneEntreprise", "siteWebEntreprise", "estValide", "mailEntreprise", "mdpHache",  "mailAValider", "nonce");
    }

    /*
     * - etat : true = validé et false = en attente
     * - keywords : mot clé que l'on recherche dans les données des entreprises pour filtrer
     * - codePostalEntreprise : filtre par code postal
     * - effectifEntreprise : filtre et trie décroissant.
     *      Affiche les entreprises qui ont un effectif inférieur à celui renseigné par l'utilisateur
     *  Renvoi une liste des entreprises en fonction de leur état (validé ou en attente)
     */
    public function getEntrepriseAvecEtatFiltree(bool $etat=null, string $keywords = null, string $codePostalEntreprise = null, string $effectifEntreprise = null): array
    {
        $sql = "SELECT *
                FROM Entreprises e";
        $values = array();
        if(!is_null($etat)){
            $sql .= "\nWHERE e.estValide = :etatTag ";
            $values["etatTag"] = $etat;
        }

        // S'il y a un mot clé alors on filtre sinon non
        if(! is_null($keywords) && $keywords != ""){
            if(strpos($sql,"WHERE")){
                $sql .= " AND ";
            }else{
                $sql .= " WHERE ";
            }
            $sql .= $this->colonneToSearch(array("siret", "nomEntreprise"));
            $values["keywordsTag"] = '%' . $keywords . '%';
        }

        // Si un codePostal a été renseigné alors on filtre par ça
        if(! is_null($codePostalEntreprise) && $codePostalEntreprise != ""){
            if(strpos($sql,"WHERE")){
                $sql .= " AND ";
            }else{
                $sql .= " WHERE ";
            }

            $sql .= "codePostalEntreprise = :codePostalEntrepriseTag ";
            $values["codePostalEntrepriseTag"] = $codePostalEntreprise;
        }

        // Si un effectif a été renseigné alors on filtre par ça
        if(! is_null($effectifEntreprise) && $effectifEntreprise != ""){
            if(strpos($sql,"WHERE")){
                $sql .= " AND ";
            }else{
                $sql .= " WHERE ";
            }
            $sql .= "effectifEntreprise <= :effectifEntrepriseTag ORDER BY effectifEntreprise, nomEntreprise ";
            $values["effectifEntrepriseTag"] = $effectifEntreprise;
        }
        $request = Model::getPdo()->prepare($sql);

        $request->execute($values);

        $objects = [];
        foreach ($request as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    /* Retourne la liste des entreprises qui n'ont pas encore été validé + filtre */
    public function getEntrepriseEnAttenteFiltree( string $keywords = null, string $codePostalEntreprise = null, string $effectifEntreprise = null): array
    {
        return self::getEntrepriseAvecEtatFiltree(false, $keywords, $codePostalEntreprise, $effectifEntreprise);
    }

    /* Retourne la liste des entreprises qui ont été validée + filtre */
    public function getEntrepriseValideFiltree( string $keywords = null, string $codePostalEntreprise = null, string $effectifEntreprise = null): array
    {
        return self::getEntrepriseAvecEtatFiltree(true, $keywords, $codePostalEntreprise, $effectifEntreprise);
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

    public static function creermdp($mdp){
        $sql="update Entreprises set mdpHache=:mdpHacheTag where siret=:siretTag";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = array(
            "mdpHacheTag" => MotDePasse::hacher($mdp),
            "siretTag" => '01234567890123'
        );
        $pdoStatement->execute($values);
    }


}