<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<body>
    <div class="container">
        <!-- A Faire front -->
        <label for="dateDebut">Date de début</label>
        <input type="date" name="dateDebut" id="dateDebut">
        <label for="dateFin">Date de fin</label>
        <input type="date" name="dateFin" id="dateFin">
        <label for="optionTri">Option tri</label>
        <select name="optionTri" id="optionTri">
            <option value="ville">Ville</option>
            <option value="thematique">Thématique</option>
            <option value="sujet">Sujet</option>
            <option value="taches">Taches</option>
        </select>
        <input type="hidden" name="action" value="filtre"/>
        <input type="submit" value="Envoyer"/>


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
