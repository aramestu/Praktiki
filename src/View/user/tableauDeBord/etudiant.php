<link rel="stylesheet" href="assets/css/tableauDeBord.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>
<?php

?>


<div class="container">
    <div class="HBox">
        <div class="VBox" id="infoEtu">
            <h2>Informations personnelles:</h2>
            <p>Bienvenue</p>
            <p>Numéro étudiant : 123456789</p>
            <p>Adresse : 123 rue de la paix</p>
            <p>Code postal : 34000</p>
            <p>Téléphone : 0123456789</p>
            <p>Courriel :
                <a href="">

                </a>
            </p>
            <a href="frontController.php?controller=Main&action=displayTDBetu" class="button">Modifier mes infos</a>
            <a href="frontController.php?controller=Main&action=displayTDBetu" class="button">Accéder à mes brouillons</a>
        </div>
        <div class="VBox" id="recentOffers">
            <h2>Offres récentes</h2>
            <div id="tableOffer">
                <?php \App\SAE\Controller\ControllerExpPro::getExpProRecent(); ?>
            </div>
        </div>
    </div>
</div>
