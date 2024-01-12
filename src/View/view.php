<?php

use App\SAE\Lib\ConnexionUtilisateur;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $pagetitle ?></title>
    <link rel="icon" href="assets/images/favicon.ico">

    <link id="theme" rel="stylesheet" type="text/css" href="assets/css/mainIUT.css">
    <link rel="stylesheet" href="assets/css/charte-graphique-UM.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <script src="assets/javascript/navbar.js"></script>
    <link rel="stylesheet" href="assets/css/resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/CSB.css"/>
    <script src="assets/javascript/CSBBIS.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>

<div id="transition-overlay"></div>

<header>

    <a href="frontController.php?action=zoneDetest"><img id="logoToggle" class="logo"
                                                         src="assets/images/logo_sae_clear.png" alt="LogoUM"></a>

    <div class="burger">
        <span></span>
    </div>

    <nav class="navbar">
        <a href="frontController.php?action=home" class="nav-item" data-action="home">Accueil</a>
        <?php if (ConnexionUtilisateur::estConnecte()) {
            echo '
                <a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="nav-item" data-action="offre">Offres</a>
                <a href="frontController.php?controller=TDB&action=displayTDB" class="nav-item" data-action="tdbEtudiant">Mes infos</a>
                ';
        }
        echo '<a href="frontController.php?action=contact" class="nav-item" data-action="contact">Contact</a>';
        if (!ConnexionUtilisateur::estConnecte()) {
            echo '
                <a href="frontController.php?action=preference" class="nav-item" data-action="connect">Connexion</a>
                ';
        } else
            if (ConnexionUtilisateur::estConnecte()) {
                echo '
                    <a href="frontController.php?action=disconnect&controller=Connexion" class="nav-item" data-action="disconnect">Déconnexion</a>
                ';
            }
        ?>

    </nav>
</header>

<main>
    <?php
    foreach (\App\SAE\Lib\MessageFlash::lireTousMessages() as $type => $lireMessage) {
        echo '<div class="alert alert-' . $type . '">' . $lireMessage . '</div>';
    }
    require __DIR__ . "/{$cheminVueBody}";
    ?>

    <div id="cookie-banner">
        <h2>Politique de confidentialité</h2>
        <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site. Les cookies sont de petits fichiers de données qui sont stockés sur votre ordinateur ou appareil mobile lorsque vous visitez un site web. Ils nous permettent de collecter des informations sur votre comportement de navigation, comme les pages que vous visitez et les services que vous utilisez. Nous utilisons ces informations pour personnaliser votre expérience, pour comprendre comment notre site est utilisé et pour améliorer nos services. En continuant à utiliser notre site, vous acceptez notre utilisation des cookies. Pour plus d'informations sur notre utilisation des cookies et sur la manière dont vous pouvez contrôler les cookies, veuillez consulter notre politique de confidentialité.</p>
        <button id="close-banner"></button>
    </div>

</main>

<footer>
    <div class="VBox">
        <div class="HBox">
            <div class="VBox">
                <p>
                    Contactez-nous !
                </p>
            </div>
            <div class="VBox" id="footer-team">
                <p>Notre équipe</p>
                <a class="link" href="mailto:Lorick@mail.fr">Lorick</a>
                <a class="link" href="mailto:Mathias@mail.fr">Mathias</a>
                <a class="link" href="mailto:Clément@mail.fr">Clément</a>
                <a class="link" href="mailto:Thibaut@mail.fr">Thibaut</a>
                <a class="link" href="mailto:norman@mail.fr">Norman</a>
                <a class="link" href="mailto:soren.starck@free.fr">Soren</a>
            </div>
            <div class="VBox">
                <p>
                    Site de SAE 2023 Semestre 3
                </p>
            </div>
        </div>
        <p>Copyright 2023 - Tous droits réservés</p>
    </div>
</footer>

</body>
</html>
