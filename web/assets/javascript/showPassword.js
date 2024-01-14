document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer l'affichage et la masquage du mot de passe lors du clic sur le bouton d'affichage du mot de passe. Lorsque l'utilisateur clique sur le bouton, le type de l'input du mot de passe est basculé entre 'password' et 'text', ce qui a pour effet de masquer ou d'afficher le mot de passe.
    */
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