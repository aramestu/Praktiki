document.addEventListener('DOMContentLoaded', function () {

    const currentAction = window.location.search.split('=')[1];

    const navItems = document.querySelectorAll('.navbar .nav-item');
    navItems.forEach(item => {
        if (item.getAttribute('data-action') === currentAction) {
            item.classList.add('active');
        }else if(currentAction === 'createAccount' && item.getAttribute('data-action') === 'connect'){
            item.classList.add('active');
        }
    });
});