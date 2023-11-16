<link rel="stylesheet" href="assets/css/panelAdmin.css">
<link rel="stylesheet" href="assets/css/button.css">

<div class="HBox" id="panel">
    <div class="container" id="option">
        <div class="HBox">
            <img src="assets/images/trombettoni.jpg" id="adminPP" alt="Photo de profil de l'admin">
            <label id="adminName">Gilles Trombettoni</label>
            <div id="adminBackground"></div>
        </div>
        <a href="frontController.php?controller=PanelAdmin&action=PanelListeEtudiants" class="button">Liste des
            Étudiants</a>
        <a href="frontController.php?action=panelListeEntreprises&controller=PanelAdmin" class="button">Liste des
            Entreprise</a>
        <a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="button">Liste des offres</a>
        <a href="frontController.php?action=import" class="button">Importation des données</a>
    </div>
    <div class="container" id="placeholder">
        <?php
        require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
