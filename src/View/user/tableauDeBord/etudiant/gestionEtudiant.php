<h1>Gestion</h1>
<div class="VBox">
    <div>
        <p>C'est ici que vous pouvez avoir accès aux différentes fonctionnalités du site vous aidant à faire le lien avec votre
            administration </p>
        <a class="button">Créer ma convention de stage</a>
        <a href="frontController.php?controller=Convention&action=afficherFormulaire&idEtudiant=<?php echo $user->getNumEtudiant();?>" class="button">Editer ma Convention</a>
        <a class="button">Valider la convention</a>
    </div>
    <div id="popUpConfirmation" class="subContainer">
        <a id="popUpConfirmationClose"><img src="assets/images/close-icon.png" id="closeIcon" alt="Close"></a>
        <div id="popUpConfirmationContent">
            <p>Êtes-vous sûr de vouloir supprimer cette offre ?</p>
            <div class="HBox">
                <a class="button popUpConfirmationButton" id="popUpDeleteNo">Non</a>
                <a class="button popUpConfirmationButton" id="popUpConfirmationYes"
                   href="">Oui</a>
            </div>
        </div>
    </div>
</div>
