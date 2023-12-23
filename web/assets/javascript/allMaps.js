document.addEventListener('DOMContentLoaded', function() {
    // Assuming you have an array of offers with latitude and longitude
    var offers = [
        { lat: 51.505, lng: -0.09, title: 'Offer 1' },
        { lat: 51.51, lng: -0.1, title: 'Offer 2' },
        // ...
    ];

// Initialize the map centered on the first offer
    var map = L.map('map').setView([offers[0].lat, offers[0].lng], 13);

// Set up the OSM layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

// Add markers for each offer
    offers.forEach(function(offer) {
        L.marker([offer.lat, offer.lng]).addTo(map)
            .bindPopup(offer.title)
            .openPopup();
    });
});