<link rel="stylesheet" href="assets/css/maj.css">

<?php
$nom = htmlspecialchars($user->getNomEntreprise());
$effectif = htmlspecialchars($user->getEffectifEntreprise());
$siret = htmlspecialchars($user->getSiret());
$codePostal = htmlspecialchars($user->getCodePostalEntreprise());
$telephone = htmlspecialchars($user->getTelephoneEntreprise());
$mail = htmlspecialchars($user->getMailEntreprise());
$siteWeb = htmlspecialchars($user->getSiteWebEntreprise());
$password = htmlspecialchars($user->getMdpHache());
?>

<div class="containerInfo">
    <form method="post" action="frontController.php?action=displayTDB&controller=TDB&tdbAction=MettreAJour">
        <h2 id="remplaceBaliseLegend">Généralités</h2>
        <div class="column">
            <p>
                <label class="InputAddOn-item" for="siret">Siret :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($siret) ?>" name="siret"
                       id="siret" readonly>
                <label class="InputAddOn-item" for="nom">Nom :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($nom) ?>" name="nom" id="nom"
                       required/>
                <label class="InputAddOn-item" for="email">Email :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($mail) ?>" name="mail"
                       id="email" required>
                <label class="InputAddOn-item" for="telephone">Telephone :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($telephone) ?>" name="telephone"
                       id="telephone" required>
            </p>

        </div>

        <div class="column">
            <p>
                <label class="InputAddOn-item" for="postcode">Code Postal :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($codePostal) ?>" name="postcode"
                       id="postcode" required>
                <label class="InputAddOn-item" for="website">Site Web :</label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($siteWeb) ?>" name="website"
                       id="website" required>
                <label class="InputAddOn-item" for="effectif">Effectif : </label>
                <input class="InputAddOn-field" type="text" value="<?= htmlspecialchars($effectif) ?>" name="effectif"
                       id="effectif" required>
            <div class="forget-password">
                <p><a class="button" href="frontController.php?action=resetPassword">Changer de mot de passe</a></p>
            </div>

        </div>

        <input type="submit" value="Mettre à jour">
    </form>
</div>










