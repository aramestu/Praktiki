<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/button.css">
<script src="assets/javascript/popUpDelete.js"></script>

<div class="container">
    <div class="HBox">
        <h1> Message de <?php use App\SAE\Lib\ConnexionUtilisateur;

            echo $enseignant->getNomEnseignant() . ' ' . $enseignant->getPrenomEnseignant() . ' le ' . $annotation->getDateAnnotation();?> </h1>
        <?php
            if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
                echo '<a href="frontController.php?controller=Annotation&action=supprimerAnnotation&idAnnotation=' . $annotation->getIdAnnotation() . '" id="deleteButtonOrigin"><img src="assets/images/bin-icon.png" id="deleteIcon" alt="Bin"></a>';
                echo '<a href="frontController.php?controller=Annotation&action=afficherFormulaireModificationAnnotation&idAnnotation=' . $annotation->getIdAnnotation() . '"><img src="assets/images/edit-icon.png" id="editIcon" alt="EditButton"></a>';
            }
        ?>
    </div>
    <p> <?php echo $annotation->getContenu();?> </p>
</div>