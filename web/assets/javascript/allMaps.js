document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour afficher une carte interactive sur une page web. Il initialise la carte en se centrant sur la première offre d'un tableau d'offres, chaque offre étant représentée par un objet avec des coordonnées de latitude et de longitude ainsi qu'un titre. Ensuite, une couche de tuiles OpenStreetMap est ajoutée à la carte. Enfin, le script parcourt le tableau d'offres et ajoute un marqueur pour chaque offre sur la carte. Chaque marqueur est associé à une fenêtre contextuelle qui affiche le titre de l'offre.
    */
    var offers = [
        {lat: 51.505, lng: -0.09, title: 'Offer 1'},
        {lat: 51.51, lng: -0.1, title: 'Offer 2'},
    ];

    var map = L.map('map').setView([offers[0].lat, offers[0].lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    offers.forEach(function (offer) {
        L.marker([offer.lat, offer.lng]).addTo(map)
            .bindPopup(offer.title)
            .openPopup();
    });
});