document.addEventListener('DOMContentLoaded', function () {
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
