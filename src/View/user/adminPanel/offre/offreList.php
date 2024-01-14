<?php
use App\SAE\Controller\ControllerExpPro;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Controller\ControllerEntreprise;
?>

<div class="HBox">
    <div id="titleOffre" class="title"><span>Liste des Offres</span></div>
    <?php $action="panelListeOffres";
    $controller="PanelAdmin";
    require_once __DIR__ . '/../../../utilitaire/searchBar.php';?>
</div>

<div class="HBox" id="statBox">
    <div id="statOffreTotal" title="Nombre total d'offres"><span><?= $nbOffre?></span></div>
    <div id="statStage" title="Nombre de stages"><span><?= $nbStage?></span></div>
    <div id="statAlternance" title="Nombre d'alternances"><span><?= $nbAlternance?></span></div>
    <div id="statNonDefini" title="Nombre d'offres non défini"><span><?= $nbNonDefini?></span></div>
</div>

<div class="columnName">
    <div id="columnFirst" class="HBox containerDebutLine">
        <label>Type</label>
        <label class="lineSujetOffre">Sujet offre</label>
    </div>
    <label class="lineEntrepriseOffre">Entreprise</label>
    <label class="lineDateOffre">Date publication</label>
</div>

<div class="VBox" id="dynamicList">
    <?php
    foreach ($listOffres as $offre){
        require __DIR__."/offreLine.php";
    }
    ?>
</div>

<div id="popUpDelete" class="subContainer">
    <a id="popUpDeleteClose"><img src="assets/images/close-icon.png" id="closeIcon" alt="Close"></a>
    <div id="popUpDeleteContent">
        <p>Êtes-vous sûr de vouloir supprimer cette offre ?</p>
        <div class="HBox">
            <a class="button popUpDeleteButton" id="popUpDeleteNo">Non</a>
            <a class="button popUpDeleteButton" id="popUpDeleteYes" href="frontController.php?controller=ExpPro&action=supprimerOffre&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel()) ?>">Oui</a>
        </div>
    </div>
</div>