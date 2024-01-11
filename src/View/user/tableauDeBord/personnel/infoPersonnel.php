<link rel="stylesheet" href="assets/css/maj.css">

<?php
$mail = htmlspecialchars($user->getMailPersonnel());
$nom = htmlspecialchars($user->getNomPersonnel());
$prenom = htmlspecialchars($user->getPrenomPersonnel());
?>


<div class="containerInfo">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Généralités</h2>

        <div class="column">
            <p>
                <label class="InputAddOn-item" for="mail">Adresse mail :</label>
                <input class="InputAddOn-field" type="text" value=<?= $mail ?> name="mail" id="mail" readonly>
                <label class="InputAddOn-item" for="nom">Nom :</label>
                <input class="InputAddOn-field" type="text" value=<?= $nom ?> name="nom" id="nom" required/>
            </p>
        </div>

        <div class="column">
            <p>
                <label class="InputAddOn-item" for="prenom">Prenom : </label>
                <input class="InputAddOn-field" type="text" value=<?= $prenom ?> name="prenom" id="prenom" required>
            </p>
        </div>

        <input type="hidden" name="action" value="displayTDB">
        <input type="hidden" name="controller" value="TDB">
        <input type="hidden" name="tdbAction" value="mettreAJour">
        <input type="submit" value="Mettre à jour">
    </form>
</div>









