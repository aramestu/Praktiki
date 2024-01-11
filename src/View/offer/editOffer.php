<?php

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\StageRepository;
// https://webinfo.iutmontp.univ-montp2.fr/~audouyt/sae_web_s1/web/frontController.php?action=afficherFormulaireModification&controller=ExpPro&experiencePro=1
$gratification = 0;
$expPro = $experiencePro;
$typeExperience = 'Alternance';
if (is_a($expPro, 'App\SAE\Model\DataObject\Stage')) { // Si c'est un stage
    $typeExperience = 'Stage';
    $gratification = $expPro->getGratificationStage();
} else {//si c'est une offre non défini
    $typeExperience = 'OffreNonDefini';
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
                       value="<?php echo htmlspecialchars($gratification); ?>">
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
                   value="<?php echo htmlspecialchars($expPro->getSujetExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="thematique">Thématique</label>
            <input type="text" name="thematique" id="thematique" required placeholder="Thématique"
                   value="<?php echo htmlspecialchars($expPro->getThematiqueExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="taches">Tâches</label>
            <textarea name="taches" id="taches" cols="30" rows="10" maxlength="500" required
                      placeholder="Tâches"><?php echo htmlspecialchars($expPro->getTachesExperienceProfessionnel()); ?></textarea>
        </p>
        <!--<p>
            <label for="taches">Tâches</label>
            <input type="text" name="taches" id="taches" required placeholder="Tâches"
                   value="<?php echo htmlspecialchars($expPro->getTachesExperienceProfessionnel()); ?>">
        </p> -->
        <p>
            <label for="niveau">Niveau Requis</label>
            <input type="text" name="niveau" id="niveau" required placeholder="Niveau Requis"
                   value="<?php echo htmlspecialchars($expPro->getNiveauExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="codePostal">Code Postal</label>
            <input type="text" name="codePostal" id="codePostal" required placeholder="Code Postal" maxlength="5"
                   value="<?php echo htmlspecialchars($expPro->getCodePostalExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="adressePostale">Adresse postale</label>
            <input type="text" name="adressePostale" id="adressePostale" required placeholder="Adresse postale"
                   value="<?php echo htmlspecialchars($expPro->getAdresseExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="dateDebut">Date de Début</label>
            <input type="date" name="dateDebut" id="dateDebut" required
                   value="<?php echo htmlspecialchars($expPro->getDateDebutExperienceProfessionnel()); ?>">
        </p>
        <p>
            <label for="dateFin">Date de Fin</label>
            <input type="date" name="dateFin" id="dateFin" required
                   value="<?php echo htmlspecialchars($expPro->getDateFinExperienceProfessionnel()); ?>">
        </p>


        <p>
            <input type="hidden" name="siret" value="<?php echo htmlspecialchars($expPro->getSiret()); ?>">
            <input type="hidden" name="id"
                   value="<?php echo htmlspecialchars($expPro->getIdExperienceProfessionnel()); ?>">
            <input type="hidden" id="typeOffre" name="typeOffre"
                   value="<?php echo htmlspecialchars($typeExperience); ?>">
            <input type="submit" value="Modifier l'offre">
        </p>
    </form>
</div>