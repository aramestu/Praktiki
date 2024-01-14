document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour créer un effet de chute de neige sur une page web. Il génère un certain nombre de flocons de neige, chacun étant un élément div avec une taille, une position et une durée d'animation aléatoires. Ces flocons de neige sont ensuite ajoutés au corps du document pour créer l'effet de chute de neige.
    */
    function getRandomValue(range) {
        return Math.random() * range;
    }

    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');

        const size = getRandomValue(0.8);
        const leftIni = getRandomValue(20) - 10;
        const leftEnd = getRandomValue(20) - 10;

        snowflake.style.setProperty('--size', size + 'vw');
        snowflake.style.setProperty('--left-ini', leftIni + 'vw');
        snowflake.style.setProperty('--left-end', leftEnd + 'vw');
        snowflake.style.left = getRandomValue(100) + 'vw';

        const animationDuration = 5 + getRandomValue(10);
        const animationDelay = -getRandomValue(10);

        snowflake.style.animationDuration = animationDuration + 's';
        snowflake.style.animationDelay = animationDelay + 's';

        document.body.appendChild(snowflake);
    }

    for (let i = 0; i < 150; i++) {
        createSnowflake();
    }
});