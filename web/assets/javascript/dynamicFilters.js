document.addEventListener('DOMContentLoaded', function () {
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
    let stageState = "shown";
    let alternanceState = "shown";

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

    searchbar.addEventListener('input', () => {
        updateOffers();
    });


    function updateAll() {
        if(stageState === "hidden" && alternanceState === "hidden"){
            updateAlternance("block");
            updateStage("block");
        }
        else if(stageState === "hidden" && alternanceState === "shown"){
            updateAlternance("none");
            updateStage("block");
        }else if(stageState === "shown" && alternanceState === "hidden"){
            updateAlternance("block");
            updateStage("none");
        }else{
            updateAlternance("block");
            updateStage("block");
        }
    }

    //Début Filtres Stages et Alternances
    function updateAlternance(state) {
        const alternances = document.querySelectorAll('.Alternance');
        for (let i = 0; i < alternances.length; i++) {
            alternances[i].parentNode.style = "display:" + state;
        }
    }

    function updateStage(state) {
        const stages = document.querySelectorAll('.Stage');
        for (let i = 0; i < stages.length; i++) {
            stages[i].parentNode.style = "display:" + state;
        }
    }
    //Fin Filtres Stages et Alternances

    //Début Filtres Trier par
    function updateDatePublication(state) {
        console.log("updateDatePublication");
        const searchbar = document.getElementById('search-bar');
        async function afficherFilms() {
            const reponse = await fetch("http://localhost/sae_web_s1/web/frontController.php?datePublication=lastWeek&dateDebut=&dateFin=&codePostal=&action=getExpProByFiltre&controller=ExpPro");
            const films = await reponse.json();
            console.log("Fetch Response : " + films);
        }
        console.log("fin updateDatePublication");
    }

    function updateCodePostal(codePostal){
        const small = document.querySelectorAll('.small');
        for (let i = 0; i < small.length; i++) {
            const codePostalElement = small[i].querySelector(".codePostalID");
            if (codePostalElement) {
                const codePostalValue = codePostalElement.innerText.trim();
                if (codePostalValue.includes(codePostal)) {
                    small[i].style.display = "block";
                } else {
                    small[i].style.display = "none";
                }
            } else {
                console.error("Element with class 'codePostalID' not found in the small offer.");
            }
        }
    }


    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('rechercher').addEventListener('click', function (event) {
            event.preventDefault();
            updateOffers();
        });

        document.getElementById('reset').addEventListener('click', function () {
            resetFilters();
            updateOffers();
        });
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

        //if a parameter is null or undefined do not add it
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
            queryParams.append('BUT2', BUT2);
        }
        if (BUT3) {
            queryParams.append('BUT3', BUT3);
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

        // Update the URL to match your server's URL
        const url = 'http://localhost:9000/web/frontController.php?controller=ExpPro&action=getFilteredOffers&' + queryParams;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text(); // Use response.text() for non-JSON content
            })
            .then(data => {
                console.log('Response received:', data);

                // Update your UI with the HTML content
                const offersContainer = document.querySelector('.tableResponsive');
                offersContainer.innerHTML = data;
            })
            .catch(error => console.error('Error fetching offers:', error));
    }

// Function to create a new offer element based on offer data
    function createOfferElement(offer) {
        const offerElement = document.createElement('div');
        // Add logic here to construct the HTML structure for the offer element
        // You can use offer data like offer.title, offer.company, etc.

        // Example:
        offerElement.innerHTML = `
        <div>Hello</div>
    `;
        /*
        offerElement.innerHTML = `
        <div class="subContainer small ${offer.type}">
            <div class="header">
                <div class="left">
                    <p class="bold typeExpPro">${offer.type}</p>
                    <p>${offer.timeAgo}</p>
                </div>
                <div class="right">
                    <p>Du ${offer.startDate}</p>
                    <p>Au ${offer.endDate}</p>
                </div>
            </div>
            <div class="information">
                <h3>${offer.title}</h3>
                <p>${offer.company}</p>
                <p><img src="assets/images/map-pin-icon.png" class="mapPin" alt="MapPin"><span class="codePostalID">${offer.codePostal}</span></p>
            </div>
        </div>
    `;

         */

        return offerElement;
    }







});