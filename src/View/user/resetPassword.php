<link rel="stylesheet" href="assets/css/connect.css">
<script src="assets/javascript/passwordStrength.js"></script>

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Changement de mot de passe</h2>
        <?php
        if(\App\SAE\Lib\ConnexionUtilisateur::estEntreprise()){
            ?>
            <input type="hidden" name="siret" value=<?=htmlspecialchars($user->getSiret()) ?>>
            <label for="ancienMdp">Ancien mot de passe</label>
            <input type="password" name="ancienMdp" id="ancienNewMdp" required placeholder="mot de passe">
                <label for="newPassword">Nouveau mot de passe</label>
            <div class="password-input">
                <input type="password" name="newPassword" id="password" required placeholder="mot de passe">
                <div class="password-strength">
                    <div class="strength-bar"></div>
                </div>
                <p id="passwordHelp">Entrez un mot de passe</p>
                <button type="button" id="showPassword"><img id="showPasswordIconRegister" src="assets/images/eye-icon.png"
                                                             alt="ShowPassword"></button>
            </div>
            <label for="confirmNewMdp">Confirmer le mot de passe</label>
            <input type="password" name="confirmNewMdp" id="confirmNewMdp" required placeholder="mot de passe">
        <?php
        }else{
        ?>
        <input type="hidden" name="siret" value="<?php echo $_GET["siret"] ?>">
        <p>
            <label for="newPassword">Nouveau mot de passe</label>
        <div class="password-input">
            <input type="password" name="newPassword" id="password" required placeholder="mot de passe">
            <div class="password-strength">
                <div class="strength-bar"></div>
            </div>
            <p id="passwordHelp">Entrez un mot de passe</p>
            <button type="button" id="showPassword"><img id="showPasswordIconRegister" src="assets/images/eye-icon.png"
                                                         alt="ShowPassword"></button>
        </div>
        <label for="confirmNewMdp">Confirmer le mot de passe</label>
        <input type="password" name="confirmNewMdp" id="confirmNewMdp" required placeholder="mot de passe">
            <?php
        }
        ?>
        <p>
            <input type="hidden" name="action" value="resetPassword">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Valider">
        </p>
    </form>
</div>