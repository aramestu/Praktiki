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
            <p>Nom : <?php echo $user->getNomEtudiant();?></p>
            <p>Prenom : <?php echo $user->getPrenomEtudiant();?></p>
            <p>Numéro étudiant : <?php echo $user->getNumEtudiant();?></p>
            <p>Adresse : 123 rue de la paix</p>
            <p>Code postal : <?php echo $user->getCodePostalEtudiant();?></p>
            <p>Téléphone : <?php echo $user->getTelephoneEtudiant();?></p>
            <p>Couriel Universitaire: <?php echo $user->getMailUniversitaireEtudiant();?></p>
            <p>Couriel Personnel: <?php echo $user->getMailPersoEtudiant();?></p>

            <a href="frontController.php?controller=etudiant&action=afficherDetailEtudiant" class="button">Modifier mes infos</a>
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
