<?php

use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\StageRepository;

$gratif = 0;
$expPro = $experiencePro;
$typeExperience = 'alternance';
if (is_a($expPro, 'App\SAE\Model\DataObject\Stage')) { // Si c'est un stage
    $typeExperience = 'stage';
    $gratif=gratification;
} else {//si c'est une stalerternance
    $typeExperience = 'offreNonDefini';
}
?>
<link rel="stylesheet" href="assets/css/connect.css">
<script src="assets/javascript/showHideToggle.js"></script>

<div class="container">
    <form method="post" action="frontController.php?controller=ExpPro&action=modifierDepuisFormulaire">
        <h2 id="remplaceBaliseLegend">Modification <?php echo htmlspecialchars($typeExperience); ?></h2>
        <div id="stageForm">
            <!--<p>
                <label for="titreStage">Titre du Stage</label>
                <input type="text" name="titreStage" id="titreStage" required placeholder="Titre du stage"/>
            </p> -->
            <p>
                <label for="gratification">Gratification</label>
                <input type="number" name="gratification" id="gratification" required placeholder="gratification"
                       value="<?php echo htmlspecialchars($gratif); ?>">
            </p>
        </div>
        <!--<div id="alternanceForm" class="hidden">
            <p>
                <label for="titreAlternance">Titre de l'Alternance</label>
                <input type="text" name="titreAlternance" id="titreAlternance" placeholder="Titre de l'alternance" />
            </p>
        </div> -->

        <p>
            <label for="sujet">Sujet</label>
            <input type="text" name="sujet" id="sujet" required placeholder="Sujet"
                   value="<?php echo htmlspecialchars($SujetExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="thematique">Thématique</label>
            <input type="text" name="thematique" id="thematique" required placeholder="Thématique"
                   value="<?php echo htmlspecialchars($ThematiqueExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="taches">Tâches</label>
            <input type="text" name="taches" id="taches" required placeholder="Tâches"
                   value="<?php echo htmlspecialchars($TachesExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="niveau">Niveau Requis</label>
            <select name="niveau" id="niveau" required>
                <option disabled value> -- Veuillez choisir une option -- </option>
                <option value="BUT2" <?php if (htmlspecialchars($NiveauExperienceProfessionnel) == "BUT2") echo "selected"; ?>>BUT2</option>
                <option value="BUT3" <?php if (htmlspecialchars($NiveauExperienceProfessionnel) == "BUT3") echo "selected"; ?>>BUT3</option>
            </select>
        </p>
        <p>
            <label for="codePostal">Code Postal</label>
            <input type="text" name="codePostal" id="codePostal" required placeholder="Code Postal" maxlength="5"
                   value="<?php echo htmlspecialchars($CodePostalExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="adressePostale">Adresse postale</label>
            <input type="text" name="adressePostale" id="adressePostale" required placeholder="Adresse postale"
                   value="<?php echo htmlspecialchars($AdresseExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="dateDebut">Date de Début</label>
            <input type="date" name="dateDebut" id="dateDebut" required
                   value="<?php echo htmlspecialchars($DateDebutExperienceProfessionnel); ?>">
        </p>
        <p>
            <label for="dateFin">Date de Fin</label>
            <input type="date" name="dateFin" id="dateFin" required
                   value="<?php echo htmlspecialchars($DateFinExperienceProfessionnel); ?>">
        </p>

        <p>
            <input type="hidden" name="id"
                   value="<?= htmlspecialchars($IdExperienceProfessionnel); ?>">
            <input type="hidden" id="typeOffre" name="typeOffre"
                   value="<?= htmlspecialchars($typeExperience); ?>">
            <input type="submit" value="Modifier l'offre">
        </p>
    </form>
</div>