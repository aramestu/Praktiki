<?php

namespace App\SAE\Model\Repository;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\AnneeUniversitaire;
use App\SAE\Model\DataObject\Departement;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Inscription;

class EtudiantRepository extends AbstractRepository
{

    public function getEtudiantAvecConventionValidee(): array
    {
        return $this->getEtudiantConventionValide(true,true);
    }

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

    public function etudiantAStage(Etudiant $etudiant): bool{
        return $this->conventionEtudiantEstValide($etudiant);
    }

    public function etudiantAAlternance(Etudiant $etudiant): bool{ //TODO : refaire quand l'appartenance à une alternance sera implémentée
        return false;
    }

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

    public function construireDepuisTableau(array $EtudiantFormatTableau): Etudiant
    {
        $etudiant = new Etudiant($EtudiantFormatTableau["numEtudiant"], $EtudiantFormatTableau["prenomEtudiant"], $EtudiantFormatTableau["nomEtudiant"],
            $EtudiantFormatTableau["mailPersoEtudiant"], $EtudiantFormatTableau["mailUniversitaireEtudiant"], $EtudiantFormatTableau["telephoneEtudiant"],
            $EtudiantFormatTableau["codePostalEtudiant"]);
        return $etudiant;
    }

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

    protected function getNomTable(): string
    {
        return "Etudiants";
    }

    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    protected function getNomsColonnes(): array
    {
        return array("numEtudiant", "nomEtudiant", "prenomEtudiant", "mailPersoEtudiant", "mailUniversitaireEtudiant", "telephoneEtudiant", "codePostalEtudiant");
    }

    //TODO : a revoir quand les conventions seront bien implemanté
    public function getNbEtudiantConventionValide(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e JOIN ConventionsStageEtudiant cse ON e.numEtudiant = cse.numEtudiant JOIN Conventions c ON c.idConvention = cse.idConvention 
                WHERE estValideeAdmin = 1";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    public function getNbEtudiantConventionAttente(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e JOIN ConventionsStageEtudiant cse ON e.numEtudiant = cse.numEtudiant";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }

    public function getNbEtudiantSansConvention(): int{
        $sql = "SELECT COUNT(*) FROM Etudiants e WHERE NOT EXISTS (SELECT * FROM ConventionsStageEtudiant cse WHERE e.numEtudiant = cse.numEtudiant);";
        $requestStatement = Model::getPdo()->prepare($sql);
        $requestStatement->execute();
        return $requestStatement->fetchColumn();
    }
}
