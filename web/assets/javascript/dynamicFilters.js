document.addEventListener('DOMContentLoaded', function () {
    const stage = document.getElementById('stage');
    const alternance = document.getElementById('alternance');
    const datePublication = document.getElementById('datePublication');
    const codePostal = document.getElementById('codePostal');
    let stageState = "shown";
    let alternanceState = "shown";

    stage.addEventListener('click', () => {
        if (stageState === "shown") {
            stageState = "hidden";
            updateAll();
        } else {
            stageState = "shown";
            updateAll();
        }
    });

    alternance.addEventListener('click', () => {
        if (alternanceState === "shown") {
            alternanceState = "hidden";
            updateAll();
        } else {
            alternanceState = "shown";
            updateAll();
        }
    });

    datePublication.addEventListener('input', () => {
        const datePublicationValue = document.getElementById('datePublication').value;
        console.log(datePublicationValue);
        updateDatePublication(datePublicationValue);
        updateOffers();
    });

    codePostal.addEventListener('input', () => {
        const codePostalValue = document.getElementById('codePostal').value;
        console.log(codePostalValue);
        updateCodePostal(codePostalValue);
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

        const queryParams = new URLSearchParams({
            datePublication,
            dateDebut,
            dateFin,
            stage,
            alternance,
            BUT2,
            BUT3,
            codePostal,
            optionTri,
        });

        // Update the URL to match your server's URL
        const url = 'http://localhost:9000/web/frontController.php?controller=ExpPro&action=getFilteredOffers&' + queryParams;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                try {
                    // Try to parse the response as JSON
                    const jsonData = JSON.parse(data);

                    // Update your UI with the filtered offers
                    console.log(jsonData);

                    // You can implement logic to update the UI here
                    // For example, you might want to replace the existing offers with the filtered ones
                    // You can manipulate the DOM as needed
                    // For simplicity, let's just log the filtered data for now
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => console.error('Error fetching offers:', error));
    }






});