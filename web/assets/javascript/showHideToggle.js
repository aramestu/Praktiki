document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer l'affichage conditionnel de différents formulaires en fonction du type d'offre sélectionné par l'utilisateur. Lorsque l'utilisateur sélectionne 'stage', le formulaire de stage est affiché et le champ 'gratification' est rendu obligatoire. Si l'utilisateur sélectionne 'alternance' ou 'offreNonDefini', le formulaire de stage est caché, le champ 'gratification' n'est plus obligatoire.
    */
    const typeOffre = document.getElementById('typeOffre');
    const stageForm = document.getElementById('stageForm');
    const gratification = document.getElementById('gratification');

    function toggleFormDisplay() {
        if (typeOffre.value === 'stage') {
            gratification.setAttribute('required', 'required');
            stageForm.classList.remove('hidden');
        } else if (typeOffre.value === 'alternance' || typeOffre.value === 'offreNonDefini') {
            gratification.removeAttribute('required');
            stageForm.classList.add('hidden');
        }
    }

    typeOffre.addEventListener('change', toggleFormDisplay);
    toggleFormDisplay();
});
