document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer l'affichage d'une fenêtre de confirmation de suppression pop-up. Lorsqu'un utilisateur clique sur le bouton de suppression, une fenêtre pop-up apparaît avec un effet de flou en arrière-plan. L'utilisateur a alors la possibilité de fermer la fenêtre pop-up en cliquant sur le bouton 'Non', sur l'icône de fermeture ou en dehors de la fenêtre pop-up. Dans tous ces cas, la fenêtre pop-up est fermée et l'effet de flou en arrière-plan est supprimé.
    */
    const deleteButtonOrigin = document.getElementById('deleteButtonOrigin');
    const transitionOverlay = document.getElementById('transition-overlay');
    const popUpDelete = document.getElementById('popUpDelete');
    const noButton = document.getElementById('popUpDeleteNo');
    const closeIcon = document.getElementById('closeIcon');

    deleteButtonOrigin.addEventListener('click', function () {
        transitionOverlay.style.backdropFilter = 'blur(10px)';
        transitionOverlay.style.zIndex = '15';
        popUpDelete.style.zIndex = '16';
        popUpDelete.style.opacity = '1';
    });
    function closePopUpDelete() {
        popUpDelete.style.opacity = '0';
        popUpDelete.style.zIndex = '-1';
        transitionOverlay.style.zIndex = '-1';
        transitionOverlay.style.backdropFilter = 'blur(0px)';
    }

    noButton.addEventListener('click', function () {
        closePopUpDelete();
    });

    transitionOverlay.addEventListener('click', function () {
        closePopUpDelete();
    });

    closeIcon.addEventListener('click', function () {
        closePopUpDelete();
    });
});
