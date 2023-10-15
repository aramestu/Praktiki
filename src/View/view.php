<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $pagetitle ?></title>
    <link rel="icon" href="assets/images/favicon.ico">

 <link id="theme" rel="stylesheet" type="text/css" href="assets/css/mainIUT.css" />
    <link rel="stylesheet" href="assets/css/charte-graphique-UM.css">

    <script src="assets/javascript/navbar.js"></script>
</head>
<body>

<div id="transition-overlay"></div>

<header>

      <img id="logoToggle" href="#" class="logo" src="assets/images/LOGO_UM_filet-blanc.png" />

                    <div class="burger">
                        <span></span>
                    </div>

      <nav class="navbar">
                  <a href="frontController.php?action=home" class="nav-item" data-action="home">Accueil</a>
                  <a href="frontController.php?controller=ExpPro&action=getExpProByDefault" class="nav-item" data-action="alter">Offres</a>
                  <a href="frontController.php?action=contact" class="nav-item" data-action="contact">Contact</a>
                  <a href="frontController.php?action=connect" class="nav-item" data-action="connect">Connexion</a>

      </nav>
</header>

<main>
    <?php
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
