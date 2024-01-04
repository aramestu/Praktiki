<script src="assets/javascript/popUpConfirmation.js"></script>
<h1>Gestion</h1>
<div class="VBox">
    <div>
        <h3 class="bold">C'est ici que vous pouvez avoir accès aux différentes fonctionnalités du site vous aidant à faire le lien avec votre
            administration.</h3>
        <?php if ($convention == null) {echo '<a href="frontController.php?controller=Convention&action=creerFormulaire&idEtudiant=' . $user->getNumEtudiant() . '" class="button">Créer ma convention de stage</a>';}?>
        <?php
        if ($convention != null) {
            echo '<a href="frontController.php?controller=Convention&action=afficherFormulaire&idEtudiant=' . $user->getNumEtudiant() . '" class="button">Editer ma Convention</a>';
            if (!$convention->getEstFini()) {
                echo '<a id="confirmationButtonOrigin" class="button">Soumettre ma convention à l\'administration</a>';
            }
            echo "<br>";
            if ($convention->getEstFini()) {
                echo "<p>Votre convention a été envoyée, veuillez attendre sa validation ou non.</p>";
            }
        }
        ?>
    </div>
</div>
