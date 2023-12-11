<?php require_once __DIR__."/../../company/company.php"; ?>
<?php require_once __DIR__."/creerAnnotation.php"; ?>

<div class="VBox">
    <?php
    $annotations = $listAnnotationPersonne[0];
    $enseignants = $listAnnotationPersonne[1];
    for($i = 0; $i < sizeof($annotations); $i++){
        $enseignant = $enseignants[$i];
        $annotation = $annotations[$i];
        require __DIR__."/annotation.php";
    }
    /*foreach ($listAnnotationPersonne as $annotation){
        require __DIR__."/annotation.php";
    }*/
    ?>
</div>