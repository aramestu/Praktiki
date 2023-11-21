document.addEventListener('DOMContentLoaded', function () {
    const stage = document.getElementById('stage');
    const alternance = document.getElementById('alternance');
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




});