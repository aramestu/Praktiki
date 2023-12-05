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
        <a class="button" href="frontController.php?action=displayTDB&controller=TDB">Accueil</a>
        <a class="button" href="frontController.php?action=displayTDB&controller=TDB&tdbAction=info">Mes Informations</a>
        <a class="button">Mon Stage/Alternance</a>
    </div>

    <div class="content container">
        <?php
        require __DIR__ . "/../../$TDBView";
        ?>
    </div>
</div>

