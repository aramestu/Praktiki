<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>

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
                  <a href="frontController.php?action=home" class="nav-item" data-action="home">Acceuil</a>
                  <a href="frontController.php?action=alter" class="nav-item" data-action="alter">Alternance</a>
                  <a href="frontController.php?action=stage" class="nav-item" data-action="stage">Stages</a>
                  <a href="frontController.php?action=contact" class="nav-item" data-action="contact">Contact</a>
                  <a href="frontController.php?action=connect" class="nav-item" data-action="connect">Connexion</a>
              </nav>
</header>

<script>
        // Get the current action from the URL
        const currentAction = window.location.search.split('=')[1];

        // Find the corresponding navigation item and add the 'active' class
        const navItems = document.querySelectorAll('.navbar .nav-item');
        navItems.forEach(item => {
            if (item.getAttribute('data-action') === currentAction) {
                item.classList.add('active');
            }
        });
    </script>

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
        <p>Lorick</p>
        <p>Mathias</p>
        <p>Clément</p>
        <p>Thibaut</p>
        <p>Norman</p>
        <p>Soren</p>
        </div>
        <div class="VBox">
            <p>
                Site de SAE 2023 Semestre 3
            </p>
            </div>
    </div>
    <p>Copiright 2023 - Tous droits réservés</p>
    </div>
</footer>

</body>
</html>
