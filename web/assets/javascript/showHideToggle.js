document.addEventListener('DOMContentLoaded', function () {
    const typeOffre = document.getElementById('typeOffre');
    const stageForm = document.getElementById('stageForm');
    const alternanceForm = document.getElementById('alternanceForm');
    const gratification = document.getElementById('gratification');

    function toggleFormDisplay() {
        if (typeOffre.value === 'stage') {
            gratification.setAttribute('required', 'required');
            stageForm.classList.remove('hidden');
            alternanceForm.classList.add('hidden');
        } else if (typeOffre.value === 'alternance') {
            gratification.removeAttribute('required');
            stageForm.classList.add('hidden');
            alternanceForm.classList.remove('hidden');
        } else if (typeOffre.value === 'Non définie' || typeOffre.value === 'stalternance') {
            gratification.removeAttribute('required');
            stageForm.classList.add('hidden');
            alternanceForm.classList.add('hidden');
        }
    }

    typeOffre.addEventListener('change', toggleFormDisplay);
    toggleFormDisplay();
});
