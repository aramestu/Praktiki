<?php require_once __DIR__."/../../company/company.php"; ?>
<?php require_once __DIR__."/creerAnnotation.php"; ?>
<div class="VBox">
    <?php
    foreach ($listAnnotation as $annotation){
        require __DIR__."/annotation.php";
    }
    ?>
</div>