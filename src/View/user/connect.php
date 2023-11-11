<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <link rel="stylesheet" href="assets/css/connect.css">

    <script src="assets/javascript/showPassword.js"></script>
</head>

<body>
<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Connexion</h2>
        <p>
            <label for="username">Siret</label>
            <input type="text" name="username" id="username" required placeholder="01234567891011">
        <p>
            <label for="password">Mot de passe</label>
        <div class="password-input">
            <input type="password" name="password" id="password" required placeholder="mot de passe">
            <button type="button" id="showPassword"><img id="showPasswordIconConnect" src="assets/images/eye-icon.png" alt="O"></button>
        </div>
        <p>
            <input type="hidden" name="action" value="connecter">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Connexion">
        </p>
    </form>
    <div class="create-account">
        <p>Vous n'avez pas de compte? <a href="frontController.php?action=createAccount" class="link">Créer un compte</a></p>
    </div>
</div>
</body>

</html>
