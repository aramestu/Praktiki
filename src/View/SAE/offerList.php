<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<body>
    <div class="container">
                    <textarea id="search-bar" name="session_id" rows="1" cols="50" style="resize: none"
                              placeholder="Rechercher une offre" ></textarea>
                    <button class="custom-button" onclick="joinSessionById()">
                        <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
                    </button>
    </div>



<?php foreach ($listeExpPro as $expPro) {
    require 'smallOffer.php';
} ?>

</body>
</html>
