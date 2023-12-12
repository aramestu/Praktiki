<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/button.css">
<script src="assets/javascript/popUpDelete.js"></script>

<?php

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

/* IL Y AVAIT CELA A LA PLACE DE echo $expPro->getNomExperienceProfessionnel();
* DONC SI CA NE FONCTIONNE PLUS, C EST PEUT ETRE A CAUSE DE CA

$full_path = get_class($expPro);
$elements = explode('\\', $full_path);
$last_element = end($elements);
echo htmlspecialchars($last_element) */
?>

<div id="mainContainer" class="subContainer <?php echo $expPro->getNomExperienceProfessionnel(); ?>">
    <div class="header">
        <div class="information">
            <p class="bold typeExpPro"><label><?php echo $expPro->getNomExperienceProfessionnel(); ?></label></p>
            <p>du <?= htmlspecialchars($expPro->getDateDebutExperienceProfessionnel()) ?></p>
            <p>au <?= htmlspecialchars($expPro->getDateFinExperienceProfessionnel()) ?></p>
        </div>
        <div class="company">
            <h2 class="infoEntrepriseOffer"><?php
                $entreprise = (new EntrepriseRepository())->getById($expPro->getSiret());
                echo(htmlspecialchars($entreprise->getNomEntreprise()));
                ?></h2>
            <label class="codePostalID"><?= htmlspecialchars($expPro->getAdresseExperienceProfessionnel()) ?>
                / <?= htmlspecialchars($expPro->getCodePostalExperienceProfessionnel()) ?></label>
        </div>
    </div>
    <div id="main">
        <div id="infoOffer">
            <p><?php echo $expPro->getDatePublication() ?></p>
            <p class="bold">Sujet : <?= htmlspecialchars($expPro->getSujetExperienceProfessionnel()) ?></p>
            <?php
            if ($expPro->getNomExperienceProfessionnel() == "Stage") {
                ?>
                <p>Gratification : <?php
                    $stage = (new StageRepository())->getById($expPro->getIdExperienceProfessionnel());
                    echo(htmlspecialchars($stage->getGratificationStage()));
                    ?>€</p>
                <?php
            }
            ?>
            <p>Thématique : <?= htmlspecialchars($expPro->getThematiqueExperienceProfessionnel()) ?></p>
            <p>Tâches : <?= htmlspecialchars($expPro->getTachesExperienceProfessionnel()) ?></p>
            <p>Année minimum demandée : <?= htmlspecialchars($expPro->getNiveauExperienceProfessionnel()) ?></p>
        </div>

        <div id="infoCompany">
            <ul>
                <li>Effectifs : <?php echo(htmlspecialchars($entreprise->getEffectifEntreprise())); ?></li>
                <li>Téléphone : <?php echo(htmlspecialchars($entreprise->getTelephoneEntreprise())); ?></li>
                <li><a href="https://<?php echo(htmlspecialchars($entreprise->getSiteWebEntreprise())); ?>"
                       class="link">Site web</a></li>
            </ul>
        </div>
    </div>
    <?php
    if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte()==$entreprise->getSiret()) {
        ?>
    <a id="deleteButtonOrigin"><img src="assets/images/bin-icon.png" id="deleteIcon" alt="Bin"></a>
    <a href="frontController.php?controller=ExpPro&action=afficherFormulaireModification&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel())?>"><img
                src="assets/images/edit-icon.png" id="editIcon" alt="EditButton"></a>
    <?php
    }
    ?>




    <div class="HBox">
        <?php

    if(ConnexionUtilisateur::estEntreprise()){
        echo'<a href="frontController.php?controller=TDB&action=displayTDB" class="button secondary">Retour au tableau de bord</a> ';
    }
    else{
        echo'<a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="button secondary">Retour aux offres</a> ';
    }
    ?>
        <button id="apply" class="button">Postuler</button>
    </div>
</div>

<div id="popUpDelete" class="subContainer">
    <a id="popUpDeleteClose"><img src="assets/images/close-icon.png" id="closeIcon" alt="Close"></a>
    <div id="popUpDeleteContent">
        <p>Êtes-vous sûr de vouloir supprimer cette offre ?</p>
        <div class="HBox">
            <a class="button popUpDeleteButton" id="popUpDeleteNo">Non</a>
            <a class="button popUpDeleteButton" id="popUpDeleteYes"
               href="frontController.php?controller=ExpPro&action=supprimerOffre&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel()) ?>">Oui</a>
        </div>
    </div>
</div>