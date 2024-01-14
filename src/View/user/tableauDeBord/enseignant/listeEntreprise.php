<link rel="stylesheet" href="assets/css/panelAdmin.css" type="text/css"/>

<div id="containerListeEntreprise">
    <div class="columnName">
        <div id="columnFirst" class="HBox containerDebutLine">
            <div>Etat</div>
            <label class="lineNomEntreprise">Nom Entreprise</label>
        </div>
    </div>
    <div class="VBox" id="dynamicList">
        <?php
        foreach ($listEntreprises as $entreprise) {
            require __DIR__ . "/ligneEntreprise.php";
        }
        ?>
    </div>
</div>