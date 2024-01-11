<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

/**
 * Classe abstraite pour la gestion de la persistance des objets de type ExperienceProfessionnel.
 *
 * @package App\SAE\Model\Repository
 */
abstract class AbstractExperienceProfessionnelRepository extends AbstractRepository{

    /**
     * Retourne les noms des colonnes spécifiques à la sous-classe.
     *
     * @return array Les noms des colonnes supplémentaires.
     */
    protected abstract function getNomsColonnesSupplementaires(): array;

    /**
     * Retourne le nom du DataObject associé à cette classe.
     *
     * @return string Le nom du DataObject.
     */
    protected abstract function getNomDataObject(): string;

    /**
     * Construit un objet ExperienceProfessionnel depuis un tableau de données.
     *
     * @param array $objetFormatTableau Le tableau de données.
     * @return ExperienceProfessionnel L'objet ExperienceProfessionnel.
     */
    public abstract function construireDepuisTableau(array $objetFormatTableau): ExperienceProfessionnel;

    /**
     * Retourne le nom de la clé primaire utilisée pour les objets ExperienceProfessionnel.
     *
     * @return string Le nom de la clé primaire.
     */
    abstract protected function getNomClePrimaire():string;

    protected function getNomsColonnes(): array {
        return array("idExperienceProfessionnel","sujetExperienceProfessionnel", "thematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel", "niveauExperienceProfessionnel", "codePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel", "dateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel", "siret", "datePublication");
    }

    /**
     * Retourne le nom de la table utilisée pour les objets ExperienceProfessionnel.
     *
     * @return string Le nom de la table.
     */
    protected function getNomTable(): string
    {
        return "ExperienceProfessionnel";
    }

