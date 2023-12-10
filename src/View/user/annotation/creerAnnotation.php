<div class="container">
    <h2>

    </h2>
    <form action="frontController.php?controller=Annotation&action=enregistrerAnnotation" method="post">
        <label>
            <textarea name="message" rows="15" cols="50" required></textarea>
        </label>
        <input type="hidden" name="siret" value="<?php echo $siret;?>">
        <input type="submit" value="Envoyer">
    </form>
</div>