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

    <script src="assets/javascript/navbar.js"></script>
    <link rel="stylesheet" href="assets/css/resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
         echo'<a href="frontController.php?action=contact" class="nav-item" data-action="contact">Contact</a>';
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
