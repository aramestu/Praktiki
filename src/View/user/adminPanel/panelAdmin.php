<link rel="stylesheet" href="assets/css/panelAdmin.css">
<link rel="stylesheet" href="assets/css/button.css">

<div class="HBox" id="panel">
    <div class="container" id="option">
        <div class="HBox">
            <img src="assets/images/trombettoni.jpg" id="adminPP" alt="Photo de profil de l'admin">
            <label id="adminName">Gilles Trombettoni</label>
            <div id="adminBackground"></div>
        </div>
        <a href="frontController.php?controller=PanelAdmin&action=PanelListeEtudiants" class="button"><div class="HBox"><img src="assets/images/etudiant-icon.png">Liste des Étudiants</div></a>
        <a href="frontController.php?action=panelListeEntreprises&controller=PanelAdmin" class="button"><div class="HBox"><img src="assets/images/company-icon.png">Liste des Entreprise</div></a>
        <a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="button"><div class="HBox"><img src="assets/images/offre-icon.png">Liste des offres</div></a>
        <a href="frontController.php?action=import" class="button"><div class="HBox"><img src="assets/images/upload-icon.png">Importation des données</div></a>
    </div>
    <div class="container" id="placeholder">
        <?php
        require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
