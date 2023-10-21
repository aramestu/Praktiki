<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="assets/css/panel.css">
    <link rel="stylesheet" href="assets/css/button.css">

</head>
<body>
    <p><b>Bienvenue Mr. Trombettoni</b></p>
    <div class="main" id="panel">

    <div class="container" id="option">
        <p><a href=""><button type="button" class="btn btn-primary">Modifer Profil</button></a></p>
        <p><a href=""><button type="button" class="btn btn-primary">Liste des offres en Attentes</button></a></p>
        <p><a href=""><button type="button" class="btn btn-primary">Liste des entreprises en Attentes</button></a></p>
        <p><a href="frontController.php?action=getExpProByDefault&controller=ExpPro"><button type="button" class="btn btn-primary">Liste des offres</button></a></p>
        <p><a href=""><button type="button" class="btn btn-primary">Liste des Entreprise</button></a></p>
        <p><a href="frontController.php?action=import"><button type="button" class="btn btn-primary">Importation des données</button></a></p>
    </div>
    <div class="container" id="placeholder">
        <div class ="HBox">
            <p>Etudiant n° 1</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 2</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 3</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 4</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 5</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 6</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
        <div class ="HBox">
            <p>Etudiant n° 7</p> <p>Valide->vert/En cours->orange/Rouge->en recherche</p>
        </div>
    </div>
</div>
</body>
</html>