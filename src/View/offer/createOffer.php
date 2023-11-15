<link rel="stylesheet" href="assets/css/connect.css">
<link rel="stylesheet" href="assets/css/create.css">
<script src="assets/javascript/showHideToggle.js"></script>

<div class="container" id="createOffer">
    <form method="post" action="frontController.php?controller=ExpPro&action=creerOffreDepuisFormulaire">
        <h2 id="remplaceBaliseLegend">Création d'Offre</h2>
        <div class="HBox">
            <div class="VBox">
                <p>
                    <label for="typeOffre">Type d'Offre</label>
                    <select name="typeOffre" id="typeOffre" required>
                        <option disabled selected value> -- Veuillez choisir une option -- </option>
                        <option value="offreNonDefini" >Non définie</option>
                        <option value="stage">Stage</option>
                        <option value="alternance">Alternance</option>
                    </select>
                </p>
                <div id="stageForm">
                    <!--<p>
                        <label for="titreStage">Titre du Stage</label>
                        <input type="text" name="titreStage" id="titreStage" required placeholder="Titre du stage" value=" " />
                        </p> -->
                    <p>
                        <label for="gratification">Gratification</label>
                        <input type="number" name="gratification" id="gratification" placeholder="gratification">
                    </p>
                </div>
                <div id="alternanceForm" class="hidden">
                    <!--<p>
                        <label for="titreAlternance">Titre de l'Alternance</label>
                        <input type="text" name="titreAlternance" id="titreAlternance" placeholder="Titre de l'alternance" value=" "/>
                        </p> -->
                </div>
                <p>
                    <label for="sujet">Sujet</label>
                    <input type="text" name="sujet" id="sujet" required placeholder="Sujet">
                </p>
                <p>
                    <label for="thematique">Thématique</label>
                    <input type="text" name="thematique" id="thematique" required placeholder="Thématique">
                </p>
                <p>
                    <label for="niveau">Niveau Requis</label>
                    <input type="text" name="niveau" id="niveau" required placeholder="BUT2/BUT3">
                </p>
                <p>
                    <label for="codePostal">Code Postal</label>
                    <input type="text" name="codePostal" id="codePostal" maxlength="5" required
                           placeholder="Code Postal">
                </p>
                <p>
                    <label for="adressePostale">Adresse postale</label>
                    <input type="text" name="adressePostale" id="adressePostale" required
                           placeholder="Adresse postale">
                </p>
                <p>
                    <label for="siret">Siret</label>
                    <input type="number" name="siret" id="siret" required placeholder="Siret" value="01234567890123">
                </p>
                <p>
                    <input type="submit" id="submitButton" value="Créer l'Offre">
                </p>
            </div>
            <div id="createOfferSpacerBIS"></div>
            <div class="VBox">
                <p>
                    <label for="taches">Tâches</label>
                    <textarea name="taches" id="taches" cols="30" rows="10" maxlength="500" required
                              placeholder="Tâches"></textarea>
                </p>
                <div class="HBox">
                    <p>
                        <label for="dateDebut">Date de Début</label>
                        <input type="date" name="dateDebut" id="dateDebut" required>
                    </p>
                    <p>
                        <label for="dateFin">Date de Fin</label>
                        <input type="date" name="dateFin" id="dateFin" required>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>