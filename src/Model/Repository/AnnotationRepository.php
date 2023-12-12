<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Annotation;

class AnnotationRepository extends AbstractRepository {

    public function save(Annotation|AbstractDataObject $annotation): bool {
        try {
            $pdo = Model::getPdo();
            $sql = "INSERT INTO Annotations(siret, mailEnseignant, contenu, estVisibleEtudiant) 
                    VALUES (:siretTag, :mailEnseignantTag, :contenuTag, :estVisibleEtudiantTag)";
            $requestStatement = $pdo->prepare($sql);
            $values = $annotation->formatTableau();
            unset($values["idAnnotationTag"]);
            unset($values["dateAnnotationTag"]);
            $requestStatement->execute($values);
            return true;
        } catch (\PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getBySiret(string $siret) : array
    {
        $sql = "SELECT * FROM Annotations
                WHERE siret = :siretTag";

        $values = [
            "siretTag" => $siret
        ];

        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare($sql);
        $requestStatement->execute($values);

        $objects = [];
        foreach ($requestStatement as $objectFormatTableau) {
            $objects[] = $this->construireDepuisTableau($objectFormatTableau);
        }
        return $objects;
    }

    /* Retourne un tableau contenant 2 tableau. Le 1er est un dataobjet Annotation et l'autre tableau contient des Dataobjet Enseignants
     (c'est triés du plus vieux au plus jeune par défaut)
    */
    public function getAnnotationEtPersonneBySiret(string $siret) : array{
        $sql = "SELECT * FROM Annotations a
                JOIN Enseignants e ON e.mailEnseignant = a.mailEnseignant
                WHERE siret = :siretTag";

        $values = [
            "siretTag" => $siret
        ];

        $pdo = Model::getPdo();
        $requestStatement = $pdo->prepare($sql);
        $requestStatement->execute($values);

        $annotations = [];
        $enseignants = [];
        $rep = new EnseignantRepository();
        foreach ($requestStatement as $objectFormatTableau) {
            $annotations[] = $this->construireDepuisTableau($objectFormatTableau);
            $enseignants[] = $rep->construireDepuisTableau($objectFormatTableau);
        }
        return array($annotations, $enseignants);
    }

    protected function getNomTable(): string {
        return "Annotations";
    }

    public function construireDepuisTableau(array $annotationFormatTableau): AbstractDataObject | Annotation {
        $annotation = new Annotation($annotationFormatTableau["siret"], $annotationFormatTableau["mailEnseignant"], $annotationFormatTableau["contenu"], $annotationFormatTableau["estVisibleEtudiant"]);
        if(isset($annotationFormatTableau["idAnnotation"])){
            $annotation->setIdAnnotation($annotationFormatTableau["idAnnotation"]);
        }
        if(isset($annotationFormatTableau["dateAnnotation"])){
            $annotation->setDateAnnotation($annotationFormatTableau["dateAnnotation"]);
        }
        return $annotation;
    }


    protected function getNomClePrimaire(): string {
        return "idAnnotation";
    }

    protected function getNomsColonnes(): array {
        return array("idAnnotation","siret", "mailEnseignant", "contenu", "dateAnnotation", "estVisibleEtudiant");
    }
}