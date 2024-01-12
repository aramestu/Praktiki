<?php

namespace App\SAE\Model\Repository;

use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Annotation;

/**
 * Repository pour la gestion des objets "Annotation" en base de données.
 */
class AnnotationRepository extends AbstractRepository {

    /**
     * Enregistre un objet "Annotation" en base de données.
     *
     * @param Annotation|AbstractDataObject $annotation L'objet à enregistrer.
     * @return bool True si l'enregistrement a réussi, false sinon.
     */
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

    /**
     * Récupère toutes les annotations pour un siret donné.
     *
     * @param string $siret Le siret pour lequel récupérer les annotations.
     * @return array Tableau d'objets "Annotation".
     */
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

    /**
     * Récupère les annotations et les enseignants associés pour un siret donné.
     *
     * @param string $siret Le siret pour lequel récupérer les annotations et les enseignants.
     * @return array Tableau contenant deux tableaux : le premier pour les annotations, le deuxième pour les enseignants.
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

    /**
     * Retourne le nom de la table associée à ce repository.
     *
     * @return string Nom de la table.
     */
    protected function getNomTable(): string {
        return "Annotations";
    }

    /**
     * Construit un objet "Annotation" à partir d'un tableau formaté.
     *
     * @param array $annotationFormatTableau Le tableau formaté représentant l'objet.
     * @return AbstractDataObject|Annotation Objet "Annotation" construit.
     */
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

    /**
     * Retourne le nom de la clé primaire de la table associée à ce repository.
     *
     * @return string Nom de la clé primaire.
     */
    protected function getNomClePrimaire(): string {
        return "idAnnotation";
    }

    /**
     * Retourne les noms des colonnes de la table associée à ce repository.
     *
     * @return array Tableau contenant les noms des colonnes.
     */
    protected function getNomsColonnes(): array {
        return array("idAnnotation","siret", "mailEnseignant", "contenu", "dateAnnotation", "estVisibleEtudiant");
    }
}