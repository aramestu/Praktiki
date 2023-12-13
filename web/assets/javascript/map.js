document.addEventListener('DOMContentLoaded', function() {
    var address = document.querySelector('.codePostalID').innerHTML;
fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
    .then(response => response.json())
    .then(data => {
        var lat = data[0].lat;
        var lon = data[0].lon;
        var map = L.map('map').setView([lat, lon], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.marker([lat, lon]).addTo(map)
            .bindPopup(address)
            .openPopup();
    })
    .catch(error => console.error(error));
});