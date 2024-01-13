<link rel="stylesheet" href="assets/css/panelAdmin.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/offer.css">

<script src="assets/javascript/popUpDelete.js"></script>

<div class="HBox" id="panel">
    <div class="container" id="option">
        <div class="HBox">
            <img src="assets/images/trombettoni.jpg" id="adminPP" alt="Photo de profil de l'admin">
            <label id="adminName">Gilles Trombettoni</label>
            <div id="adminBackground"></div>
        </div>
        <div class="VBox">
        <a href="frontController.php?controller=PanelAdmin&action=PanelListeEtudiants" class="button<?=$_GET["action"]=="PanelListeEtudiants" || $_GET["action"]=="panelListeEtudiants" ? " active" : ""?>" id="studentListButton"><span>Liste des Étudiants</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelListeEntreprises" class="button<?=$_GET["action"]=="panelListeEntreprises" ? " active" : ""?>" id="companyListButton"><span>Liste des Entreprises</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelListeOffres" class="button<?=$_GET["action"]=="panelListeOffres" ? " active" : ""?>" id="offerListButton"><span>Liste des Offres</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelImportPstage" class="button<?=$_GET["action"]=="panelImportPstage" ? " active" : ""?>" id="importDataButton"><span>Importation des données</span></a>
        <a href="frontController.php?controller=PanelAdmin&action=panelStatistique" class="button<?=$_GET["action"]=="panelImportPstage" ? " active" : ""?>" id="statButton"><span>Statistiques</span></a>
        </div>
        </div>
    <div class="container" id="mainContent">
        <?php
        require __DIR__ . "/../../$adminPanelView";
        ?>
    </div>
</div>
