<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;
/**
 * Repository pour la gestion des étudiants
 */

class EtudiantRepository extends AbstractRepository
{


    /**
     * Retourne la liste des étudiants avec une convention en fonction des critères donnés.
     *
     * @param bool $estSigne Indique si la convention est signée.
     * @param bool $estValide Indique si la convention est validée.
     * @return array La liste des étudiants avec une convention en fonction des critères donnés.
     */
    public function getEtudiantConventionValide(bool $estSigne, bool $estValide): array{ //TODO mettre à jour pour les nouvelles conventions
            $sql = "SELECT * FROM Etudiants e 
                JOIN Conventions c ON c.idStage = e.idStage ";

        $whereAjoutee = false;
        $values = array();
        if($estSigne){
            $sql .= " WHERE c.estSigne = :estSigneTag";
            $values["estSigneTag"] = $estSigne;
            $whereAjoutee = true;
        }
        if($estValide){
            // SI un where n'a pas été ajouté avant
            if(! $whereAjoutee){
                $sql .= " WHERE ";
            }
            $sql .= " c.estValide = :estValideTag";
            $values["estValideTag"] = $estValide;

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
     * Vérifie si la convention d'un étudiant est validée.
     *
     * @param Etudiant $etudiant L'objet étudiant.
     * @param int $idAnneeUniversitaire L'identifiant de l'année universitaire.
     * @return bool True si la convention est validée, sinon false.
     */
    public function conventionEtudiantEstValide(Etudiant $etudiant, int $idAnneeUniversitaire=3): bool{ //TODO : enlever la valeur par defaut de l'année universitaire quand le pannel admin sera mit à jour
        $sql = "SELECT estValideeAdmin FROM Etudiants etu
                JOIN ConventionsStageEtudiant cse ON cse.numEtudiant = etu.numEtudiant
                JOIN Conventions c ON c.idConvention = cse.idConvention
                WHERE etu.numEtudiant = :numEtudiantTag
                AND idAnneeUniversitaire = :idAnneeUniversitaireTag";

        $request = Model::getPdo()->prepare($sql);
        $values = array(
            "numEtudiantTag" => $etudiant->getNumEtudiant(),
            "idAnneeUniversitaireTag" => $idAnneeUniversitaire
        );
        $request->execute($values);
        $result = $request->fetch();
        if($result==false){
            return false;
        }
        elseif($result["estValideeAdmin"] == 1){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Vérifie si la convention d'un étudiant est signée.
     *
     * @param Etudiant $etudiant L'objet étudiant.
     * @param int $idAnneeUniversitaire L'identifiant de l'année universitaire.
     * @return bool True si la convention est signée, sinon false.
     */
    public function conventionEtudiantEstSignee(Etudiant $etudiant, int $idAnneeUniversitaire): bool{
        $sql = "SELECT estSignee FROM Etudiants etu
                JOIN ConventionsStageEtudiant cse ON cse.numEtudiant = etu.numEtudiant
                JOIN Conventions c ON c.idConvention = cse.idConvention
                WHERE etu.numEtudiant = :numEtudiantTag
                AND idAnneeUniversitaire = :idAnneeUniversitaireTag";

        $request = Model::getPdo()->prepare($sql);
        $values = array(
            "numEtudiantTag" => $etudiant->getNumEtudiant(),
            "idAnneeUniversitaireTag" => $idAnneeUniversitaire
        );
        $request->execute($values);
        $result = $request->fetch();
        if(!$result){
            return false;
        }
        elseif($result["estSignee"] == 1){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Vérifie si un étudiant a un stage.
     *
     * @param Etudiant $etudiant L'objet étudiant.
     * @return bool True si l'étudiant a un stage, sinon false.
     */
    public function etudiantAStage(Etudiant $etudiant): bool{
        return $this->conventionEtudiantEstValide($etudiant);
    }

    /**
     * Vérifie si un étudiant a une alternance.
     *
     * @param Etudiant $etudiant L'objet étudiant.
     * @return bool False pour l'instant, à revoir quand l'appartenance à une alternance sera implémentée.
     */
    public function etudiantAAlternance(Etudiant $etudiant): bool{ //TODO : refaire quand l'appartenance à une alternance sera implémentée
        return false;
    }

    /**
     * Inscrit un étudiant.
     *
     * @param string $numEtudiant Le numéro de l'étudiant.
     * @param string $nomDepartement Le nom du département.
     * @param string $nomAnneeUniversitaire Le nom de l'année universitaire.
     * @return bool True si l'inscription est réussie, sinon false.
     */
    public static function inscrire(string $numEtudiant, string $nomDepartement, string $nomAnneeUniversitaire): bool
    {
        try {
            $pdo = Model::getPdo();
            $sql = "INSERT INTO Inscriptions 
            VALUES ( :numEtudiant, :idAnneeUniversitaire,:codeDepartement)";
            $requestStatement = $pdo->prepare($sql);
            $values = array(
                "numEtudiant" => $numEtudiant,
                "idAnneeUniversitaire" => (new AnneeUniversitaireRepository())->getByNom($nomAnneeUniversitaire)->getIdAnneeUniversitaire(),
                "codeDepartement" => (new DepartementRepository())->getByNom($nomDepartement)->getCodeDepartement());
            $requestStatement->execute($values);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * Recherche des étudiants par mots-clés.
     *
     * @param string $keywords Les mots-clés de recherche.
     * @return array La liste des étudiants correspondant à la recherche.
     */
    public function search(string $keywords): array{
        $sql = "SELECT * FROM Etudiants
                WHERE ";
        $sql .= $this->colonneToSearch(array("numEtudiant", "nomEtudiant", "prenomEtudiant"));
        $values["keywordsTag"] = '%' . $keywords . '%';

        $request = Model::getPdo()->prepare($sql);
        $request->execute($values);
        $listeEtudiants = array();
        foreach ($request as $etudiantTab) {
            $listeEtudiants[] = $this->construireDepuisTableau($etudiantTab);
        }
        return $listeEtudiants;
    }

    /**
     * Construit un objet Etudiant depuis un tableau de données.
     *
     * @param array $EtudiantFormatTableau Le tableau de données de l'étudiant.
     * @return Etudiant L'objet étudiant construit.
     */
    public function construireDepuisTableau(array $EtudiantFormatTableau): Etudiant
    {
        return new Etudiant($EtudiantFormatTableau["numEtudiant"], $EtudiantFormatTableau["prenomEtudiant"], $EtudiantFormatTableau["nomEtudiant"],
            $EtudiantFormatTableau["mailPersoEtudiant"], $EtudiantFormatTableau["mailUniversitaireEtudiant"], $EtudiantFormatTableau["telephoneEtudiant"],
            $EtudiantFormatTableau["codePostalEtudiant"]);
    }

    /**
     * Obtient un étudiant par son adresse e-mail universitaire.
     *
     * @param string $valeurEmail L'adresse e-mail universitaire.
     * @return Etudiant|null L'objet étudiant correspondant à l'adresse e-mail, ou null si non trouvé.
     */
    public function getByEmail(string $valeurEmail): ?Etudiant{
        $sql = "SELECT * from Etudiants WHERE mailUniversitaireEtudiant = :EmailTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "EmailTag" => $valeurEmail
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();

        if(!$objetFormatTableau){
            return null;
        }
        else{
            return (new EtudiantRepository())->construireDepuisTableau($objetFormatTableau);
        }
    }

    public function getEtudiantAvecConvention(string $idConvention): ?Etudiant{
        $sql = "SELECT * FROM Etudiants e
                WHERE EXISTS(SELECT * FROM ConventionsStageEtudiant cse
                             WHERE e.numEtudiant= cse.numEtudiant
                             AND idConvention = :idConventionTag)";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = [
            "idConventionTag" => $idConvention
        ];
        $pdoStatement->execute($values);

        $etudiantFormatTableau = $pdoStatement->fetch();
        if(!$etudiantFormatTableau){
            return null;
        }
        else{
            return (new EtudiantRepository())->construireDepuisTableau($etudiantFormatTableau);
        }
    }

     /**
     * Obtient le nom de la table pour la requête SQL.
     *
     * @return string Le nom de la table.
     */
    protected function getNomTable(): string
    {
        return "Etudiants";
    }
    /**
     * Obtient le nom de la clé primaire pour la requête SQL.
     *
     * @return string Le nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    /**
     * Obtient les noms des colonnes pour la requête SQL.
     *
     * @return array Les noms des colonnes.
     */
    protected function getNomsColonnes(): array
    {
        return array(
            "numEtudiant", "nomEtudiant", "prenomEtudiant", "mailPersoEtudiant", "mailUniversitaireEtudiant",
            "telephoneEtudiant", "codePostalEtudiant"
        );
    }

    //TODO : a revoir quand les conventions seront bien implemanté
    /**
     * Obtient le nombre d'étudiants avec une convention validée.
     *
     * @return int Le nombre d'étudiants avec une convention validée.
     */
    public function getNbEtudiantConventionValide(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e JOIN ConventionsStageEtudiant cse ON e.numEtudiant = cse.numEtudiant JOIN Conventions c ON c.idConvention = cse.idConvention 
                WHERE estValideeAdmin = 1";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    /**
     * Obtient le nombre d'étudiants avec une convention en attente.
     *
     * @return int Le nombre d'étudiants avec une convention en attente.
     */
    public function getNbEtudiantConventionAttente(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e JOIN ConventionsStageEtudiant cse ON e.numEtudiant = cse.numEtudiant";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    /**
     * Obtient le nombre d'étudiants sans convention.
     *
     * @return int Le nombre d'étudiants sans convention.
     */
    public function getNbEtudiantSansConvention(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e WHERE NOT EXISTS (SELECT * FROM ConventionsStageEtudiant cse WHERE e.numEtudiant = cse.numEtudiant);";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }
}
