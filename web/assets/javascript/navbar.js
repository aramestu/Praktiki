document.addEventListener('DOMContentLoaded', function () {

    const currentAction = window.location.search.split('=')[1];
    const logoToggle = document.getElementById('logoToggle');

    const navItems = document.querySelectorAll('.navbar .nav-item');
    navItems.forEach(item => {
        console.log(item.getAttribute('data-action'));
        if (item.getAttribute('data-action') === currentAction) {
            item.classList.add('active');
        }else if(currentAction === 'createAccount' && item.getAttribute('data-action') === 'connect'){
            item.classList.add('active');
        }else if(currentAction === 'createOffer' && item.getAttribute('data-action') === 'home'){
            item.classList.add('active');
        }
    });

    //change the css stylesheets when logoToggle is clicked
    logoToggle.addEventListener('click', () => {
        const currentTheme = document.getElementById('theme');
        if (currentTheme.getAttribute('href') === 'assets/css/main.css') {
            currentTheme.setAttribute('href', 'assets/css/mainIUT.css');
        } else {
            currentTheme.setAttribute('href', 'assets/css/main.css');
        }
    });
});