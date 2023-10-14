<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Importer</title>
    <link rel="stylesheet" href="assets/css/button.css">
    <link rel="stylesheet" href="assets/css/style.css">




<body>
<div class="container">
<form enctype="multipart/form-data" action="frontController.php?action=importation" method="post">
    <div class="input-row">
        <label class="col-md-4 control-label">Choisir un fichier CSV</label>
        <input type="file" name="file" id="file" accept=".csv">
        <br />
        <br />
        <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
        <br />
    </div>
</form>
</body>
</html>
