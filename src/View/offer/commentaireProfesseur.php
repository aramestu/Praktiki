<?php
/*
 https://webinfo.iutmontp.univ-montp2.fr/~audouyt/sae_web_s1/web/frontController.php?action=afficherFormulaireModification&controller=ExpPro&experiencePro=1
 */

?>
<link rel="stylesheet" href="assets/css/connect.css">
<script src="assets/javascript/showHideToggle.js"></script>

<div class="container">
    <form method="post" action="frontController.php?controller=ExpPro&action=ajouterCommentaire">

        <?php if(\App\SAE\Lib\ConnexionUtilisateur::estAdministrateur() || \App\SAE\Lib\ConnexionUtilisateur::estEnseignant()){ ?>
        <p>
            <label for="commentaireProfesseur">Commentaire Professeur</label>
            <textarea name="commentaireProfesseur" id="commentaireProfesseur" cols="30" rows="10" maxlength="500"
                      placeholder="Commentaire Professeur"><?php echo htmlspecialchars($CommentaireProfesseur); ?></textarea>
        </p>
        <?php } ?>

        <p>
            <input type="hidden" name="id"
                   value="<?php echo htmlspecialchars($ExperienceProfessionnel); ?>">
            <input type="hidden" name="typeOffre"
                   value="<?php echo htmlspecialchars($typeExperience); ?>">
            <input type="submit" value="Modifier l'offre">
        </p>
