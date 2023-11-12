<div class="header">
    <h2>Liste des Etudiants</h2>
</div>
<?php $action="afficherListeEntrepriseEnAttenteFiltree";
$controller="Entreprise";
require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>

<div class="VBox">
    <?php
    foreach ($listEtudiants as $etudiant){
        require __DIR__."/etudiantLine.php";
    }
    ?>
</div>