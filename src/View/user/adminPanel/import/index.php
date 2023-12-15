<div class="HBox">
    <div id="titleImport" class="title"><span>Importation des données</span></div>
</div>
<div class="VBox">
    <form enctype="multipart/form-data" action="frontController.php?action=importation" method="post">
        <div class="input-row">
            <label class="col-md-4 control-label">Choisir un fichier au format CSV </label>
            <input type="file" name="file" id="file" accept=".csv">
            <br>
            <br>
            <button type="submit" id="submit" name="import" class="button">Import</button>
            <br>
        </div>
    </form>
</div>