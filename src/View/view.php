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
    <p>
        Site de SAE 2023 Semestre 3
    </p>
</footer>
</body>
</html>