    /**
     * Enregistre un objet ExperienceProfessionnel dans la base de données.
     *
     * @param AbstractDataObject $e L'objet à enregistrer.
     * @return bool True si l'enregistrement a réussi, sinon false.
     */
    public function save(AbstractDataObject $e): bool{
        try {
            // On insère d'abord dans ExperienceProfessionnel
            $pdo = Model::getPdo();
            $table = $this->getNomTable();
            $colonnes = $this->getNomsColonnes();
            array_splice($colonnes, array_search('datePublication', $colonnes), 1); // Pour supprimer datePublication

            // POur dire dans quel valeur on va insérer
            $sql = "INSERT INTO ExperienceProfessionnel (";

            // On commence à 1 pour éviter la clé primaire
            for($i =1; $i<sizeof($colonnes); $i++){
                $sql = $sql . $colonnes[$i];// Si ce n'est pas la datePublication
                if($i!=sizeof($colonnes)-1){// Si ce n'est pas le dernier alros on met une virgule
                    $sql = $sql . ", ";
                }
            }

            $sql .= ") VALUES (";
            // On commence à 1 pour éviter la clé primaire
            for($i =1; $i<sizeof($colonnes); $i++){
                // Si ce n'est pas la datePublication
                $sql = $sql . ":" . $colonnes[$i] . "Tag";
                // Si ce n'est pas le dernier alros on met une virgule
                if($i!=sizeof($colonnes)-1){
                    $sql = $sql . ", ";
                }
            }
            $sql .= ")";

            $formaTab = $e->formatTableau();
            // J'enlève les colonnes supplémentaires ex: gratificatione et idStage
            foreach ($this->getNomsColonnesSupplementaires() as $col){
                unset($formaTab[$col . "Tag"]);
            }
            unset($formaTab["idExperienceProfessionnelTag"]); // j'enlève l'id pour le formatTab
            unset($formaTab["datePublicationTag"]); // j'enlève la datePublicaiton pour le formatTab


            $requeteStatement = $pdo->prepare($sql);
            $requeteStatement->execute($formaTab);


            /* Puis on insère dans une de ses sous classes */


            $formatTab = $e->formatTableau(); // Pour récupérer les colonnes
            $lastInsert = $pdo->lastInsertId(); // Pour récupérer l'id de l'expPro qui vient d'être crée
            $formatTab[$this->getNomClePrimaire() . "Tag"] = $lastInsert; // Pour ajouter la bonne clé primaire aux colonnes
            $sql = "INSERT INTO " . $this->getNomTable() . " VALUES(";
            $colonne = $this->getNomsColonnesSupplementaires(); // Colonnes supplémentaires déjà dans formatTableau
            $value = array();
            for($i = 0; $i < sizeof($colonne); $i++){
                $sql = $sql . ":" . $colonne[$i] . "Tag";
                if($i != sizeof($colonne) - 1){
                    $sql .= " , ";
                }
                $value[$colonne[$i] . "Tag"] = $formatTab[$colonne[$i] . "Tag"];
            }
            $sql = $sql . ")";
            $pdo->prepare($sql)->execute($value);


            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    /**
     * Met à jour les attributs de l'instance d'ExperienceProfessionnel en fonction du tableau de données.
     *
     * @param array $expProFormatTableau Le tableau de données formaté.
     * @param ExperienceProfessionnel $exp L'instance d'ExperienceProfessionnel à mettre à jour.
     */
    protected function updateAttribut(array $expProFormatTableau, ExperienceProfessionnel $exp): void
    {
        $nomId = $this->getNomClePrimaire();

        // Vérifie si l'id existe dans le tableau avant de le mettre à jour
        if (array_key_exists($nomId, $expProFormatTableau)) {
            $exp->setIdExperienceProfessionnel($expProFormatTableau[$nomId]);
        }

        // Vérifie si la date de publication existe dans le tableau avant de la mettre à jour
        if (array_key_exists("datePublication", $expProFormatTableau)) {
            $exp->setDatePublication($expProFormatTableau["datePublication"]);
        }
    }

    /**
     * Récupère tous les objets ExperienceProfessionnel de la base de données.
     *
     * @return array Un tableau d'objets ExperienceProfessionnel.
     */
    public function getAll(): array
    {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();

        // Utilisation d'une requête JOIN pour récupérer les données liées de la table ExperienceProfessionnel
        $requestStatement = $pdo->query("SELECT * FROM $nomTable 
    JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire");

        $objects = [];

        // Parcours des résultats et construction des objets ExperienceProfessionnel
        foreach ($requestStatement as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }

        return $objects;
    }

    /**
     * Récupère un objet ExperienceProfessionnel par son identifiant.
     *
     * @param string $id L'identifiant de l'objet ExperienceProfessionnel à récupérer.
     * @return ExperienceProfessionnel|null L'objet ExperienceProfessionnel correspondant à l'identifiant ou null s'il n'existe pas.
     */
    public function getById(string $id): ?ExperienceProfessionnel
    {
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();

        // Utilisation d'une requête JOIN pour récupérer les données liées de la table ExperienceProfessionnel
        $sql = "SELECT * FROM $nomTable 
            JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire
            WHERE e.idExperienceProfessionnel = :id";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = ["id" => $id];

        $pdoStatement->execute($values);

        // Récupération du résultat
        $exp = $pdoStatement->fetch();

        // S'il n'y a pas d'offre associée
        if (!$exp) {
            return null;
        }

        // Construction de l'objet ExperienceProfessionnel
        return $this->construireDepuisTableau($exp);
    }


    /**
     * Met à jour un objet ExperienceProfessionnel dans la base de données.
     *
     * @param AbstractDataObject $exp L'objet à mettre à jour.
     */
    public function mettreAJour(AbstractDataObject $exp): void
    {
        // On insère d'abord dans ExperienceProfessionnel
        $pdo = Model::getPdo();
        $colonnes = $this->getNomsColonnes();
        array_splice($colonnes, array_search('datePublication', $colonnes), 1); // POur supprimer datePublication car on n'a pas besoin de la modif

        // POur dire dans quel valeur on va insérer
        $sql = "UPDATE ExperienceProfessionnel SET ";

        // On commence à 1 pour éviter la clé primaire
        for($i =1; $i<sizeof($colonnes); $i++){
            $sql = $sql . $colonnes[$i] . "= :" . $colonnes[$i] . "Tag";

            // Si ce n'est pas le dernier alros on met une virgule
            if($i!=sizeof($colonnes)-1){
                $sql = $sql . ", ";
            }
        }

        $sql .= " WHERE idExperienceProfessionnel= :idExperienceProfessionnelTag";

        $formaTab = $exp->formatTableau();
        // J'enlève les colonnes supplémentaires ex: gratificatione et idStage
        foreach ($this->getNomsColonnesSupplementaires() as $col){
            unset($formaTab[$col . "Tag"]);
        }
        unset($formaTab["datePublicationTag"]); // j'enlève la datePublicaiton pour le formatTab

        $requeteStatement = $pdo->prepare($sql);
        $requeteStatement->execute($formaTab);


        // Mise à jour de la sous table s'il n'y a pas que la clé primaire
        $colonnes = $this->getNomsColonnesSupplementaires();
        if(sizeof($colonnes) > 1){
            $nomTable = $this->getNomTable();
            $nomClePrimaire = $this->getNomClePrimaire();
            $values2 = array();
            $formatTableau = $exp->formatTableau();
            $sql2 = "UPDATE $nomTable SET ";
            // Je rempli la requête et le tableau de valeur grâce au format Tableau
            for($i=1; $i< sizeof($colonnes); $i++){
                $sql2 .= " {$colonnes[$i]} = :{$colonnes[$i]}Tag";
                $values2["{$colonnes[$i]}Tag"] = $formatTableau["{$colonnes[$i]}Tag"];
            }
            // Ajout condition WHERE pour
            $sql2 .= " WHERE $nomClePrimaire= :$nomClePrimaire" . "Tag";
            $values2[$nomClePrimaire . "Tag"] = $formatTableau["idExperienceProfessionnelTag"];
            $pdoStatement = Model::getPdo()->prepare($sql2);
            $pdoStatement->execute($values2);
        }

    }

    /**
     * Supprime un objet ExperienceProfessionnel de la base de données.
     *
     * @param string $id L'identifiant de l'objet à supprimer.
     */
    public function supprimer(string $id): void
    {
        // On supprime d'abord les sous classes puis dans ExpPro
        parent::supprimer($id);
        $sql = "DELETE FROM ExperienceProfessionnel WHERE idExperienceProfessionnel= :idTag;";

        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "idTag" => $id
        );

        $pdoStatement->execute($values);
    }

    /**
     * Archive un objet ExperienceProfessionnel en le déplaçant vers la table d'archives.
     *
     * @param string $valeurClePrimaire La valeur de la clé primaire de l'objet à archiver.
     */
    public function archiver(string $valeurClePrimaire): void
    {
        parent::archiver($valeurClePrimaire);
        $pdo = Model::getPdo();
        $table = "ExperienceProfessionnel";
        $tableArchives = "ExperienceProfessionnelArchives";
        $clePrimaire = "idExperienceProfessionnel";
        $sql = "INSERT INTO $tableArchives SELECT * FROM $table WHERE $table.$clePrimaire = :clePrimaireTag";
        $values = array("clePrimaireTag" => $valeurClePrimaire);
        $requeteStatement = $pdo->prepare($sql);
        $requeteStatement->execute($values);
    }

    /**
     * Recherche des objets ExperienceProfessionnel en fonction des critères spécifiés.
     *
     * @param string|null $keywords Mots-clés à rechercher.
     * @param string|null $dateDebut Date de début de l'expérience.
     * @param string|null $dateFin Date de fin de l'expérience.
     * @param string|null $optionTri Option de tri pour les résultats.
     * @param string|null $codePostal Code postal de l'expérience.
     * @param string|null $datePublication Option de filtrage par date de publication.
     * @param string|null $BUT2 Niveau d'études de type BUT2.
     * @param string|null $BUT3 Niveau d'études de type BUT3.
     * @return array Un tableau d'objets ExperienceProfessionnel correspondant aux critères de recherche.
     */
    public function search(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null): array{
        date_default_timezone_set('Europe/Paris');
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $values = array();
        $sql = "SELECT *
                FROM $nomTable JOIN ExperienceProfessionnel e ON $nomTable.$nomClePrimaire = e.idExperienceProfessionnel ";

        $whereAjoute = false;

        if (isset($datePublication)) {
            $sql .= match ($datePublication) {
                'last24' => "AND DATEDIFF(NOW(), datePublication) < 1 ",
                'lastWeek' => "AND DATEDIFF(NOW(), datePublication) < 7 ",
                'lastMonth' => "AND DATEDIFF(NOW(), datePublication) < 30 ",
            };
        }

        if ($dateDebut != null && $dateFin != null) {
            $sql .= "AND dateDebutExperienceProfessionnel >= '$dateDebut' AND dateFinExperienceProfessionnel <= '$dateFin' ";
        } elseif ($dateDebut != null) {
            $sql .= "AND dateDebutExperienceProfessionnel >= '$dateDebut' "; // modif >= à la place de =
        } elseif ($dateFin != null) {
            $sql .= "AND dateFinExperienceProfessionnel <= '$dateFin' "; // modif >= à la place de =
        }
        if ($codePostal != null) {
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if (isset($BUT2)){
            $sql .= "AND niveauExperienceProfessionnel = '$BUT2' ";
        }
        if (isset($BUT3)){
            $sql .= "AND niveauExperienceProfessionnel = '$BUT3' ";
        }
        if($keywords != null){
            $sql .= " AND " . $this->colonneToSearch(array_merge($this->getNomsColonnes(), $this->getNomsColonnesSupplementaires()));
            $values["keywordsTag"] = "%" . $keywords . "%";
        }
        if (isset($optionTri)) {
            if ($optionTri == "datePublication") {
                $sql .= " ORDER BY datePublication DESC";
            }
            else if ($optionTri == "datePublicationInverse") {
                $sql .= " ORDER BY datePublication ASC";
            }
            else if ($optionTri == "salaireCroissant" && $this->getNomTable() === 'Stages') {
                $sql .= " ORDER BY gratificationStage ASC";
            }
            else if ($optionTri == "salaireDecroissant" && $this->getNomTable() === 'Stages') {
                $sql .= " ORDER BY gratificationStage DESC";
            }
        }

        $request = Model::getPdo()->prepare($sql);

        $request->execute($values);
        $stageTriee = [];
        foreach ($request as $result) {
            $stageTriee[] = $this->construireDepuisTableau($result);
        }
        return $stageTriee;
    }

    /**
     * Obtient le délai de la date de publication d'une expérience professionnelle.
     *
     * @param ExperienceProfessionnel $expPro L'objet ExperienceProfessionnel.
     * @return string Le délai depuis la date de publication.
     */
    public static function getDelayDatePublication(ExperienceProfessionnel $expPro): string
    {
        $sql = "SELECT get_delay_experience(:id) AS delai_experience FROM ExperienceProfessionnel WHERE idExperienceProfessionnel = :id;";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = array(
            "id" => $expPro->getIdExperienceProfessionnel() // Utilisez "id" au lieu de "idExperienceProfessionnel" pour correspondre aux paramètres dans la requête SQL
        );
        $pdoStatement->execute($values);
        $result = $pdoStatement->fetch();
        return $result["delai_experience"]; // Utilisez le même alias que celui défini dans la requête SQL
    }

    /**
     * Obtient le nombre total d'objets ExperienceProfessionnel dans la base de données.
     *
     * @return int Le nombre total d'objets ExperienceProfessionnel.
     */
    public function getNbOffre() : int{
        $nomTable = $this->getNomTable();
        $sql = "SELECT COUNT(*) FROM $nomTable";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }
}