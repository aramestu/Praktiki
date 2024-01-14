document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour gérer l'interaction avec la barre de navigation. Il ajoute la classe 'active' aux éléments de navigation correspondant à l'action ou au contrôleur courant. Il gère également l'ouverture et la fermeture du menu burger en modifiant les classes et les styles des éléments concernés.
    */
    const currentAction = window.location.search.split('=')[1];
    const urlParams = new URLSearchParams(window.location.search);
    const currentController = urlParams.get('controller');
    const navItems = document.querySelectorAll('.navbar .nav-item');
    navItems.forEach(item => {
        if (item.getAttribute('data-action') === currentAction) {
            item.classList.add('active');
        } else if (currentAction === 'createAccount' && item.getAttribute('data-action') === 'connect' || currentAction === 'preference' && item.getAttribute('data-action') === 'connect' || currentController === 'Connexion' && item.getAttribute('data-action') === 'connect') {
            item.classList.add('active');
        } else if (currentAction === 'createOffer' && item.getAttribute('data-action') === 'home') {
            item.classList.add('active');
        } else if ((currentController === 'ExpPro' || currentAction === 'ExpPro&action') && item.getAttribute('data-action') === 'offre') {
            item.classList.add('active');
        } else if (currentController === 'TDB' && item.getAttribute('data-action') === 'tdbEtudiant') {
            item.classList.add('active');
        }
    });

    const burger = document.querySelector('.burger');

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        document.querySelector('.navbar').classList.toggle('active');
        if (!document.querySelector('.navbar').classList.contains('active')) {
            document.querySelector('.navbar').classList.toggle('active');
            document.querySelector('.navbar').style = "height:";
            setTimeout(() => {
                document.querySelector('.navbar').classList.toggle('active');
                for (let i = 0; i < document.querySelectorAll('.nav-item').length; i++) {
                    document.querySelectorAll('.nav-item')[i].style = "opacity: 0; margin-left: 2.5rem";
                }
            }, 500);
        } else {
            document.querySelector('.navbar').style = "height: 90vh";
            for (let i = 0; i < document.querySelectorAll('.nav-item').length; i++) {
                document.querySelectorAll('.nav-item')[i].style = "opacity: 1; margin-left: 0";
            }
        }
    });
});