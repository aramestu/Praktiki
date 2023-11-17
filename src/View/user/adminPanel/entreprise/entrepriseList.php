<div class="HBox">
    <h2 id="title"><div class="HBox"><img src="assets/images/company-icon.png" alt="logo entreprise">Liste des Entreprises</div></h2>
    <?php $action="panelListeEntreprises";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="columnName">
    <div id="columnFirst" class="HBox containerDebutLine">
        <div>Etat</div>
        <label class="lineNomEntreprise">Nom Entreprise</label>
    </div>
    <label id="columnCodePostal" class="lineCodePostalEntreprise">CodePostal</label>
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