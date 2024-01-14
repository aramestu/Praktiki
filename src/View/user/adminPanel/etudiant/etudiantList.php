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
    <div id="statTotal" title="Nombre total d'étudiants"><span><?= $nbEtudiant?></span></div>
    <div id="statValide" title="Nombre d'étudiants ayant un stage avec une convention validée depuis Pstage ou une alternance depuis Studea"><span><?= $nbEtudiantExpProValide ?></span></div>
    <div id="statInter" title="Nombre d'étudiants ayant une convention en cours"><span><?= $nbEtudiantConventionEnCours?></span></div>
    <div id="statBad" title="Nombre d'étudiants n'ayant ni stage ni convention"><span><?= $nbEtudiantNiStageNiAlternance?></span></div>
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