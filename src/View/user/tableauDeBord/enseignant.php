<?php

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\ConversionMajuscule;
?>

<link rel="stylesheet" href="assets/css/tableauDeBord.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>

<div class="TDB">
    <div class="sidebar container">
        <h2><?php echo $user->getPrenomEnseignant()?> <?=ConversionMajuscule::convertirEnMajuscules($user->getNomEnseignant())?></h2>
        <a id="accueilButton" class="button<?= (!isset($_GET["action"]) || $_GET["action"]=="displayTDB") ? " active" : ""?>" href="frontController.php?action=displayTDB&controller=TDB">Accueil</a>
        <a id="infoButton" class="button<?= isset($_GET["tdbAction"]) && $_GET["tdbAction"]=="info" ? " active" : ""?>" href="frontController.php?action=displayTDB&controller=TDB&tdbAction=info">Mes Informations</a>
        <a id="listeEntrepriseButton" class="button <?= isset($_GET["action"]) && $_GET["action"]=="displayTDBensListeEntreprise" ? " active" : ""?>" href="frontController.php?action=displayTDBensListeEntreprise&controller=TDB">Liste Entreprise</a>
        <?php
        if(ConnexionUtilisateur::estAdministrateur()){
            echo'
            <a id="adminButton" class="button" href="frontController.php?controller=PanelAdmin&action=panelListeEtudiants">Panel Admin</a>
            ';
        }
        ?>
    </div>

    <div class="content container">
        <?php
        require __DIR__ . "/../../$TDBView";
        ?>
    </div>
</div>

