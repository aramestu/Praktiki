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
        return $this->getEtudiantAvecConvention(true,true);
    }

    public function getEtudiantAvecConvention(bool $estSigne, bool $estValide): array{
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

    public function conventionEtudiantEstValide(Etudiant $etudiant): bool{
        $sql = "SELECT estValidee FROM Etudiants etu
                JOIN ExperienceProfessionnel exp ON etu.numEtudiant=exp.numEtudiant
                JOIN Stages s ON s.idStage=exp.idExperienceProfessionnel
                JOIN Conventions c ON c.idStage = s.idStage
                WHERE etu.numEtudiant = :numEtudiantTag";
        $request = Model::getPdo()->prepare($sql);
        $values = array(
            "numEtudiantTag" => $etudiant->getNumEtudiant()
        );
        $request->execute($values);
        $result = $request->fetch();
        if($result==false){
            return false;
        }
        elseif($result["estValidee"] == 1){
            return true;
        }else{
            return false;
        }
    }

    public function etudiantAStage(Etudiant $etudiant): bool{
        $sql = "SELECT * FROM Etudiants etu
                JOIN ExperienceProfessionnel exp ON etu.numEtudiant=exp.numEtudiant
                JOIN Stages s ON s.idStage=exp.idExperienceProfessionnel
                WHERE etu.numEtudiant = :numEtudiantTag";
        $request = Model::getPdo()->prepare($sql);
        $values = array(
            "numEtudiantTag" => $etudiant->getNumEtudiant()
        );
        $request->execute($values);
        $result = $request->fetch();
        if($result==false){
            return false;
        }else{
            return true;
        }
    }

    public function etudiantAAlternance(Etudiant $etudiant): bool{
        $sql = "SELECT * FROM Etudiants etu
                JOIN ExperienceProfessionnel exp ON etu.numEtudiant=exp.numEtudiant
                JOIN Alternances a ON a.idAlternance=exp.idExperienceProfessionnel
                WHERE etu.numEtudiant = :numEtudiantTag";
        $request = Model::getPdo()->prepare($sql);
        $values = array(
            "numEtudiantTag" => $etudiant->getNumEtudiant()
        );
        $request->execute($values);
        $result = $request->fetch();
        if($result==false){
            return false;
        }else{
            return true;
        }
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

    protected function construireDepuisTableau(array $EtudiantFormatTableau): Etudiant
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
            "EmailTag" => ConnexionUtilisateur::getLoginUtilisateurConnecte(),
            //nomdutag => valeur, ...
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

    protected function getNomTable(): string
    {
        return "Etudiants";
    }

    protected function getNomClePrimaire(): string
    {
        return "numEtudiant";
    }

    protected function getNomsColonnesCommunes(): array
    {
        return array("numEtudiant", "nomEtudiant", "prenomEtudiant", "mailPersoEtudiant", "mailUniversitaireEtudiant", "telephoneEtudiant", "codePostalEtudiant");
    }
}
