<form class="managementPanel" action="frontController.php?action=modifierEntreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>" method="post">
    <div class="container VBox entityInformation">
        <div class="top">
            <input id="managementEntrepriseName" name="nom" type="text" value="<?=htmlspecialchars($entreprise->getNomEntreprise())?>">
            <div class="state">
                <label id="managementEntrepriseValidation">Entreprise <?=$entreprise->getEstValide() ? "validée" : "non validée"?></label>
                <div class="circle <?=$entreprise->getEstValide() ? "greenColor" : "yellowColor"?>"></div>
            </div>
        </div>
        <div class="down">
            <div class="VBox">
                <div id="managementEntrepriseSiret">
                    <label for="siretInput">Siret : </label>
                    <input id="siretInput" name="siret" type="text" readonly value="<?=htmlspecialchars($entreprise->getSiret())?>">
                </div>
                <div id="managementEntrepriseEffectif">
                    <label for="effectifInput">Effectif : </label>
                    <input id="effectifInput" name="effectif" type="text" value="<?=htmlspecialchars($entreprise->getEffectifEntreprise())?>">
                </div>
                <div id="managementEntrepriseCodePostal">
                    <label for="codePostalInput">Code Postal : </label>
                    <input id="codePostalInput" name="codePostal" type="text" value="<?=htmlspecialchars($entreprise->getCodePostalEntreprise())?>">
                </div>

            </div>
            <div class="VBox">
                <div id="managementEntrepriseTelephone">
                    <label for="telephoneInput">Téléphone : </label>
                    <input id="telephoneInput" name="telephone" type="text" value="<?=htmlspecialchars($entreprise->getTelephoneEntreprise())?>">
                </div>
                <div id="managementEntrepriseMail">
                    <label for="mailInput">Mail : </label>
                    <input id="mailInput" name="mail" type="text" value="<?=htmlspecialchars($entreprise->getMailEntreprise())?>">
                </div>

            </div>
        </div>
    </div>
    <div class="managementActions">
        <input type="submit" value="Confirmer">
    </div>
</form>
