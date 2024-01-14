<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe AbstractDataObject est une classe abstraite qui définit des méthodes abstraites
 * pour formater l'objet sous forme de tableau et obtenir les setters de l'objet.
 */
abstract class AbstractDataObject
{
    /**
     * Méthode abstraite pour formater l'objet sous forme de tableau.
     *
     * @return array Un tableau représentant l'objet.
     */
    public abstract function formatTableau(): array;

    /**
     * Méthode abstraite pour obtenir les setters de l'objet.
     *
     * @return array Un tableau contenant les noms des setters de l'objet.
     */
    public abstract function getSetters(): array;
}
