<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<header>
    <nav>
        <a href="frontController.php?action=readAll">Voitures</a>
        <a href="frontController.php?action=readAll&controller=utilisateur">Utilisateurs</a>
        <a href="frontController.php?action=readAll&controller=trajet">Trajets</a>
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
