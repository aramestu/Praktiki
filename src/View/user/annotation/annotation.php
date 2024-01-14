<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/annotation.css">

<div class="container annotation">
        <h1><?php use App\SAE\Lib\ConnexionUtilisateur;

            echo $enseignant->getNomEnseignant() . ' ' . $enseignant->getPrenomEnseignant();?> </h1>
    <p><?php
            echo $annotation->getDateAnnotation();?></p>
        <?php
            if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $annotation->getMailEnseignant()) {
                echo '<a href="frontController.php?controller=Annotation&action=supprimerAnnotation&idAnnotation=' . $annotation->getIdAnnotation() ."&siret=" . $siret . '" id="deleteButtonOrigin"><img src="assets/images/bin-icon.png" id="deleteIcon" alt="Bin"></a>';
                echo '<a href="frontController.php?controller=Annotation&action=afficherFormulaireModificationAnnotation&idAnnotation=' . $annotation->getIdAnnotation() ."&siret=". $siret .'"><img src="assets/images/edit-icon.png" id="editIcon" alt="EditButton"></a>';
            }
        ?>
    <p class="contentAnnotation"><?php echo $annotation->getContenu(); ?></p>
</div>