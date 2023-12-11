<h1>Bienvenue <?= $user->getNomEntreprise()?></h1>
<div class="accueilContainer">
    <div class="infoUtilisateur">
        <h2>Informations personnelles:</h2>
        <p>Siret : <?php echo $user->getSiret();?></p>
        <p>Nom : <?php echo $user->getNomEntreprise();?></p>
        <p>Effectif : <?php echo $user->getEffectifEntreprise();?></p>
        <p>Adresse : 123 rue de la paix</p>
        <p>Code postal : <?php echo $user->getCodePostalEntreprise();?></p>
        <p>Téléphone : <?php echo $user->getTelephoneEntreprise();?></p>
        <p>Couriel : <?php echo $user->getEmailEntreprise();?></p>
        <p>Site web : <?php echo $user->getSiteWebEntreprise();?></p>
    </div>
    <div id="recentOffers">
        <h2>Vos offres</h2>
        <div id="tableOffer">
            <?php \App\SAE\Controller\ControllerExpPro::getExpProEntreprise(); ?>
        </div>
    </div>
</div>