document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPassword');

    showPasswordButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});