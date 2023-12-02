<?php
use App\SAE\Controller\ControllerEntreprise;
?>

<div class="HBox">
    <div id="titleEntreprise" class="title"><span>Liste des Entreprises</span></div>
    <?php $action="panelListeEntreprises";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="HBox" id="statBox">
    <div id="statTotal"><span><?php echo (new ControllerEntreprise())->getNbEntrepriseTotal()?></span></div>
    <div id="statValide"><span><?php echo (new ControllerEntreprise())->getNbEntrepriseValide()?></span></div>
    <div id="statInter"><span><?php echo (new ControllerEntreprise())->getNbEntrepriseEnAttente()?></span></div>
    <div id="statBad"><span><?php echo (new ControllerEntreprise())->getNbEntrepriseRefuse()?></span></div>
</div>

<div class="columnName">
    <div id="columnFirst" class="HBox containerDebutLine">
        <div>Etat</div>
        <label class="lineNomEntreprise">Nom Entreprise</label>
    </div>
    <label id="columnCodePostal" class="lineCodePostalEntreprise">CodePostal</label>
    <label class="lineTelephoneEntreprise">Téléphone</label>
    <label class="lineSiteWebEntreprise">Site web</label>
</div>
<div class="VBox">
    <?php
    foreach ($listEntreprises as $entreprise){
        require __DIR__."/entrepriseLine.php";
    }
    ?>
</div>