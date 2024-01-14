<?php

namespace App\SAE\Model\DataObject;

/**
 * Classe représentant une expérience professionnelle non définie.
 *
 * @package App\SAE\Model\DataObject
 */
class OffreNonDefini extends ExperienceProfessionnel
{
    /**
     * Constructeur de la classe OffreNonDefini.
     *
     * @param string $sujet Le sujet de l'expérience professionnelle.
     * @param string $thematique La thématique de l'expérience professionnelle.
     * @param string $taches Les tâches de l'expérience professionnelle.
     * @param string $niveau Le niveau de l'expérience professionnelle.
     * @param string $codePostal Le code postal de l'expérience professionnelle.
     * @param string $adresse L'adresse de l'expérience professionnelle.
     * @param string $dateDebut La date de début de l'expérience professionnelle.
     * @param string $dateFin La date de fin de l'expérience professionnelle.
     * @param string $siret Le numéro SIRET associé à l'expérience professionnelle.
     */
    public function __construct(string $sujet, string $thematique, string $taches, string $niveau, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret)
    {
        parent::__construct($sujet, $thematique, $taches, $niveau, $codePostal, $adresse, $dateDebut, $dateFin, $siret);
    }

    /**
     * Formate les données de l'expérience professionnelle non définie sous forme de tableau.
     *
     * @return array Les données formatées.
     */
    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), array()); // test
    }

    /**
     * Obtient le nom de l'expérience professionnelle non définie.
     *
     * @return string Le nom de l'expérience professionnelle non définie.
     */
    public function getNomExperienceProfessionnel(): string
    {
        return "OffreNonDefini";
    }

    /**
     * Obtient les méthodes setters associées aux propriétés de l'expérience professionnelle non définie.
     *
     * @return array Les méthodes setters.
     */
    public function getSetters(): array
    {
        return array_merge(parent::getSetters(), array());
    }
}
