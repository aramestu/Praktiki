<link rel="stylesheet" href="assets/css/tableauDeBord.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>



<div class="container">
    <div class="HBox">
        <div class="VBox" id="infoEtu">
            <h2>Informations personnelles:</h2>
            <p>Bienvenue</p>
            <p>Siret : <?php echo $user->getSiret();?></p>
            <p>Nom : <?php echo $user->getNomEntreprise();?></p>
            <p>Effectif : <?php echo $user->getEffectifEntreprise();?></p>
            <p>Adresse : 123 rue de la paix</p>
            <p>Code postal : <?php echo $user->getCodePostalEntreprise();?></p>
            <p>Téléphone : <?php echo $user->getTelephoneEntreprise();?></p>
            <p>Couriel : <?php echo $user->getEmailEntreprise();?></p>
            <p>Site web : <?php echo $user->getSiteWebEntreprise();?></p>
            <a href="frontController.php?controller=Entreprise&action=afficherMettreAJourEntreprise" class="button">Modifier mes infos</a>
            <a href="frontController.php?controller=Main&action=displayTDBetu" class="button">Accéder à mes brouillons</a>
            <a href="frontController.php?controller=ExpPro&action=createOffer" class="button">Créer une offre</a>
        </div>
        <div class="VBox" id="recentOffers">
            <h2>Offres récentes</h2>
            <div id="tableOffer">
                <?php \App\SAE\Controller\ControllerExpPro::getExpProEntreprise(); ?>
            </div>
        </div>
    </div>
</div>
