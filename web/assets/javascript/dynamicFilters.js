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
        const searchbar = document.getElementById('search-bar');
        async function afficherFilms() {
            const reponse = await fetch("http://localhost/sae_web_s1/web/frontController.php?datePublication=lastWeek&dateDebut=&dateFin=&codePostal=&action=getExpProByFiltre&controller=ExpPro");
            const films = await reponse.json();
            console.log(films);
        }
    }

    function updateCodePostal(codePostal){

        const small = document.querySelectorAll('.small');
        console.log("Number of small offers: " + small.length);

        for (let i = 0; i < small.length; i++) {
            console.log("Offer number: " + i);

            // Check the code postal element within the small offer
            const codePostalElement = small[i].querySelector(".codePostalID"); // Assuming class is used, update this based on your HTML

            // Add a check for null before accessing innerText
            if (codePostalElement) {
                const codePostalValue = codePostalElement.innerText.trim();
                console.log("Code postal value: " + codePostalValue);

                // Check if the code postal contains the entered value
                if (codePostalValue.includes(codePostal)) {
                    // Show the offer
                    small[i].style.display = "block";
                } else {
                    // Hide the offer
                    small[i].style.display = "none";
                }
            } else {
                console.error("Element with class 'codePostalID' not found in the small offer.");
            }
        }


        /*
        for(let i = 0; i < small.length; i++){
            console.log("offre nb :" + i);
            //check the code postal of the small offer which is a child of the offer
            //if it's not the same as the code postal in the input
            small[i].getElementById("codePostalID").innerHTML = codePostal;
            console.log("codepostal :" + small[i].getElementById("codePostalID").innerHTML);
            if (small[i].getElementById("codePostalID").innerHTML !== codePostal) {
                //hide the offer
                small[i].parentNode.style = "display:none";
            }
            else{
                //show the offer
                small[i].parentNode.style = "display:block";
            }
        }

         */
    }





});