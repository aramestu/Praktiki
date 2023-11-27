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
            <p>Nom : <?php echo $user->getNomEnseignant();?></p>
            <p>Prenom : <?php echo $user->getPrenomEnseignant();?></p>
            <p>Adresse Mail : <?php echo $user->getMailEnseignant();?></p>
            <a href="frontController.php?controller=Enseignant&action=afficherMettreAJourEnseignant" class="button">Modifier mes infos</a>
            <?php
            if($user->isEstAdmin()){
                echo'<a href="frontController.php?controller=PanelAdmin&action=panelListeEtudiants" class="button">Panel admin</a>
            ';
            }?>
        </div>
        <div class="VBox" id="recentOffers">
            <h2>Offres récentes</h2>
            <div id="tableOffer">
                <?php \App\SAE\Controller\ControllerExpPro::getExpProRecent(); ?>
            </div>
        </div>
    </div>
</div>
