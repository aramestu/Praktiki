<div class="container">
    <h2>Modifier le message</h2>
    <form action="frontController.php?controller=Annotation&action=modifierAnnotation" method="post">
        <label>
            <textarea name="message" rows="15" cols="50" required><?php echo htmlspecialchars($annotation->getContenu());?></textarea>
        </label>
        <input type="hidden" name="siret" value="<?php echo htmlspecialchars($siret);?>">
        <input type="hidden" name="idAnnotation" value="<?php echo htmlspecialchars($annotation->getIdAnnotation());?>">
        <input type="submit" value="Envoyer">
    </form>
</div>
