<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/annotation.css">
<script src="assets/javascript/popUpDelete.js"></script>


<div class="container" id="annotationRelative">
    <a href="frontController.php?controller=Annotation&action=afficherAllAnnotationEntreprise&siret=<?php echo htmlspecialchars($siret) ?>"
       id="backIconAnnotation"><img src="assets/images/back-icon.png" id="deleteIcon" alt="Bin"></a>
    <h2>Modifier le message</h2>
    <br/>
    <form action="frontController.php?controller=Annotation&action=modifierAnnotation" method="post">
        <label>
            <textarea name="message" rows="15" cols="50"
                      required><?php echo htmlspecialchars($annotation->getContenu()); ?></textarea>
        </label>
        <input type="hidden" name="siret" value="<?php echo htmlspecialchars($siret); ?>">
        <input type="hidden" name="idAnnotation"
               value="<?php echo htmlspecialchars($annotation->getIdAnnotation()); ?>">
        <input type="submit" value="Envoyer">
    </form>
</div>
