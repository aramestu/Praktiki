<div class="VBox" id="infoEtu">
    <h2>Informations personnelles:</h2>
    <p>Bienvenue</p>
    <p>Nom : <?php echo $user->getNomEtudiant();?></p>
    <p>Prenom : <?php echo $user->getPrenomEtudiant();?></p>
    <p>Numéro étudiant : <?php echo $user->getNumEtudiant();?></p>
    <p>Adresse : 123 rue de la paix</p>
    <p>Code postal : <?php echo $user->getCodePostalEtudiant();?></p>
    <p>Téléphone : <?php echo $user->getTelephoneEtudiant();?></p>
    <p>Adresse Mail Universitaire: <?php echo $user->getMailUniversitaireEtudiant();?></p>
    <p>Adresse Mail Personnel: <?php echo $user->getMailPersoEtudiant();?></p>
    <a href="frontController.php?controller=Etudiant&action=afficherMettreAJourEtudiant" class="button">Modifier mes infos</a>
    <a href="frontController.php?controller=Main&action=displayTDBetu" class="button">Accéder à mes brouillons</a>
</div>
