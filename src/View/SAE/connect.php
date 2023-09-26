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
        <form method="post" action="login.php">
                <legend>Connexion</legend>
                <p>
                    <label for="username">Email</label>
                    <input type="text" name="username" id="username" required placeholder="rick.astley@roll.com"/>
                </p>
                <p>
                    <label for="password">Mot de passe</label>
                    <div class="password-input">
                        <input type="password" name="password" id="password" required placeholder="mot de passe"/>
                        <button type="button" id="showPassword"><img id="showPasswordIconConnect" src="assets/images/eye-icon.png" alt="O" /></button>
                    </div>
                </p>
                <p>
                    <input type="submit" value="Connexion" />
                </p>
        </form>
        <div class="create-account">
            <p>Vous n'avez pas de compte? <a href="frontController.php?action=createAccount">Créer un compte</a></p>
        </div>
    </div>
</body>

</html>
