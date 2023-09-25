<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription Entreprise</title>
    <link rel="stylesheet" href="assets/css/connect.css">
</head>

<body>
    <div class="container">
        <form method="post" action="login.php">
            <legend>Inscription Entreprise</legend>
            <p>
                <label for="nom">Nom de l'entreprise</label>
                <input type="text" name="nom" id="nom" required placeholder="Nom de votre entreprise" />
            </p>
            <p>
                <label for="siret">N° de Siret</label>
                <input type="text" name="siret" id="siret" required placeholder="N° de Siret" />
            </p>
            <p>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required placeholder="votre.email@entreprise.com" />
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <div class="password-input">
                    <input type="password" name="password" id="password" required placeholder="mot de passe" />
                    <div class="password-strength">
                        <div class="strength-bar"></div>
                    </div>
                    <p id="passwordHelp">Entrez un mot de passe</p>
                    <button type="button" id="showPassword"><img id="showPasswordIconRegister" src="assets/images/eye-icon.png" alt="O" /></button>
                </div>
            </p>

            <p>
                <input type="submit" value="Inscription" />
            </p>
        </form>
        <div class="create-account">
            <p>Vous avez déjà un compte? <a href="frontController.php?action=connect">Connectez-vous</a></p>
        </div>
    </div>
    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('showPassword');
        const strengthBar = document.querySelector('.strength-bar');
        const passwordHelp = document.getElementById('passwordHelp');

        showPasswordButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });

        const updateStrengthBar = () => {
            const password = passwordInput.value;
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            const requirementsMet = [
                password.length >= 8,
                /[A-Z]/.test(password),
                /[a-z]/.test(password),
                /\d/.test(password),
                /[@$!%*?&]/.test(password),
            ];

            // Update the strength bar based on the number of requirements met
            const requirementsMetCount = requirementsMet.reduce((count, met) => count + (met ? 1 : 0), 0);
            const barWidth = (requirementsMetCount / requirementsMet.length) * 100;
            strengthBar.style.width = barWidth + '%';
            // Update the tooltip color and text
            if (password.length === 0) {
                passwordHelp.innerHTML = 'Entrez un mot de passe';
                strengthBar.style.backgroundColor = 'transparent';
            } else if (barWidth === 100) {
                passwordHelp.innerHTML = 'Mot de passe fort';
                strengthBar.style.backgroundColor = 'var(--green)';
            } else if (barWidth >= 75) {
                passwordHelp.innerHTML = 'Mot de passe moyen';
                strengthBar.style.backgroundColor = 'var(--yellow)';
            } else if (barWidth >= 50) {
                passwordHelp.innerHTML = 'Mot de passe faible';
                strengthBar.style.backgroundColor = 'var(--orange)';
            } else {
                passwordHelp.innerHTML = 'Mot de passe très faible';
                strengthBar.style.backgroundColor = 'var(--rougeUM)';
            }
        };

        passwordInput.addEventListener('input', updateStrengthBar);
    </script>
</body>

</html>
