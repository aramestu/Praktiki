<?php

use App\SAE\Model\DataObject\Stage;
use App\SAE\Model\Repository\StageRepository;
$gratification = 0;
$expPro = $experiencePro;
$nomExperience = 'alternance';
if(is_a($expPro, 'App\SAE\Model\DataObject\Stage')){ // Si c'est un stage
    $nomExperience = 'stage';
    $gratification = $expPro->getGratification();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modification d'Offre</title>
    <link rel="stylesheet" href="assets/css/connect.css">

    <script src="assets/javascript/passwordStrength.js"></script>
    <script src="assets/javascript/showHideToggle.js"></script>

</head>

<body>
<div class="container">
    <form method="post" action="frontController.php?controller=ExpPro&action=modifierDepuisFormulaire">
        <legend>Modification <?php echo htmlspecialchars($nomExperience);?></legend>
        <div id="stageForm">
            <!--<p>
                <label for="titreStage">Titre du Stage</label>
                <input type="text" name="titreStage" id="titreStage" required placeholder="Titre du stage"/>
            </p> -->
            <p>
                <label for="gratification">Gratification</label>
                <input type="number" name="gratification" id="gratification" required placeholder="gratification" value="<?php echo htmlspecialchars($gratification);?>"/>
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
            <input type="text" name="sujet" id="sujet" required placeholder="Sujet" value="<?php echo htmlspecialchars($expPro->getSujet());?>"/>
        </p>
        <p>
            <label for="thematique">Thématique</label>
            <input type="text" name="thematique" id="thematique" required placeholder="Thématique" value="<?php echo htmlspecialchars($expPro->getThematique());?>"/>
        </p>
        <p>
            <label for="taches">Tâches</label>
            <input type="text" name="taches" id="taches" required placeholder="Tâches" value="<?php echo htmlspecialchars($expPro->getTaches());?>"/>
        </p>
        <p>
            <label for="codePostale">Code Postal</label>
            <input type="text" name="codePostal" id="codePostal" required placeholder="Code Postal" maxlength="5" value="<?php echo htmlspecialchars($expPro->getCodePostal());?>"/>
        </p>
        <p>
            <label for="adresse">Adresse postale</label>
            <input type="text" name="adressePostale" id="adressePostale" required placeholder="Adresse postale" value="<?php echo htmlspecialchars($expPro->getAdresse());?>"/>
        </p>
        <p>
            <label for="dateDebut">Date de Début</label>
            <input type="date" name="dateDebut" id="dateDebut" required placeholder="Date de Début" value="<?php echo htmlspecialchars($expPro->getDateDebut());?>"/>
        </p>
        <p>
            <label for="dateFin">Date de Fin</label>
            <input type="date" name="dateFin" id="dateFin" required placeholder="Date de Fin" value="<?php echo htmlspecialchars($expPro->getDateFin());?>"/>
        </p>

        <p>
            <input type="hidden" name="siret" value="<?php echo htmlspecialchars($expPro->getSiret());?>"/>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($expPro->getId());?>"/>
            <input type="hidden" id="typeOffre" name="typeOffre" value="<?php echo htmlspecialchars($nomExperience);?>"/>
            <input type="submit" value="Modifier l'offre" />
        </p>
    </form>
</div>

</body>

</html>
