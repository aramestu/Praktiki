<link rel="stylesheet" href="assets/css/panel.css">
<link rel="stylesheet" href="assets/css/button.css">

<p><b>Bienvenue Mr. Trombettoni</b></p>
<div class="HBox" id="panel">
    <div class="container" id="option">
        <!--TODO: corriger prb heritage button-->
        <a href="frontController.php?controller=PanelAdmin&action=PanelEtudiants" class="button">Liste des étudiants</a>
        <a href="" class="button" >Liste des offres en Attentes</a>
        <a href="frontController.php?action=panelEntreprises&controller=PanelAdmin" class="button">Liste des entreprises en Attentes</a>
        <a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="button" >Liste des offres</a>
        <a href="frontController.php?action=panelListeEntreprises&controller=PanelAdmin" class="button">Liste des Entreprise</a>
        <a href="frontController.php?action=import" class="button">Importation des données</a>
    </div>
    <div class="container" id="placeholder">
        <?php
            require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
