<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
    <link rel="stylesheet" href="assets/css/filter.css">
    <script src="assets/javascript/buildOfferTable.js"></script>
</head>

<body>
    <div class="container">

    <textarea id="search-bar" name="session_id" rows="1" cols="50" style="resize: none"
                                  placeholder="Rechercher une offre" ></textarea>
    <button class="custom-button" id="search-button">
        <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
    </button>


    </div>
<div class="HBox" id="center">

<div class="container VBox" id="sideFilter">
<form method="get">

                    <select name="datePublication" id="datePublication">
                    <option value="" disabled selected style="display:none;">Période de publication</option>
                        <option value="last24">Dernières 24 heures</option>
                        <option value="lastWeek">Dernière semaine</option>
                        <option value="lastMonth">Dernier mois</option>
                    </select>

                    <label for="dateDebut">Date de début</label>
                                <input type="date" name="dateDebut" id="dateDebut">
                                <label for="dateFin">Date de fin</label>
                                <input type="date" name="dateFin" id="dateFin">


                    <div class="button-checkbox">
                        <input type="checkbox" id="stage" name="stage" value="stage">
                        <label for="stage">Stage</label>
                    </div>

                    <div class="button-checkbox">
                        <input type="checkbox" id="alternance" name="alternance" value="alternance">
                        <label for="alternance">Alternance</label>
                    </div>



                        <label for="codePostal">Code Postal</label>
                        <input type="number" id="codePostal" name="codePostal" pattern="[0-9]{5}" maxlength="5" placeholder="34090">

                                <select name="optionTri" id="optionTri">
                                <option value="" disabled selected style="display:none;">Trier par</option>

                                    <option value="datePublication">Offres les plus récentes</option>
                                    <option value="datePublicationInverse">Offres les plus anciennes</option>
                                    <option value="salaireCroissant">Salaire croissant</option>
                                    <option value="salaireDecroissant">Salaire décroissant</option>
                                </select>

                    <button type="reset" id="reset">Tout effacer</button>
                    <input type="hidden" name="action" value="getExpProByFiltre">
                    <input type="hidden" name="controller" value="ExpPro">
                    <input type="submit" id="rechercher" value="rechercher">
        </form>
</div>

<div id="tableOffer">
<?php require_once 'offerTable.php'; ?>
</div>

   </div>


</body>
</html>
