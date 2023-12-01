<link rel="stylesheet" href="assets/css/button.css">
<link rel="stylesheet" href="assets/css/style.css">
<div>
    <form enctype="multipart/form-data" action="frontController.php?action=importation" method="post">
        <div class="input-row">
            <label class="col-md-4 control-label">Choisir un fichier CSV</label>
            <img src="assets/images/upload-icon.png" id="uploadIcon" alt="uploadIcon">
            <input type="file" name="file" id="file" accept=".csv">
            <br>
            <br>
            <button type="submit" id="submit" name="import" class="button">Import</button>
            <br>
        </div>
    </form>
</div>