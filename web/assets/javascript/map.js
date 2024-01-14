document.addEventListener('DOMContentLoaded', function () {
    /*
    Ce script est utilisé pour afficher une carte interactive avec un marqueur pour une adresse spécifique. Il récupère l'adresse à partir d'un élément HTML, puis utilise l'API Nominatim d'OpenStreetMap pour obtenir les coordonnées de latitude et de longitude de cette adresse. Une fois les coordonnées obtenues, il initialise une carte avec la bibliothèque Leaflet, ajoute une couche de tuiles OpenStreetMap et place un marqueur à l'adresse. Si l'API ne retourne aucune donnée pour l'adresse, le script affiche une erreur 404.
    */
    var address = document.querySelector('.codePostalID').innerHTML;
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('map').innerHTML = `
                    <div class="VBox">
                        <img src="assets/images/error-icon.png" id="errorIcon" alt="ErrorScreen">
                        <h1>Erreur 404</h1>
                        <h1>Adresse introuvable sur nos services cartographiques</h1>
                    </div>
                `;
                return;
            }
            var lat = data[0].lat;
            var lon = data[0].lon;
            var map = L.map('map').setView([lat, lon], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                minZoom: 5,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([lat, lon]).addTo(map)
                .bindPopup(address)
                .openPopup();
        })
        .catch(error => console.error(error));
});