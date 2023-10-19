<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<?php
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\StageRepository;
?>

<div id="mainContainer" class="subContainer Stalternance">
    <div class="header">
        <div class="information">
            <p class="bold typeExpPro">à determiner</p>
            <p>du <?= htmlspecialchars($expPro->getDateDebut())?></p>
            <p>au <?= htmlspecialchars($expPro->getDateFin())?></p>
        </div>
        <div class="company">
            <h2><?php
                $entreprise = (new EntrepriseRepository())->get($expPro->getSiret());
                echo(htmlspecialchars($entreprise->getNom()));
                ?></h2>
            <label><?= htmlspecialchars($expPro->getAdresse())?> / <?= htmlspecialchars($expPro->getCodePostal())?></label>
        </div>

    </div>
    <ul>
        <li>Date de création de l'offre</li>
        <li>Effectifs : <?php echo(htmlspecialchars($entreprise->getEffectif())); ?></li>
        <li>Téléphone : <?php echo(htmlspecialchars($entreprise->getTelephone())); ?></li>
        <li><a href="https://<?php echo(htmlspecialchars($entreprise->getSiteWeb())); ?>" class="link">Site web</a></li>
    </ul>
    <div class="text">
        <p>Sujet : <?= htmlspecialchars($expPro->getSujet())?></p>
        <?php
            if ($last_element == "Stage") {
                ?>
                <p>Gratification : <?php
                                           $stage = (new StageRepository())->get($expPro->getID());
                                           echo(htmlspecialchars($stage->getGratification()));
                                           ?>€</p>
                                           <?php
                                               }
                                               ?>
        <p>Thématique : <?= htmlspecialchars($expPro->getThematique())?></p>
        <p>Tâches : <?= htmlspecialchars($expPro->getTaches())?></p>
    </div>
    <a href="frontController.php?controller=ExpPro&action=supprimerOffre&experiencePro=<?php echo rawurlencode($expPro->getId())?>"><img src="assets/images/bin-icon.png" id="deleteIcon"></a>
    <button id="apply">Postuler</button>
    <a href="frontController.php?controller=ExpPro&action=afficherFormulaireModification&experiencePro=<?php echo rawurlencode($expPro->getId())?>"><img src="assets/images/edit-icon.png" id="editIcon"></a>
    <a href="frontController.php?controller=ExpPro&action=getExpProByDefault"><img src="assets/images/back-icon.png" id="backIcon"></button> </a>
</div>
