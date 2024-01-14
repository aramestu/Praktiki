document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer l'affichage d'une fenêtre de confirmation pop-up. Lorsqu'un utilisateur clique sur le bouton de confirmation, une fenêtre pop-up apparaît avec un effet de flou en arrière-plan. L'utilisateur a alors la possibilité de fermer la fenêtre pop-up en cliquant sur le bouton 'Non', sur l'icône de fermeture ou en dehors de la fenêtre pop-up. Dans tous ces cas, la fenêtre pop-up est fermée et l'effet de flou en arrière-plan est supprimé.
    */
    const confirmationButtonOrigin = document.getElementById('confirmationButtonOrigin');
    const transitionOverlay = document.getElementById('transition-overlay');
    const popUpConfirmation = document.getElementById('popUpConfirmation');
    const noButton = document.getElementById('popUpConfirmationNo');
    const closeIcon = document.getElementById('closeIcon');

    confirmationButtonOrigin.addEventListener('click', function () {
        transitionOverlay.style.backdropFilter = 'blur(10px)';
        transitionOverlay.style.zIndex = '15';
        popUpConfirmation.style.zIndex = '16';
        popUpConfirmation.style.opacity = '1';
    });

    function closePopUpConfirmation() {
        popUpConfirmation.style.opacity = '0';
        popUpConfirmation.style.zIndex = '-1';
        transitionOverlay.style.zIndex = '-1';
        transitionOverlay.style.backdropFilter = 'blur(0px)';
    }

    noButton.addEventListener('click', function () {
        closePopUpConfirmation();
    });

    transitionOverlay.addEventListener('click', function () {
        closePopUpConfirmation();
    });

    closeIcon.addEventListener('click', function () {
        closePopUpConfirmation();
    });
});
