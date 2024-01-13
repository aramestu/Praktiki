<script src="assets/javascript/popUpConfirmation.js"></script>
<h1>Gestion</h1>
<div class="VBox">
    <div>
        <h3 class="bold">C'est ici que vous pouvez avoir accès aux différentes fonctionnalités du site vous aidant à faire le lien avec votre
            administration.</h3>
        <?php if ($convention == null && !$alternant) {echo '<a href="frontController.php?controller=Convention&action=creerFormulaire&idEtudiant=' . $user->getNumEtudiant() . '" class="button">Créer ma convention de stage</a>';}
        else{
            echo '<h3 class="bold"> Mais il semblerait que vous ayez déjà votre alternance :)</h3>';
        }?>
        <?php
        if ($convention != null) {
            echo '<a href="frontController.php?controller=Convention&action=afficherFormulaire&idEtudiant=' . $user->getNumEtudiant() . '" class="button">Editer ma Convention</a>';
            if (!$convention->getEstFini()) {
                echo '<a id="confirmationButtonOrigin" class="button">Soumettre ma convention à l\'administration</a>';
            }
            echo "<br>";
            if ($convention->getEstValideeAdmin() && $convention->getEstValideeSecretariat()) {
                echo "<p class='italic'>Votre convention a été validée! Elle peut être retranscrite sur PStage.</p>";
            }
            else if ($convention->getRaisonRefus() != "") {
                echo "<p class='italic'>Votre convention a été refusée.</p>";
                echo "<p class='italic'>Raison : " . $convention->getRaisonRefus() . "</p>";
            }
            else if ($convention->getEstFini()) {
                echo "<p class='italic'>Votre convention a été envoyée, veuillez attendre sa validation ou non.</p>";
            }
        }
        ?>
    </div>
</div>
