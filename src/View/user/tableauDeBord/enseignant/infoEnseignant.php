<link rel="stylesheet" href="assets/css/maj.css">

<?php
$mail = htmlspecialchars($user->getMailEnseignant());
$nom = htmlspecialchars($user->getNomEnseignant());
$prenom = htmlspecialchars($user->getPrenomEnseignant());
$admin = htmlspecialchars($user->isEstAdmin());
?>


<div class="containerInfo">
    <form method="post" action="frontController.php?action=displayTDB&controller=TDB&tdbAction=MettreAJour">
        <h2 id="remplaceBaliseLegend">Généralités</h2>

        <div class="column">
            <p>
                <label class="InputAddOn-item" for="mail">Adresse mail :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($mail) ?>" name="mail" id="mail" readonly>
                <label class="InputAddOn-item" for="nom">Nom :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($nom) ?>" name="nom" id="nom" readonly/>

            </p>
        </div>

        <div class="column">
            <p>
                <label class="InputAddOn-item" for="prenom">Prenom : </label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($prenom) ?>" name="prenom" id="prenom" readonly>
                <input type="hidden" value="' . $admin . '" name="admin" id="admin" required>
            </p>
        </div>

        <input type="submit" value="Mettre à jour">
    </form>
</div>









