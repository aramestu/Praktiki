<!DOCTYPE html>
<html>

<body>
<div class="container">
<form method="get" action="../web/frontController.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text" placeholder="256AB34" name="immat" id="immat_id" required/>
        </p>
        <p>
            <label for="marque_id">Marque</label> :
            <input type="text" placeholder="renault" name="marque" id="marque_id" required/>
        </p>
        <p>
            <label for="couleur_id">Couleur</label> :
            <input type="text" placeholder="bleu" name="couleur" id="couleur_id" required/>
        </p>
        <p>
            <label for="nbSieges_id">Nombre de places</label> :
            <input type="number" placeholder="5" name="nbSieges" id="nbSieges_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='action' value='connected'>
        </p>
    </fieldset>
</form>
</div>
</body>
</html>