<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<?php
use App\SAE\Model\Repository\EntrepriseRepository;
?>

<div class="subContainer <?php
                                                                                $full_path = get_class($expPro);
                                                                                $elements = explode('\\', $full_path);
                                                                                $last_element = end($elements);
                                                                                echo $last_element
                                                                                ?>">
    <div class="header">
        <div class="information">
            <p class="bold typeExpPro"> <?php
                $full_path = get_class($expPro);
                $elements = explode('\\', $full_path);
                $last_element = end($elements);
                echo $last_element
                ?></p>
            <p>du <?= $expPro->getDateDebut()?></p>
            <p>au <?= $expPro->getDateFin()?></p>
        </div>
        <div class="company">
            <h2><?php
                $entreprise = (new EntrepriseRepository())->get($expPro->getSiret());
                echo($entreprise->getNom());
                ?></h2>
            <label><?= $expPro->getAdresse()?> / <?= $expPro->getCodePostal()?></label>
        </div>

    </div>
    <ul>
        <li>Date de création de l'offre</li>
        <li>Effectifs : <?php echo($entreprise->getEffectif()); ?></li>
        <li>Téléphone : <?php echo($entreprise->getTelephone()); ?></li>
        <li><a href="https://<?php echo($entreprise->getSiteWeb()); ?>" class="link">Site web</a></li>
    </ul>
    <div class="text">
        <p>Sujet : <?= $expPro->getSujet()?></p>
        <p>Thématique : <?= $expPro->getThematique()?></p>
        <p>Tâches : <?= $expPro->getTaches()?></p>
    </div>
    <a href="frontController.php?controller=ExpPro&action=getExpProByDefault"> <button id="retour">Retour</button> </a>
    <button id="apply">Postuler</button>
    <a href="frontController.php?controller=Main&action=afficherFormulaireModification&experiencePro=<?php echo $expPro->getId()?>"> <button id="retour">Modifier</button> </a>
    <a href="frontController.php?controller=Main&action=supprimerOffre&experiencePro=<?php echo $expPro->getId()?>"> <button id="retour">Supprimer</button> </a>
</div>
