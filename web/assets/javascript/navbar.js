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

    const burger = document.querySelector('.burger');

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        document.querySelector('.navbar').classList.toggle('active');
        if (!document.querySelector('.navbar').classList.contains('active')) {
            document.querySelector('.navbar').classList.toggle('active');;
            document.querySelector('.navbar').style = "height:";
            setTimeout(() => {
                document.querySelector('.navbar').classList.toggle('active');
                for (let i = 0; i < document.querySelectorAll('.nav-item').length; i++) {
                    document.querySelectorAll('.nav-item')[i].style = "opacity: 0; margin-left: 2.5rem";
                }
            }, 500);
        }else{
            document.querySelector('.navbar').style = "height: 90vh";
            for (let i = 0; i < document.querySelectorAll('.nav-item').length; i++) {
                document.querySelectorAll('.nav-item')[i].style = "opacity: 1; margin-left: 0";
            }
        }
    });
});