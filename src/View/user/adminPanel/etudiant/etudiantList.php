<div class="header">
    <h2>Liste des Etudiants</h2>
</div>
<?php $action="panelListeEtudiants";
$controller="PanelAdmin";
require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
<div class="columnName">
    <div class="HBox containerDebutLine">
        <label>Etat</label>
        <label class="lineNomPrenomEtudiant">NOM Prénom</label>
    </div>
    <label class="lineNumEtudiant">Num Etudiant</label>
    <label class="lineMailUniversitaireEtudidant">Mail</label>
</div>

<div class="VBox">
    <?php
    foreach ($listEtudiants as $etudiant){
        require __DIR__."/etudiantLine.php";
    }
    ?>
</div>