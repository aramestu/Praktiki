<link rel="stylesheet" href="assets/css/panelAdmin.css" type="text/css"/>

<div id="containerListeEntreprise">
    <div class="columnName">
        <div id="columnFirst" class="HBox containerDebutLine">
            <div>Etat</div>
            <label class="lineNomEntreprise">Nom Entreprise</label>
        </div>
        <label id="columnCodePostal" class="lineCodePostalEntreprise">CodePostal</label>
        <label class="lineTelephoneEntreprise">Téléphone</label>
        <label class="lineSiteWebEntreprise">Site web</label>
    </div>
    <div class="VBox" id="dynamicList">
        <?php
        foreach ($listEntreprises as $entreprise) {
            require __DIR__ . "/ligneEntreprise.php";
        }
        ?>
    </div>
</div>