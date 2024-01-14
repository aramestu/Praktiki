document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer les filtres dynamiques sur une page de recherche d'offres. Il récupère les valeurs des filtres, construit une requête fetch avec ces valeurs comme paramètres, puis met à jour la liste des offres en fonction de la réponse de la requête. Il comprend également une fonction pour réinitialiser tous les filtres.
    */
    const stage = document.getElementById('stage');
    const alternance = document.getElementById('alternance');
    const datePublication = document.getElementById('datePublication');
    const codePostal = document.getElementById('codePostal');
    const optionTri = document.getElementById('optionTri');
    const dateDebut = document.getElementById('dateDebut');
    const dateFin = document.getElementById('dateFin');
    const BUT2 = document.getElementById('BUT2');
    const BUT3 = document.getElementById('BUT3');

    const searchbar = document.getElementById('search-bar');
    const resetButton = document.getElementById('reset');

    var rechercheEnAttente = null;

    function revealElements() {
        const smallElements = document.querySelectorAll('.small');
        smallElements.forEach(function (element, index) {
            element.style.animationDelay = index * 0.06 + "s";
        });
    }

    function updateResetButton() {
        const resetButton = document.getElementById('reset');
        if (stage.checked || alternance.checked || datePublication.value || codePostal.value || optionTri.value || dateDebut.value || dateFin.value || BUT2.checked || BUT3.checked || searchbar.value) {
            resetButton.classList.add('active');
        } else {
            resetButton.classList.remove('active');
        }
    }

    revealElements();
    updateResetButton();


    stage.addEventListener('click', () => {
        updateOffers();
    });
    alternance.addEventListener('click', () => {
        updateOffers();
    });
    datePublication.addEventListener('input', () => {
        updateOffers();
    });
    codePostal.addEventListener('input', () => {
        updateOffers();
    });
    optionTri.addEventListener('change', () => {
        updateOffers();
    });
    dateDebut.addEventListener('input', () => {
        updateOffers();
    });
    dateFin.addEventListener('input', () => {
        updateOffers();
    });
    BUT2.addEventListener('click', () => {
        updateOffers();
    });
    BUT3.addEventListener('click', () => {
        updateOffers();
    });
    searchbar.addEventListener('input', () => {
        if (rechercheEnAttente !== null) {
            clearTimeout(rechercheEnAttente);
        }
        rechercheEnAttente = setTimeout(() => {
            updateOffers();
            rechercheEnAttente = null;
        }, 750);
    });

    resetButton.addEventListener('click', () => {
        resetFilters();
    });

    function updateOffers() {
        const datePublication = document.getElementById('datePublication').value;
        const dateDebut = document.getElementById('dateDebut').value;
        const dateFin = document.getElementById('dateFin').value;
        const stage = document.getElementById('stage').checked;
        const alternance = document.getElementById('alternance').checked;
        const BUT2 = document.getElementById('BUT2').checked;
        const BUT3 = document.getElementById('BUT3').checked;
        const codePostal = document.getElementById('codePostal').value;
        const optionTri = document.getElementById('optionTri').value;
        const keywords = document.getElementById('search-bar').value;
        rechercheEnAttente = keywords;

        const queryParams = new URLSearchParams();
        if (datePublication) {
            queryParams.append('datePublication', datePublication);
        }
        if (dateDebut) {
            queryParams.append('dateDebut', dateDebut);
        }
        if (dateFin) {
            queryParams.append('dateFin', dateFin);
        }
        if (stage) {
            queryParams.append('stage', stage);
        }
        if (alternance) {
            queryParams.append('alternance', alternance);
        }
        if (BUT2) {
            queryParams.append('BUT2', 'BUT2');
        }
        if (BUT3) {
            queryParams.append('BUT3', 'BUT3');
        }
        if (codePostal) {
            queryParams.append('codePostal', codePostal);
        }
        if (optionTri) {
            queryParams.append('optionTri', optionTri);
        }
        if (keywords) {
            queryParams.append('keywords', keywords);
        }
        const url = 'frontController.php?controller=ExpPro&action=getFilteredOffers&' + queryParams;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                const offersContainer = document.querySelector('.tableResponsive');
                offersContainer.innerHTML = data;
                revealElements();
                updateResetButton();
            })
            .catch(error => console.error('Error fetching offers:', error));
    }

    function resetFilters() {
        document.getElementById('datePublication').value = '';
        document.getElementById('dateDebut').value = '';
        document.getElementById('dateFin').value = '';
        document.getElementById('stage').checked = false;
        document.getElementById('alternance').checked = false;
        document.getElementById('BUT2').checked = false;
        document.getElementById('BUT3').checked = false;
        document.getElementById('codePostal').value = '';
        document.getElementById('optionTri').value = '';
        document.getElementById('search-bar').value = '';
        updateResetButton();
        updateOffers();
    }
});