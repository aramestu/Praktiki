<?php
use App\SAE\Lib\ConversionMajuscule;
?>

<link rel="stylesheet" href="assets/css/tableauDeBord.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>

<div class="TDB">
    <div class="sidebar container">
        <h2><?php echo $user->getPrenomEtudiant()?> <?=ConversionMajuscule::convertirEnMajuscules($user->getNomEtudiant())?></h2>
        <a id="accueilButton" class="button<?= !isset($_GET["tdbAction"]) ? " active" : ""?>" href="frontController.php?action=displayTDB&controller=TDB">Accueil</a>
        <a id="infoButton" class="button<?= isset($_GET["tdbAction"]) && $_GET["tdbAction"]=="info" ? " active" : ""?>" href="frontController.php?action=displayTDB&controller=TDB&tdbAction=info">Mes Informations</a>
        <a id="stageButton" class="button<?= isset($_GET["tdbAction"]) && $_GET["tdbAction"]=="gestion" ? " active" : ""?>" href="frontController.php?action=displayTDB&controller=TDB&tdbAction=gestion">Mon Stage/Alternance</a>
    </div>

    <div class="content container">
        <?php
        require __DIR__ . "/../../$TDBView";
        ?>
    </div>
</div>
<div id="popUpConfirmation" class="subContainer">
    <a id="popUpConfirmationClose"><img src="assets/images/close-icon.png" id="closeIcon" alt="Close"></a>
    <div id="popUpConfirmationContent">
        <p>Voulez vous envoyer votre convention ? Vous ne pourrez plus la modifier par la suite</p>
        <div class="HBox">
            <a class="button popUpConfirmationButton" id="popUpConfirmationNo">Non</a>
            <a class="button popUpConfirmationButton" id="popUpConfirmationYes"
               href="frontController.php?action=displayTDB&controller=TDB&tdbAction=envoyerConvention">Oui</a>
        </div>
    </div>
</div>
