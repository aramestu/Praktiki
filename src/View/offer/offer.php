<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<?php
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\StageRepository;
?>

<div id="mainContainer" class="subContainer <?php
                                                                                $full_path = get_class($expPro);
                                                                                $elements = explode('\\', $full_path);
                                                                                $last_element = end($elements);
                                                                                echo htmlspecialchars($last_element)
                                                                                ?>">
    <div class="header">
        <div class="information">
            <p class="bold typeExpPro"> <?php
                $full_path = get_class($expPro);
                $elements = explode('\\', $full_path);
                $last_element = end($elements);
                echo htmlspecialchars($last_element)
                ?></p>
            <p>du <?= htmlspecialchars($expPro->getDateDebutExperienceProfessionnel())?></p>
            <p>au <?= htmlspecialchars($expPro->getDateFinExperienceProfessionnel())?></p>
        </div>
        <div class="company">
            <h2><?php
                $entreprise = (new EntrepriseRepository())->get($expPro->getSiret());
                echo(htmlspecialchars($entreprise->getNomEntreprise()));
                ?></h2>
            <label><?= htmlspecialchars($expPro->getAdresseExperienceProfessionnel())?> / <?= htmlspecialchars($expPro->getCodePostalExperienceProfessionnel())?></label>
        </div>

    </div>
    <ul>
        <li>Date de création de l'offre</li>
        <li>Effectifs : <?php echo(htmlspecialchars($entreprise->getEffectifEntreprise())); ?></li>
        <li>Téléphone : <?php echo(htmlspecialchars($entreprise->getTelephoneEntreprise())); ?></li>
        <li><a href="https://<?php echo(htmlspecialchars($entreprise->getSiteWebEntreprise())); ?>" class="link">Site web</a></li>
    </ul>
    <div class="text">
        <p>Sujet : <?= htmlspecialchars($expPro->getSujetExperienceProfessionnel())?></p>
        <?php
            if ($last_element == "Stage") {
                ?>
                <p>Gratification : <?php
                                           $stage = (new StageRepository())->get($expPro->getIdExperienceProfessionnel());
                                           echo(htmlspecialchars($stage->getGratificationStage()));
                                           ?>€</p>
                                           <?php
                                               }
                                               ?>
        <p>Thématique : <?= htmlspecialchars($expPro->getThematiqueExperienceProfessionnel())?></p>
        <p>Tâches : <?= htmlspecialchars($expPro->getTachesExperienceProfessionnel())?></p>
    </div>
    <a href="frontController.php?controller=ExpPro&action=supprimerOffre&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel())?>"><img src="assets/images/bin-icon.png" id="deleteIcon"></a>
    <button id="apply">Postuler</button>
    <a href="frontController.php?controller=ExpPro&action=afficherFormulaireModification&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel())?>"><img src="assets/images/edit-icon.png" id="editIcon"></a>
    <a href="frontController.php?controller=ExpPro&action=getExpProByDefault"><img src="assets/images/back-icon.png" id="backIcon"></button> </a>
</div>
