document.addEventListener('DOMContentLoaded', function () {
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

        const requirementsMetCount = requirementsMet.reduce((count, met) => count + (met ? 1 : 0), 0);
        const barWidth = (requirementsMetCount / requirementsMet.length) * 100;
        strengthBar.style.width = barWidth + '%';
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
});