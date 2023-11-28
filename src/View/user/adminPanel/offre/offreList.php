<div class="HBox">
    <div id="title"><div class="HBox"><img src="assets/images/etudiant-icon.png" alt="logo etudiant">Liste des Offres</div></div>
    <?php $action="panelListeOffres";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="columnName">
    <div id="columnFirst" class="HBox containerDebutLine">
        <label>Etat</label>
        <label class="lineNomPrenomEtudiant">NOM Prénom</label>
    </div>
    <label class="lineNumEtudiant">Num Etudiant</label>
    <label class="lineMailUniversitaireEtudidant">Mail</label>
</div>

<div class="VBox">
    <?php
    foreach ($listOffres as $offre){
        require __DIR__."/offreLine.php";
    }
    ?>
</div>