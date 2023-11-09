<div class="header">
     <h2>Liste des Entreprises</h2>
</div>
<?php $action="afficherListeEntrepriseEnAttenteFiltree";
$controller="Entreprise";
require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
<div class="VBox">
    <?php
    foreach ($listEntreprises as $entreprise){
        require __DIR__."/entrepriseLine.php";
    }
    ?>
</div>