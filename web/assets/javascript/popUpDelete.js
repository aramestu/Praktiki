document.addEventListener('DOMContentLoaded', function () {
    const deleteButtonOrigin = document.getElementById('deleteButtonOrigin');
    const transitionOverlay = document.getElementById('transition-overlay');
    const popUpDelete = document.getElementById('popUpDelete');
    const noButton = document.getElementById('popUpDeleteNo');
    const closeIcon = document.getElementById('closeIcon');


    deleteButtonOrigin.addEventListener('click', function () {
        console.log('click, overlay and popup should appear');
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
