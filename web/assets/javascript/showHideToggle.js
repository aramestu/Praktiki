document.addEventListener('DOMContentLoaded', function () {
    const typeOffre = document.getElementById('typeOffre');
    const stageForm = document.getElementById('stageForm');
    const alternanceForm = document.getElementById('alternanceForm');

    // Fonction pour masquer le formulaire non sélectionné
    function toggleFormDisplay() {
        if (typeOffre.value === 'stage') {
            stageForm.classList.remove('hidden');
            alternanceForm.classList.add('hidden');
        } else if (typeOffre.value === 'alternance') {
            stageForm.classList.add('hidden');
            alternanceForm.classList.remove('hidden');
        }
    }

    // Écouteur d'événement pour le changement de sélection
    typeOffre.addEventListener('change', toggleFormDisplay);

    // Appel initial pour afficher le formulaire approprié
    toggleFormDisplay();
});
