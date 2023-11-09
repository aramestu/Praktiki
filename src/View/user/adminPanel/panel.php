<link rel="stylesheet" href="assets/css/panel.css">
<link rel="stylesheet" href="assets/css/button.css">

<p><b>Bienvenue Mr. Trombettoni</b></p>
<div class="HBox" id="panel">
    <div class="container" id="option">
        <!--TODO: corriger prb heritage button-->
        <a href="frontController.php?controller=PanelAdmin&action=PanelEtudiants">
            <button type="button" class="btn btn-primary">Liste des étudiants</button>
        </a>
        <a href="">
            <button type="button" class="btn btn-primary">Liste des offres en Attentes</button>
        </a>
        <a href="frontController.php?action=panelEntreprises&controller=PanelAdmin">
            <button type="button" class="btn btn-primary">Liste des entreprises en Attentes</button>
        </a>
        <a href="frontController.php?action=getExpProByDefault&controller=ExpPro">
            <button type="button" class="btn btn-primary">Liste des offres</button>
        </a>
        <a href="frontController.php?action=panelListeEntreprises&controller=PanelAdmin">
            <button type="button" class="btn btn-primary">Liste des Entreprise</button>
        </a>
        <a href="frontController.php?action=import">
            <button type="button" class="btn btn-primary">Importation des données</button>
        </a>
    </div>
    <div class="container" id="placeholder">
        <?php
            require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
