<body>
<div class="header">
    <h2>
        Liste des entreprises validées
    </h2>
</div>
<!-- BARRE DE RECHERCHE -->
<?php /*$action = "afficherListeEntrepriseValideFiltree";
$controller = "Entreprise";
require_once __DIR__ . '/../utilitaire/searchBar.php';*/?>




<!-- FILTRE -->
<div class="HBox" id="center">
    <div class="container VBox" id="sideFilter">
        <form method="get" action="frontController.php">
            <label for="keywords">Siret ou nom</label>
            <input type="text" id="keywords" name="keywords" placeholder="Recherche" value="<?php if(isset($_GET["keywords"])) echo $_GET["keywords"]; ?>">

            <label for="codePostal">Code Postal</label>
            <input type="number" id="codePostal" name="codePostal" pattern="[0-9]{5}" maxlength="5" placeholder="34090" value="<?php if(isset($_GET["codePostal"])) echo $_GET["codePostal"]; ?>">

            <label for="effectif">Effectif maximum</label>
            <input type="number" id="effectif" name="effectif" placeholder="50" value="<?php if(isset($_GET["effectif"])) echo $_GET["effectif"]; ?>">

            <button type="reset" id="reset">Tout effacer</button>
            <input type="hidden" name="action" value="afficherListeEntrepriseValideFiltree">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" id="rechercher" value="rechercher">
        </form>
    </div>
    <!-- AFFICHAGE DES ENTREPRISES -->
    <div class="container">
        <?php
        foreach ($listEntreprises as $entreprise) {
            require "company.php";
        }
        ?>
    </div>
</div>
</body>