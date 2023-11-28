<link rel="stylesheet" href="assets/css/panelAdmin.css">
<link rel="stylesheet" href="assets/css/button.css">

<div class="HBox" id="panel">
    <div class="container" id="option">
        <div class="HBox">
            <img src="assets/images/trombettoni.jpg" id="adminPP" alt="Photo de profil de l'admin">
            <label id="adminName">Gilles Trombettoni</label>
            <div id="adminBackground"></div>
        </div>
        <a href="frontController.php?controller=PanelAdmin&action=PanelListeEtudiants" class="button" id="studentListButton"><span>Liste des Étudiants</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelListeEntreprises" class="button" id="companyListButton"><span>Liste des Entreprise</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelListeOffres" class="button" id="offerListButton"><span>Liste des offres</span></a>
        <a href="frontController.php?action=import" class="button" id="importDataButton"><span>Importation des données</span></a>
    </div>
    <div class="container" id="placeholder">
        <?php
        require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
