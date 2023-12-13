<link rel="stylesheet" href="assets/css/maj.css">

<?php
$nom=htmlspecialchars($user->getNomEntreprise());
$effectif=htmlspecialchars($user->getEffectifEntreprise());
$siret=htmlspecialchars($user->getSiret());
$codePostal=htmlspecialchars($user->getCodePostalEntreprise());
$Telephone=htmlspecialchars($user->getTelephoneEntreprise());
$mail=htmlspecialchars($user->getEmailEntreprise());
$siteWeb=htmlspecialchars($user->getSiteWebEntreprise());
$password=htmlspecialchars($user->getMdpHache());
?>

    <div class="containerInfo">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Généralités</h2>

        <div class="column">
            <p>
            <label class="InputAddOn-item" for="siret">Siret :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $siret ?> name="siret" id="siret" readonly>
            <label class="InputAddOn-item" for="nom">Nom :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $nom ?> name="nom" id="nom" required/>
            <label class="InputAddOn-item" for="email">Email :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $mail ?> name="mail" id="email" required>
            <label class="InputAddOn-item" for="telephone">Telephone :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $Telephone ?> name="telephone" id="telephone" required>
            <input type="hidden" value="' . $password . '" name="password" id="password" required>
            </p>

        </div>

        <div class="column">
            <p>
            <label class="InputAddOn-item" for="postcode">Code Postal :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $codePostal ?> name="postcode" id="postcode" required>
            <label class="InputAddOn-item" for="website">Site Web :</label> 
            <input class="InputAddOn-field" type="text" value=<?= $siteWeb ?> name="website" id="website" required>
            <label class="InputAddOn-item" for="effectif">Effectif : </label> 
            <input class="InputAddOn-field" type="text" value=<?= $effectif ?> name="effectif" id="effectif" required>
            <div class="forget-password">
                <p><a class="button" href="frontController.php?action=resetPassword">Changer de mot de passe</a> </p>
            </div>

            <input type="hidden" name="action" value="mettreAJour">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Mettre à jour">
        </div>
    </form>
</div>










