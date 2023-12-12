<div class="container createAnnotation">
    <h2>
        Ecrire un message
    </h2>
    <form action="frontController.php?controller=Annotation&action=enregistrerAnnotation" method="post">
            <textarea name="message" cols="50" maxlength="500" required></textarea>
        <input type="hidden" name="siret" value="<?php echo $siret;?>">
        <input type="submit" value="Envoyer">
    </form>
</div>