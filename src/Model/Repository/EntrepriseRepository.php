<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Entreprise;
/**
 * Repository pour la gestion des entreprises.
 */
class EntrepriseRepository extends AbstractRepository
{
    /**
     * Construit un objet Entreprise à partir d'un tableau de données formaté.
     *
     * @param array $entrepriseFormatTableau Le tableau de données de l'entreprise.
     * @return Entreprise L'objet Entreprise créé.
     */
    public function construireDepuisTableau(array $entrepriseFormatTableau): Entreprise {
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

    /**
     * Retourne le nom de la table des entreprises.
     *
     * @return string Le nom de la table des entreprises.
     */
    protected function getNomTable(): string{
        return "Entreprises";
    }

    /**
     * Retourne le nom de la clé primaire de la table des entreprises.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "siret";
    }

    /**
     * Retourne les noms des colonnes de la table des entreprises.
     *
     * @return array Les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array(
            "siret", "nomEntreprise", "codePostalEntreprise", "effectifEntreprise",
            "telephoneEntreprise", "siteWebEntreprise", "estValide", "mailEntreprise",
            "mdpHache",  "mailAValider", "nonce"
        );
    }

    /**
     * Retourne la liste des entreprises qui n'ont pas encore été validées + filtre.
     *
     * @param string|null $keywords Les mots-clés de recherche.
     * @param string|null $codePostalEntreprise Le code postal de l'entreprise.
     * @param string|null $effectifEntreprise L'effectif de l'entreprise.
     * @return array La liste des entreprises en attente.
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

    /**
     * Retourne la liste des entreprises en attente de validation + filtre.
     *
     * @param string|null $keywords Les mots-clés de recherche.
     * @param string|null $codePostalEntreprise Le code postal de l'entreprise.
     * @param string|null $effectifEntreprise   L'effectif de l'entreprise.
     * @return array La liste des entreprises en attente de validation.
     */
    public function getEntrepriseEnAttenteFiltree( string $keywords = null, string $codePostalEntreprise = null, string $effectifEntreprise = null): array
    {
        return self::getEntrepriseAvecEtatFiltree(false, $keywords, $codePostalEntreprise, $effectifEntreprise);
    }

    /**
     * Retourne la liste des entreprises validées + filtre.
     *
     * @param string|null $keywords Les mots-clés de recherche.
     * @param string|null $codePostalEntreprise Le code postal de l'entreprise.
     * @param string|null $effectifEntreprise   L'effectif de l'entreprise.
     * @return array La liste des entreprises validées.
     */
    public function getEntrepriseValideFiltree( string $keywords = null, string $codePostalEntreprise = null, string $effectifEntreprise = null): array
    {
        return self::getEntrepriseAvecEtatFiltree(true, $keywords, $codePostalEntreprise, $effectifEntreprise);
    }

    /**
     * Modifie l'état d'une entreprise, c'est-à-dire qu'elle peut être :
     *   - acceptée ou validée (true/1)
     *   - en attente (false/0).
     *
     * @param string $siret Le siret de l'entreprise.
     */
    public static function accepter(string $siret): void
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

    /**
     * Change l'état d'une entreprise lorsqu'elle a été refusée.
     *
     * @param string $siret Le siret de l'entreprise à refuser.
     */
    public static function refuser(string $siret): void
    {
        $sql = "DELETE FROM Entreprises WHERE siret= :siretTag";

        $requete = Model::getPdo()->prepare($sql);

        $values = array(
            "siretTag" => $siret
        );

        $requete->execute($values);
    }

    /**
     * Change l'état d'une entreprise lorsqu'elle a été refusée.
     *
     * @param string $siret Le siret de l'entreprise à refuser.
     */
    public static function creermdp($mdp): void
    {
        $sql="update Entreprises set mdpHache=:mdpHacheTag where siret=:siretTag";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = array(
            "mdpHacheTag" => MotDePasse::hacher($mdp),
            "siretTag" => '01234567890123'
        );
        $pdoStatement->execute($values);
    }

    /**
     * Retourne le nombre d'entreprises validées.
     *
     * @return int Le nombre d'entreprises validées.
     */
    public function getNbEntrepriseValide(): int
    {
        $sql = "SELECT COUNT(*) FROM Entreprises WHERE estValide = 1";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    /**
     * Retourne le nombre d'entreprises en attente de validation.
     *
     * @return int Le nombre d'entreprises en attente de validation.
     */
    public function getNbEntrepriseAttente() : int{
        $sql = "SELECT COUNT(*) FROM Entreprises WHERE estValide = 0";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    /**
     * Retourne le nombre d'entreprises refusées (archivées).
     *
     * @return int Le nombre d'entreprises refusées.
     */
    public function getNbEntrpriseRefusee() : int{
        $sql = "SELECT COUNT(*) FROM EntreprisesArchives";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }
}