<!DOCTYPE html>
<html>
<head>
    <title>Comment importer un fichier CSV dans MySQL avec PHP</title>
</head>
<body>
<h3>Lire l'article sur : <a href="https://waytolearnx.com/2019/07/comment-importer-un-fichier-csv-dans-mysql-avec-php.html" target="_blank">Comment importer un fichier CSV dans MySQL avec PHP</a></h3>
<form enctype="multipart/form-data" action="import_csv.php" method="post">
    <div class="input-row">
        <label class="col-md-4 control-label">Choisir un fichier CSV</label>
        <input type="file" name="file" id="file" accept=".csv">
        <br />
        <br />
        <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
        <br />
    </div>
</form>
<?php
// Connect to database

include("../../../src/Config/Conf.php");
$tab = array("Departements", "Utilisateurs", "TuteurProfessionnel", "AnneeUniversitaire",
    "Etudiants", "Entreprises", "Enseignants", "ExperienceProfessionnel", "Stages",
    "Soutenances", "Alternances", "Inscriptions");
for ($i = 0; $i < 1; $i++) {
    $sql = "SELECT * FROM $tab[$i]";
    $result = mysqli_query(\App\SAE\Config\Conf::conn(), $sql);
}
?>
</body>
</html>