<?php

use App\SAE\Controller\ControllerEtudiant;
use App\SAE\Model\Repository\EtudiantRepository;
?>

<div class="HBox">
    <div id="titleEtudiant" class="title"><span>Liste des Etudiants</span></div>
    <?php $action="panelListeEtudiants";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="HBox" id="statBox">
    <div id="statTotal"><span class="tooltip"><?php echo (new EtudiantRepository())->count()?><span class="tooltiptext">Nombre total d'étudiants</span></span></div>
    <div id="statValide"><span class="tooltip"><?php echo (new ControllerEtudiant())->getNbEtudiantExpProValide()?><span class="tooltiptext">Nombre d'étudiants ayant un stage avec une convention validée</span></span></div>
    <div id="statInter"><span class="tooltip"><?php echo (new ControllerEtudiant())->getNbEtudiantExpProValideSansConvention()?><span class="tooltiptext">Nombre d'étudiants ayant une convention en cours</span></span></div>
    <div id="statBad"><span class="tooltip"><?php echo (new ControllerEtudiant())->getNbEtudiantExpProNonValide()?><span class="tooltiptext">Nombre d'étudiants n'ayant ni stage ni convention</span></span></div>
</div>

<div class="columnName">
    <div id="columnFirst" class="HBox containerDebutLine">
        <label>Etat</label>
        <label class="lineNomPrenomEtudiant">NOM Prénom</label>
    </div>
    <label class="lineNumEtudiant">Num Etudiant</label>
    <label class="lineMailUniversitaireEtudidant">Mail</label>
</div>

<div class="VBox" id="dynamicList">
    <?php
    foreach ($listEtudiants as $etudiant){
        require __DIR__."/etudiantLine.php";
    }
    ?>
</div>