<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Alternance;
use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\DataObject\ExperienceProfessionnel;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\Model;

abstract class AbstractExperienceProfessionnelRepository extends AbstractRepository
{
    protected abstract function getNomsColonnesSupplementaires(): array;
    protected abstract function getNomDataObject(): string;
    public abstract function construireDepuisTableau(array $objetFormatTableau): ExperienceProfessionnel;

    protected function getNomsColonnes(): array
    {
        return array("idExperienceProfessionnel","sujetExperienceProfessionnel", "thematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel", "niveauExperienceProfessionnel", "codePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel", "dateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel", "siret", "numEtudiant", "mailEnseignant", "mailTuteurProfessionnel", "datePublication");
    }

    protected function getNomClePrimaire(): string
    {
        return "idExperienceProfessionnel";
    }

    protected function getNomTable(): string
    {
        return "ExperienceProfessionnel";
    }

    public function save(AbstractDataObject $e): bool{
        try {
            // On insère d'abord dans ExperienceProfessionnel
            $pdo = Model::getPdo();
            $table = $this->getNomTable();
            $colonnes = $this->getNomsColonnes();
            array_splice($colonnes, array_search('datePublication', $colonnes), 1); // POur supprimer datePublication

            // POur dire dans quel valeur on va insérer
            $sql = "INSERT INTO ExperienceProfessionnel (";

            // On commence à 1 pour éviter la clé primaire
            for($i =1; $i<sizeof($colonnes); $i++){
                // Si ce n'est pas la datePublication
                $sql = $sql . $colonnes[$i];

                // Si ce n'est pas le dernier alros on met une virgule
                if($i!=sizeof($colonnes)-1){
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


            // SI les valeures sont vides alors on met null pour insérer
            if ($e->getNumEtudiant() == "") {
                $formaTab["numEtudiantTag"] = null;
            }
            if ($e->getMailEnseignant() == "") {
                $formaTab["mailEnseignantTag"] = null;
            }
            if ($e->getMailTuteurProfessionnel() == "") {
                $formaTab["mailTuteurProfessionnelTag"] = null;
            }

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


    /* utilisé pour construireDepuisTableau afin de dupliquer du code avec StageRepository
     *
     */
    public function updateAttribut(array $expProFormatTableau, ExperienceProfessionnel $exp): void {
        $nomId = $this->getNomClePrimaire();
        // Les id ont des noms différents, je vérif qu'ils existent
        if (array_key_exists($nomId, $expProFormatTableau)) {
            $exp->setIdExperienceProfessionnel($expProFormatTableau[$nomId]);
        }
        if (array_key_exists("numEtudiant", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["numEtudiant"])) {
                $exp->setNumEtudiant($expProFormatTableau["numEtudiant"]);
            }
        }
        if (array_key_exists("mailEnseignant", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["mailEnseignant"])) {
                $exp->setMailEnseignant($expProFormatTableau["mailEnseignant"]);
            }
        }
        if (array_key_exists("mailTuteurProfessionnel", $expProFormatTableau)) {
            if (!empty($expProFormatTableau["mailTuteurProfessionnel"])) {
                $exp->setMailTuteurProfessionnel($expProFormatTableau["mailTuteurProfessionnel"]);
            }
        }
        if (array_key_exists("datePublication", $expProFormatTableau)) {
            $exp->setDatePublication($expProFormatTableau["datePublication"]);
        }
    }

    public function getAll(): array
    {
        $pdo = Model::getPdo();
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $requestStatement =  $pdo->query("SELECT * FROM $nomTable 
        JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire");

        $objects = [];
        foreach ($requestStatement as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    public function get(string $id): ?ExperienceProfessionnel
    {
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $sql = "SELECT * 
                FROM $nomTable 
                JOIN ExperienceProfessionnel e ON e.idExperienceProfessionnel = $nomTable.$nomClePrimaire
                WHERE e.idExperienceProfessionnel = :id";
        $pdoStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "id" => $id,
        );

        $pdoStatement->execute($values);

        $exp = $pdoStatement->fetch();

        // S'il n'y a pas d'offre associée
        if (! $exp) {
            return null;
        }
        return $this->construireDepuisTableau($exp);
    }

    private static function sort(array $stages, array $alternances, string $option): array
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
            if ($order < 0) {
                $allExperienceProfessionnel[] = array_shift($stages);
            } else {
                $allExperienceProfessionnel[] = array_shift($alternances);
            }
        }
        return array_merge($allExperienceProfessionnel, $stages, $alternances);
    }

    public function mettreAJour(AbstractDataObject $exp): void
    {
        // On insère d'abord dans ExperienceProfessionnel
        $pdo = Model::getPdo();
        $table = $this->getNomTable();
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


        // SI les valeures sont vides alors on met null pour insérer
        if ($exp->getNumEtudiant() == "") {
            $formaTab["numEtudiantTag"] = null;
        }
        if ($exp->getMailEnseignant() == "") {
            $formaTab["mailEnseignantTag"] = null;
        }
        if ($exp->getMailTuteurProfessionnel() == "") {
            $formaTab["mailTuteurProfessionnelTag"] = null;
        }

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
            for($i = 1; $i < sizeof($colonnes); $i++){
                $nomColonne = $colonnes[$i];
                $sql2 .= " $nomColonne= :$nomColonne" . "Tag";
                $values2[$nomColonne . "Tag"] = $formatTableau[$nomColonne . "Tag"];
            }
            // Ajout condition WHERE pour
            $sql2 .= " WHERE $nomClePrimaire= :$nomClePrimaire" . "Tag";
            $values2[$nomClePrimaire . "Tag"] = $formatTableau["idExperienceProfessionnelTag"];
            $pdoStatement = Model::getPdo()->prepare($sql2);
            $pdoStatement->execute($values2);
        }

    }

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


    public static function rechercheAllOffreFiltree(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $stage = null, string $alternance = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null) : array{
        $tabStages = (new StageRepository)->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabAlternance = (new AlternanceRepository)->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        $tabOffreNonDefini = (new OffreNonDefiniRepository)->search($keywords, $dateDebut, $dateFin, $optionTri, $codePostal, $datePublication, $BUT2, $BUT3);
        // Si c'est filtré par stage
        if (isset($stage)) {
            // S'il n'y a pas une option de trie
            if(! isset($optionTri)){
                return array_merge($tabStages, $tabOffreNonDefini);
            }
            else{
                return self::sort($tabStages, $tabOffreNonDefini, $optionTri);
            }
        }
        // Si c'est filtré par alternance
        else if (isset($alternance)) {
            if(! isset($optionTri)){
                return array_merge($tabAlternance, $tabOffreNonDefini);
            }
            else{
                return self::sort($tabAlternance, $tabOffreNonDefini, $optionTri);
            }
        }
        else {
            if (!isset($optionTri)) {
                return array_merge(array_merge($tabStages, $tabAlternance), $tabOffreNonDefini);
            } else {
                return self::sort(self::sort($tabStages, $tabOffreNonDefini, $optionTri), $tabAlternance, $optionTri);
            }

        }
    }

    public function search(string $keywords = null,string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null, string $BUT2 = null, string $BUT3 = null): array{
        date_default_timezone_set('Europe/Paris');
        $nomTable = $this->getNomTable();
        $nomClePrimaire = $this->getNomClePrimaire();
        $values = array();
        $sql = "SELECT *
                FROM $nomTable JOIN ExperienceProfessionnel e ON $nomTable.$nomClePrimaire = e.idExperienceProfessionnel WHERE numEtudiant IS NULL ";
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
            $values["keywordsTag"] = $keywords;
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

    public static function offreMoins7jours(): array
    {
        // Renvoi dans un tableau les offres publiées il y a moins de 7 jours
        $objects = array();
        $sql = "SELECT idExperienceProfessionnel FROM ExperienceProfessionnel WHERE datePublication <= CURDATE() and datePublication >= CURDATE()-7";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $pdoStatement->execute();
        $requestStatement = $pdoStatement->fetchAll();
        foreach ($requestStatement as $objectFormatTableau) {
            // Convertir la valeur en chaîne de caractères (supposons que la colonne s'appelle "nom")
            $nomEnChaine = strval($objectFormatTableau['idExperienceProfessionnel']);

            // Créer un nouvel objet avec la valeur convertie
            $objects[] = (new StageRepository())->get($nomEnChaine);

        }
        foreach ($requestStatement as $objectFormatTableau) {
            // Convertir la valeur en chaîne de caractères (supposons que la colonne s'appelle "nom")
            $nomEnChaine = strval($objectFormatTableau['idExperienceProfessionnel']);

            // Créer un nouvel objet avec la valeur convertie
            $objects[] = (new AlternanceRepository())->get($nomEnChaine);
        }
        foreach ($requestStatement as $objectFormatTableau) {
            // Convertir la valeur en chaîne de caractères (supposons que la colonne s'appelle "nom")
            $nomEnChaine = strval($objectFormatTableau['idExperienceProfessionnel']);

            // Créer un nouvel objet avec la valeur convertie
            $objects[] = (new OffreNonDefiniRepository())->get($nomEnChaine);


        }

        return $objects;
    }

    public static function getDatePublication(ExperienceProfessionnel $expPro): string
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

}