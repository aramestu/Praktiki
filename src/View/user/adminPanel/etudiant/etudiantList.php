<?php
use App\SAE\Model\Repository\EtudiantRepository;
?>

<div class="HBox">
    <div id="titleEtudiant" class="title"><span>Liste des Etudiants</span></div>
    <?php $action="panelListeEtudiants";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="HBox" id="statBox">
    <div id="statTotal"><span><?php echo (new EtudiantRepository())->count()?></span></div>
    <div id="statValide"><span><?php echo (new EtudiantRepository())->getNbEtudiantExpProValide()?></span></div>
    <div id="statInter"><span><?php echo (new EtudiantRepository())->getNbEtudiantExpProValideSansConvention()?></span></div>
    <div id="statBad"><span><?php echo (new EtudiantRepository())->getNbEtudiantExpProNonValide()?></span></div>
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