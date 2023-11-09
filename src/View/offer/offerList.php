<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>

<div class="container">

    <form method="get" action="frontController.php">

        <input type="hidden" name="action" value="getExpProBySearch">
        <input type="hidden" name="controller" value="ExpPro">
        <input type="text" placeholder="Rechercher une offre" name="keywords" id="search-bar" <?php
        if (isset($_GET["keywords"])) {
            echo "value=\"" . rawurldecode($_GET['keywords']) . "\"";
        }
        ?>>

        <button type="submit" class="custom-button" id="search-button">
            <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
        </button>

    </form>
</div>
<div class="HBox" id="center">

    <div class="container VBox" id="sideFilter">
        <form method="get" action="frontController.php">
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


            <div class="button-checkbox stage">
                <Label>
                    <input type="checkbox" id="stage" name="stage" value="stage">
                    <span>Stage</span>
                </Label>
            </div>

            <div class="button-checkbox alternance">
                <label>
                    <input type="checkbox" id="alternance" name="alternance" value="alternance">
                    <span>Alternance</span>
                </label>
            </div>


            <label for="codePostal">Code Postal</label>
            <input type="number" id="codePostal" name="codePostal"  min="0" max="99999" placeholder="34090">

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
        <?php require 'offerTable.php'; ?>
    </div>

</div>