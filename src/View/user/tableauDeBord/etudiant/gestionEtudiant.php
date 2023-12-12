<script src="assets/javascript/popUpConfirmation.js"></script>
<h1>Gestion</h1>
<div class="VBox">
    <div>
        <p>C'est ici que vous pouvez avoir accès aux différentes fonctionnalités du site vous aidant à faire le lien avec votre
            administration </p>
        <a class="button">Créer ma convention de stage</a>
        <a href="frontController.php?controller=Convention&action=afficherFormulaire&idEtudiant=<?php echo $user->getNumEtudiant();?>" class="button">Editer ma Convention</a>
        <a id="confirmationButtonOrigin" class="button">Valider la convention</a>
    </div>
</div>