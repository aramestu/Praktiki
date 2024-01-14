<form enctype="multipart/form-data" action="frontController.php?action=importation" method="post">
    <div class="HBox">
        <div id="titleImport" class="title"><span>Importation des données</span></div>
    </div>
    <div class="VBox">
        <label for="typeOffre">Choisissez le type d'importation</label>
        <select name="typeOffre" id="typeOffre" required>
            <option value="" disabled selected hidden>Choisissez le type d'importation</option>
            <option value="Pstage">Pstage</option>
            <option value="Studea">Studea</option>
        </select>
        <div class="input-row">
            <label class="col-md-4 control-label">Choisir un fichier au format CSV</label>
            <input type="file" name="file" id="file" accept=".csv">
            <input type="hidden">
            <button type="submit" id="submit" name="import" class="button">Import</button>
        </div>
    </div>
</form>
