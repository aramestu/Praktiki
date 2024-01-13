<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Departement représente un département.
 *
 * @package App\SAE\Model\DataObject
 */
class Departement extends AbstractDataObject {

    /**
     * @var string Code du département.
     */
    private string $codeDepartement;

    /**
     * @var string Nom du département.
     */
    private string $nomDepartement;

    /**
     * Constructeur de la classe Departement.
     *
     * @param string $nomDepartement Nom du département.
     */
    public function __construct(string $nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;
    }

    /**
     * Obtient le code du département.
     *
     * @return string Code du département.
     */
    public function getCodeDepartement(): string
    {
        return $this->codeDepartement;
    }

    /**
     * Définit le code du département.
     *
     * @param string $codeDepartement Nouveau code du département.
     */
    public function setCodeDepartement(string $codeDepartement): void
    {
        $this->codeDepartement = $codeDepartement;
    }

    /**
     * Obtient le nom du département.
     *
     * @return string Nom du département.
     */
    public function getNomDepartement(): string
    {
        return $this->nomDepartement;
    }

    /**
     * Définit le nom du département.
     *
     * @param string $nomDepartement Nouveau nom du département.
     */
    public function setNomDepartement(string $nomDepartement): void
    {
        $this->nomDepartement = $nomDepartement;
    }

    /**
     * Formate les données du département sous forme de tableau.
     *
     * @return array Tableau contenant les données du département.
     */
    public function formatTableau(): array
    {
        return array(
            "codeDepartementTag" => $this->codeDepartement,
            "nomDepartementTag" => $this->nomDepartement
        );
    }

    /**
     * Obtient la liste des méthodes de type setter disponibles pour la classe Departement.
     *
     * @return array Liste des méthodes de type setter.
     */
    public function getSetters(): array {
        return [
            "codeDepartement" => "setCodeDepartement",
            "nomDepartement" => "setNomDepartement",
        ];
    }
}
