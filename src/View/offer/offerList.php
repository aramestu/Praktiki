<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>
<script src="assets/javascript/dynamicFilters.js"></script>

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

            <input type="number" id="codePostal" name="codePostal"  min="0" max="99999" placeholder="code postal" <?php if (isset($_GET['codePostal'])){ echo "value=\"" . rawurldecode($_GET['codePostal'] . "\"");}?>>


            <select name="optionTri" id="optionTri">
                <option value="" disabled <?php if (!isset($_GET['optionTri'])){ echo "selected";}?> style="display:none;">Trier par</option>
                <option value="datePublication" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "datePublication"){ echo "selected";}?> >Offres les plus récentes</option>
                <option value="datePublicationInverse" <?php if (isset($_GET['optionTri']) && $_GET['optionTri'] == "datePublicationInverse"){ echo "selected";}?> >Offres les plus anciennes</option>
            </select>

            <button type="reset" id="reset">
                <span>Effacer</span>
            </button>
            <input type="hidden" name="action" value="getExpProByFiltre">
            <input type="hidden" name="controller" value="ExpPro">
        </form>
    </div>

    <div class="VBox">

            <form id="searchBarParent" method="get" action="frontController.php">

                <input type="hidden" name="action" value="getExpProBySearch">
                <input type="hidden" name="controller" value="ExpPro">
                <input type="text" placeholder="Rechercher une offre" name="keywords" id="search-bar" <?php
                if (isset($_GET["keywords"])) {
                    echo "value=\"" . rawurldecode($_GET['keywords']) . "\"";
                }
                ?>>

                <button type="submit" class="custom-button" id="search-button">
                    <img src="assets/images/loupe.png" alt="Loupe Icon" width="0" height="0">
                </button>

            </form>

    <div id="tableOffer">

        <?php require 'offerTable.php'; ?>
    </div>
    </div>

</div>