<?php

namespace App\SAE\Service;

class ServiceAnnotation extends AbstractService {

    function getRepository(): string {
        return "AnnotationRepository";
    }
}