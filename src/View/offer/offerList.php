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
                <option value="" disabled <?php if (!isset($_GET['datePublication'])){ echo "selected";}?> style="display:none;">Période de publication</option>
                <option value="last24" <?php if (isset($_GET['datePublication']) && $_GET['datePublication'] == "last24"){ echo "selected";}?>>Dernières 24 heures</option>
                <option value="lastWeek"<?php if (isset($_GET['datePublication']) && $_GET['datePublication'] == "lastWeek"){ echo "selected";}?>>Dernière semaine</option>
                <option value="lastMonth"<?php if (isset($_GET['datePublication']) && $_GET['datePublication'] == "lastMonth"){ echo "selected";}?>>Dernier mois</option>
            </select>

            <label for="dateDebut">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" <?php if (isset($_GET['dateDebut'])){ echo "value=\"" . $_GET['dateDebut'] . "\"";}?>>
            <label for="dateFin">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin" <?php if (isset($_GET['dateFin'])){ echo "value=\"" . $_GET['dateFin'] . "\"";}?>>


            <span>Type d'offre</span>
            <div class="button-checkbox stage">
                <Label>
                    <input type="checkbox" id="stage" name="stage" value="stage" <?php if (isset($_GET['stage'])){ echo "checked";}?>>
                    <span>Stage</span>
                </Label>
            </div>

            <div class="button-checkbox alternance">
                <label>
                    <input type="checkbox" id="alternance" name="alternance" value="alternance" <?php if (isset($_GET['alternance'])){ echo "checked";}?>>
                    <span>Alternance</span>
                </label>
            </div>

            <span>Année minimum demandée</span>
            <div class="button-checkbox stage">
                <Label>
                    <input type="checkbox" id="BUT2" name="BUT2" value="BUT2" <?php if (isset($_GET['BUT2'])){ echo "checked";}?>>
                    <span>BUT 2</span>
                </Label>
            </div>

            <div class="button-checkbox stage">
                <Label>
                    <input type="checkbox" id="BUT3" name="BUT3" value="BUT3" <?php if (isset($_GET['BUT3'])){ echo "checked";}?>>
                    <span>BUT 3</span>
                </Label>
            </div>

            <label for="codePostal">Code Postal</label>
            <input type="number" id="codePostal" name="codePostal"  min="0" max="99999" placeholder="34090" <?php if (isset($_GET['codePostal'])){ echo "value=\"" . rawurldecode($_GET['codePostal'] . "\"");}?>>


            <select name="optionTri" id="optionTri">
                <option value="" disabled <?php if (!isset($_GET['optionTri'])){ echo "selected";}?> style="display:none;">Trier par</option>
                <option value="datePublication" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "datePublication"){ echo "selected";}?> >Offres les plus récentes</option>
                <option value="datePublicationInverse" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "datePublicationInverse"){ echo "selected";}?> >Offres les plus anciennes</option>
                <option value="salaireCroissant" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "salaireCroissant"){ echo "selected";}?> >Salaire croissant</option>
                <option value="salaireDecroissant" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "salaireDecroissant"){ echo "selected";}?> >Salaire décroissant</option>
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