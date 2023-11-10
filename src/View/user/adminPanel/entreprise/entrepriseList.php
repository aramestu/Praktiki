<div class="header">
     <h2>Liste des Entreprises</h2>
</div>
<?php $action="afficherListeEntrepriseEnAttenteFiltree";
$controller="Entreprise";
require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
<div class="columnName">
    <div class="HBox containerEtatNomEntreprise">
        <div>Etat</div>
        <label class="lineNomEntreprise">Nom Entreprise</label>
    </div>
    <label class="lineCodePostalEntreprise">CodePostal</label>
    <label class="lineTelephoneEntreprise">Téléphone</label>
    <label class="lineSiteWebEntreprise">Site web</label>
</div>
<div class="VBox">
    <?php
    foreach ($listEntreprises as $entreprise){
        require __DIR__."/entrepriseLine.php";
    }
    ?>
</div>