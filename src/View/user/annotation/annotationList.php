<div class="HBox topContainer">
    <?php require_once __DIR__."/../../company/company.php"; ?>
    <?php require_once __DIR__."/creerAnnotation.php"; ?>
</div>

<div class="VBox annotationTable">
    <?php
    $annotations = $listAnnotationPersonne[0];
    $enseignants = $listAnnotationPersonne[1];
    // Je parcours le tableau à l'envers car je les veux du plus récent au plus vieux, (c'est triés du plus vieux au plus jeune par défaut)
    for($i = sizeof($annotations) - 1; $i >= 0; $i--){
        $enseignant = $enseignants[$i];
        $annotation = $annotations[$i];
        require __DIR__."/annotation.php";
    }
    /*foreach ($listAnnotationPersonne as $annotation){
        require __DIR__."/annotation.php";
    }*/
    ?>
</div>