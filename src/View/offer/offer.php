<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/button.css">
<script src="assets/javascript/popUpDelete.js"></script>
<script src="assets/javascript/map.js"></script>

<?php

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
?>

<div id="mainContainer" class="subContainer <?php echo $NomExperienceProfessionnel; ?>">
    <div class="header">
        <div class="information">
            <p class="bold typeExpPro"><label><?php echo htmlspecialchars($NomExperienceProfessionnel); ?></label></p>
            <p>du <?= htmlspecialchars($DateDebutExperienceProfessionnel) ?></p>
            <p>au <?= htmlspecialchars($DateFinExperienceProfessionnel) ?></p>
        </div>
        <div class="company">
            <h2 class="infoEntrepriseOffer"><?php
                echo(htmlspecialchars($NomEntreprise));
                ?></h2>
            <label class="codePostalID"><?= htmlspecialchars($AdresseExperienceProfessionnel) ?>
                / <?= htmlspecialchars($CodePostalExperienceProfessionnel) ?></label>
        </div>
    </div>
    <div id="main">
        <div id="infoOffer">
            <p><?php echo $DatePublication ?></p>
            <p class="bold">Sujet : <?= htmlspecialchars($SujetExperienceProfessionnel) ?></p>
            <?php
            if ($NomExperienceProfessionnel == "Stage") {
                ?>
                <p>Gratification : <?php
                    echo(htmlspecialchars($gratification));
                    ?>€</p>
                <?php
            }
            ?>
            <p>Thématique : <?= htmlspecialchars($ThematiqueExperienceProfessionnel) ?></p>
            <p>Tâches : <?= htmlspecialchars($TachesExperienceProfessionnel) ?></p>
            <p>Année minimum demandée : <?= htmlspecialchars($NiveauExperienceProfessionnel) ?></p>
            <?php if($CommentaireProfesseur != ""){ ?>
                <p> Commentaire professeur : <?php echo htmlspecialchars($CommentaireProfesseur); ?> </p> <?php } ?>
        </div>

        <div id="infoCompany">
            <ul>
                <li>Effectifs : <?php echo(htmlspecialchars($EffectifEntreprise)); ?></li>
                <li>Téléphone : <?php echo(htmlspecialchars($TelephoneEntreprise)); ?></li>
                <li><a href="https://<?php echo(htmlspecialchars($SiteWebEntreprise)); ?>"
                       class="link">Site web</a></li>
            </ul>
        </div>

    </div>
    <?php
        if(ConnexionUtilisateur::estEnseignant() || ConnexionUtilisateur::estAdministrateur()){
    ?>
    <a id="commentaireIcon" href="frontController.php?controller=ExpPro&action=afficherAjoutCommentaire&id=<?php echo htmlspecialchars($IdExperienceProfessionnel)?>&type=<?php echo htmlspecialchars($NomExperienceProfessionnel)?>">
        </a>
    <?php } ?>
    <?php
    if (ConnexionUtilisateur::estAdministrateur() || ConnexionUtilisateur::getLoginUtilisateurConnecte()==$Siret) {
        ?>
    <a id="deleteButtonOrigin"><img src="assets/images/bin-icon.png" id="deleteIcon" alt="Bin"></a>
    <a href="frontController.php?controller=ExpPro&action=afficherFormulaireModification&experiencePro=<?php echo rawurlencode($IdExperienceProfessionnel)?>"><img
                src="assets/images/edit-icon.png" id="editIcon" alt="EditButton"></a>
    <?php
    }
    ?>

    <div id="map"></div>
    <div class="HBox">
        <?php

    if(ConnexionUtilisateur::estEntreprise()){
        echo'<a href="frontController.php?controller=TDB&action=displayTDB" class="button secondary">Retour au tableau de bord</a> ';
    }
    else{
        echo'<a href="frontController.php?action=getExpProByDefault&controller=ExpPro" class="button secondary">Retour aux offres</a> ';
    }
    if(ConnexionUtilisateur::estEtudiant() || ConnexionUtilisateur::estAdministrateur()){
        echo '<button id="apply" class="button">Postuler</button>';
    }
    ?>
    </div>
</div>

<div id="popUpDelete" class="subContainer">
    <a id="popUpDeleteClose"><img src="assets/images/close-icon.png" id="closeIcon" alt="Close"></a>
    <div id="popUpDeleteContent">
        <p>Êtes-vous sûr de vouloir supprimer cette offre ?</p>
        <div class="HBox">
            <a class="button popUpDeleteButton" id="popUpDeleteNo">Non</a>
            <a class="button popUpDeleteButton" id="popUpDeleteYes"
               href="frontController.php?controller=ExpPro&action=supprimerOffre&experiencePro=<?php echo rawurlencode($IdExperienceProfessionnel) ?>">Oui</a>
        </div>
    </div>
</div>