<?php
use App\SAE\Model\Repository\StageRepository;
$gratification = 0;
$expPro = StageRepository::getStageParId($id);
if(! is_null($expPro)){ // Si c'est un stage
    $gratification = $expPro->getGratification();
} else{

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
    <form method="post" action="frontController.php?action=modifierOffreDepuisFormulaire">
        <legend>Modification d'Offre</legend>
         <p>
            <label for="typeOffre">Type d'Offre</label>
            <select name="typeOffre" id="typeOffre" required>
                <option value="stage">Stage</option>
                <option value="alternance">Alternance</option>
            </select>
        </p>
        <div id="stageForm">
            <!--<p>
                <label for="titreStage">Titre du Stage</label>
                <input type="text" name="titreStage" id="titreStage" required placeholder="Titre du stage"/>
            </p> -->
            <p>
                <label for="gratification">Gratification</label>
                <input type="text" name="gratification" id="gratification" required placeholder="gratification" value="<?php echo $gratification;?>"/>
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
            <input type="text" name="sujet" id="sujet" required placeholder="Sujet" value="<?php echo $expPro->getSujet();?>"/>
        </p>
        <p>
            <label for="thematique">Thématique</label>
            <input type="text" name="thematique" id="thematique" required placeholder="Thématique" value="<?php echo $expPro->getThematique();?>"/>
        </p>
        <p>
            <label for="taches">Tâches</label>
            <input type="text" name="taches" id="taches" required placeholder="Tâches" value="<?php echo $expPro->getTaches();?>"/>
        </p>
        <p>
            <label for="codePostale">Code Postal</label>
            <input type="text" name="codePostal" id="codePostal" required placeholder="Code Postal" value="<?php echo $expPro->getCodePostal();?>"/>
        </p>
        <p>
            <label for="adresse">Adresse postale</label>
            <input type="text" name="adressePostale" id="adressePostale" required placeholder="Adresse postale" value="<?php echo $expPro->getAdresse();?>"/>
        </p>
        <p>
            <label for="dateDebut">Date de Début</label>
            <input type="date" name="dateDebut" id="dateDebut" required placeholder="Date de Début"value="<?php echo $expPro->getDateDebut();?>"/>
        </p>
        <p>
            <label for="dateFin">Date de Fin</label>
            <input type="date" name="dateFin" id="dateFin" required placeholder="Date de Fin" value="<?php echo $expPro->getDateFin();?>"/>
        </p>

        <p>
            <input type="submit" value="Modifier l'Offre" />
        </p>
    </form>
</div>

</body>

</html>
