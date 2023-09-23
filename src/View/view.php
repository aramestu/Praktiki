<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/charte-graphique-UM.css">
</head>
<body>
<header>
      <a href="#" class="logo">Logo</a>

      <input type="checkbox" id="check" />
            <label for="check" class="icons">
              <i class="bx bx-menu" id="menu-icon"></i>
              <i class="bx bx-x" id="close-icon"></i>
            </label>

      <nav class="navbar">
        <a href="#" class="nav-item" style="--i: 0">Acceuil</a>
        <a href="#" class="nav-item" style="--i: 1">Alternance</a>
        <a href="#" class="nav-item" style="--i: 2">Stages</a>
        <a href="#" class="nav-item" style="--i: 3">Contact</a>
        <a href="#" class="nav-item" style="--i: 4">Connexion</a>
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
        <p>Lorick | Scrum Master</p>
        <p>Mathias | Product Owner</p>
        <p>Clément | Dev PHP</p>
        <p>Thibaut | Dev PHP</p>
        </div>
        <div class="VBox">
            <p>
                Site de SAE 2023 Semestre 3
            </p>
            </div>
    </div>
    <p>Copiright 2021</p>
    </div>
</footer>

</body>
</html>
