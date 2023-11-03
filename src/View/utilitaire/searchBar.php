<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
    <link rel="stylesheet" href="assets/css/filter.css">
    <script src="assets/javascript/buildOfferTable.js"></script>
</head>

<body>
<div class="container">

    <form method="get" action="frontController.php">

        <input type="hidden" name="action" value="<?php echo $action?>">
        <input type="hidden" name="controller" value="<?php echo $controller?>">
        <input type="text" placeholder="Rechercher" name="keywords" id="search-bar" <?php
        if (isset($_GET["keywords"])) {
            echo "value=\"" . $_GET['keywords'] . "\"";
        }
        ?>>

        <button type="submit" class="custom-button" id="search-button">
            <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
        </button>

    </form>
</div>
</body>
</html>