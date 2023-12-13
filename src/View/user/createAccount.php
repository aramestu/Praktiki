<link rel="stylesheet" href="assets/css/connect.css">
<script src="assets/javascript/passwordStrength.js"></script>

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Inscription Entreprise</h2>
        <p>
            <label for="nom">Nom de l'entreprise</label>
            <input type="text" name="nom" id="nom" required placeholder="Nom de votre entreprise" autofocus>
        </p>
        <p>
            <label for="website">Site Web</label>
            <input type="text" name="website" id="website" required placeholder="entreprise.com">
        </p>
        <p>
            <label for="siret">N° de Siret</label>
            <input type="text" name="siret" id="siret" required placeholder="N° de Siret">
        </p>
        <p>
            <label for="postcode">Code postal</label>
            <input type="text" name="postcode" id="postcode" required placeholder="34090">
        </p>
        <p>
            <label for="effectif">Effectif</label>
            <input type="number" min="0" max="99999" name="effectif" id="effectif" required placeholder="412">
        </p>
        <p>
            <label for="telephone">Telephone</label>
            <input type="text" maxlength="10" minlength="10" name="telephone" id="telephone" required placeholder="0785449977">
        </p>
        <p>
            <label for="mail">Email</label>
            <input type="text" name="mail" id="mail" required placeholder="votre.email@entreprise.com">
        </p>
        <p>
            <label for="password">Mot de passe</label>
        <div class="password-input">
            <input type="password" name="password" id="password" required placeholder="mot de passe">
            <div class="password-strength">
                <div class="strength-bar"></div>
            </div>
            <p id="passwordHelp">Entrez un mot de passe</p>
            <button type="button" id="showPassword"><img id="showPasswordIconRegister" src="assets/images/eye-icon.png"
                                                         alt="ShowPassword"></button>
        </div>
        <p>
            <label for="passwordConfirmation">Confirmer mot de passe</label>
            <input type="password" name="confirmPassword" id="passwordConfirmation" required placeholder="Confirmer le mot de passe">
        </p>

        <p>
            <input type="hidden" name="action" value="creerDepuisFormulaire">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Inscription">
        </p>
    </form>
    <div class="create-account">
        <p>Vous avez déjà un compte? <a href="frontController.php?action=connect" class="link">Connectez-vous</a></p>
    </div>
</div>