document.addEventListener('DOMContentLoaded', function () {
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

    // Create 50 snowflakes
    for (let i = 0; i < 150; i++) {
      createSnowflake();
    }
});