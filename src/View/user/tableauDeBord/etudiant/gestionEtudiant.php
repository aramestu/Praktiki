<h1>Gestion</h1>
<div class="VBox">
    <div>
        <p>C'est ici que vous pouvez avoir accès aux différentes fonctionnalités du site vous aidant à faire le lien avec votre
            administration </p>
        <a class="button">Créer ma convention de stage</a>
        <a href="frontController.php?controller=Convention&action=afficherFormulaire&idEtudiant=<?php echo $user->getNumEtudiant();?>" class="button">Editer ma Convention</a>
    </div>
</div>
