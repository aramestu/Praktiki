<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Alternance étend la classe ExperienceProfessionnel et représente une expérience en alternance.
 */
class Alternance extends ExperienceProfessionnel
{
    /**
     * Constructeur de la classe Alternance.
     *
     * @param string $sujet Le sujet de l'alternance.
     * @param string $thematique La thématique de l'alternance.
     * @param string $taches Les tâches effectuées pendant l'alternance.
     * @param string $niveau Le niveau de l'alternance.
     * @param string $codePostal Le code postal de l'entreprise de l'alternance.
     * @param string $adresse L'adresse de l'entreprise de l'alternance.
     * @param string $dateDebut La date de début de l'alternance.
     * @param string $dateFin La date de fin de l'alternance.
     * @param string $siret Le numéro SIRET de l'entreprise de l'alternance.
     */
    public function __construct(string $sujet, string $thematique, string $taches, string $niveau, string $codePostal, string $adresse, string $dateDebut, string $dateFin, string $siret)
    {
        parent::__construct($sujet, $thematique, $taches, $niveau, $codePostal, $adresse, $dateDebut, $dateFin, $siret);
    }

    /**
     * Méthode pour formater l'objet sous forme de tableau.
     *
     * @return array Un tableau représentant l'objet.
     */
    public function formatTableau(): array
    {
        return array_merge(parent::formatTableau(), []); // test
    }

    /**
     * Méthode pour obtenir le nom de l'expérience professionnelle.
     *
     * @return string Le nom de l'expérience professionnelle (Alternance).
     */
    public function getNomExperienceProfessionnel(): string
    {
        return "Alternance";
    }

    /**
     * Méthode pour obtenir les setters de l'objet.
     *
     * @return array Un tableau contenant les noms des setters de l'objet.
     */
    public function getSetters(): array
    {
        return array_merge(parent::getSetters(), []);
    }
}
