<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription Entreprise</title>
    <link rel="stylesheet" href="assets/css/connect.css">

    <script src="assets/javascript/passwordStrength.js"></script>
</head>

<body>
<div class="container">
    <form method="get">
        <legend>Inscription Entreprise</legend>
        <p>
            <label for="nom">Nom de l'entreprise</label>
            <input type="text" name="nom" id="nom" required placeholder="Nom de votre entreprise" autofocus/>
        </p>
        <p>
            <label for="website">Site Web</label>
            <input type="text" name="website" id="website" required placeholder="entreprise.com"/>
        </p>
        <p>
            <label for="siret">N° de Siret</label>
            <input type="text" name="siret" id="siret" required placeholder="N° de Siret"/>
        </p>
        <p>
            <label for="postcode">Code postal</label>
            <input type="number" maxlength="5" name="postcode" id="postcode" required placeholder="34090"/>
        </p>
        <p>
            <label for="effectif">Effectif</label>
            <input type="number" maxlength="5" name="effectif" id="effectif" required placeholder="412"/>
        </p>
        <p>
            <label for="telephone">Telephone</label>
            <input type="text" maxlength="10" minlength="10" name="telephone" id="telephone" required placeholder="0785449977"/>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required placeholder="votre.email@entreprise.com">
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
                                                         alt="O"></button>
        </div>

        <p>
            <input type="hidden" name="action" value="creerDepuisFormulaire"/>
            <input type="hidden" name="controller" value="Entreprise"/>
            <input type="submit" value="Inscription"/>
        </p>
    </form>
    <div class="create-account">
        <p>Vous avez déjà un compte? <a href="frontController.php?action=connect" class="link">Connectez-vous</a></p>
    </div>
</div>
</body>

</html>
