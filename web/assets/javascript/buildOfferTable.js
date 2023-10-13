document.addEventListener('DOMContentLoaded', function () {

    const searchButton = document.getElementById('search-button');
    searchButton.addEventListener('click', buildTable);
    function buildTable() {
        console.log("buildTable");
        //reload the element with the id tableOffer
        var tableOffer = document.getElementById("tableOffer");
        tableOffer.innerHTML = tableOffer.innerHTML;
        $("#tableOffer").load(window.location.href + " #tableOffer");
        /*
        var searchBar = document.getElementById("search-bar");
        var filter = searchBar.value;

        // Effectuez une requête AJAX pour mettre à jour la vue des offres en fonction de la recherche
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "offerTable.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var offersContainer = document.getElementById("offers-container");
                offersContainer.innerHTML = xhr.responseText;
            }
        };
        xhr.send("filter=" + filter);

         */
    }

});