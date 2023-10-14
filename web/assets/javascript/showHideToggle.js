document.addEventListener('DOMContentLoaded', function () {
    const typeOffre = document.getElementById('typeOffre');
    const stageForm = document.getElementById('stageForm');
    const alternanceForm = document.getElementById('alternanceForm');
    const gratification = document.getElementById('gratification');

    // Fonction pour masquer le formulaire non sélectionné
    function toggleFormDisplay() {
        // Supprimer l'attribut "required" de l'élément gratification
        //gratification.removeAttribute('required');


        if (typeOffre.value === 'stage') {
            gratification.setAttribute('required', 'required');
            stageForm.classList.remove('hidden');
            alternanceForm.classList.add('hidden');
        } else if (typeOffre.value === 'alternance') {
            gratification.removeAttribute('required');
            stageForm.classList.add('hidden');
            alternanceForm.classList.remove('hidden');
        }
    }

    // Écouteur d'événement pour le changement de sélection
    typeOffre.addEventListener('change', toggleFormDisplay);

    // Appel initial pour afficher le formulaire approprié
    toggleFormDisplay();
});
