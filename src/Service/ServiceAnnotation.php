<?php

namespace App\SAE\Service;

/**
 * Service pour l'objet de données Annotation.
 */
class ServiceAnnotation extends AbstractService {

    /**
     * Obtient le nom du repository correspondant à Annotation.
     *
     * @return string
     */
    function getRepository(): string {
        return "AnnotationRepository";
    }
}
