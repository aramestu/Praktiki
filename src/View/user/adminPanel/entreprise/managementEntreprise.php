<div class="managementPanel">
    <div class="container VBox entityInformation">
        <div class="top">
            <label id="managementEntrepriseName"><?=htmlspecialchars($entreprise->getNomEntreprise())?></label>
            <div class="state">
                <label id="managementEntrepriseValidation">Entreprise <?=$entreprise->getEstValide() ? "validée" : "non validée"?></label>
                <div class="circle <?=$entreprise->getEstValide() ? "greenColor" : "yellowColor"?>"></div>
            </div>
        </div>
        <div class="down">
            <div class="VBox">
                <div id="managementEntrepriseSiret">
                    <label >Siret : </label>
                    <label><?=htmlspecialchars($entreprise->getSiret())?></label>
                </div>
                <div id="managementEntrepriseEffectif">
                    <label>Effectif : </label>
                    <label><?=htmlspecialchars($entreprise->getEffectifEntreprise())?></label>
                </div>
                <div id="managementEntrepriseCodePostal">
                    <label>Code Postal : </label>
                    <label><?=htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
                </div>

            </div>
            <div class="VBox">
                <div id="managementEntrepriseTelephone">
                    <label>Téléphone : </label>
                    <label><?=htmlspecialchars($entreprise->getTelephoneEntreprise())?></label>
                </div>
                <div id="managementEntrepriseMail">
                    <label>Mail : </label>
                    <label><a class="link" href="mailto:<?=$entreprise->getEmailEntreprise()?>"><?=htmlspecialchars($entreprise->getEmailEntreprise())?></a></label>
                </div>

            </div>
        </div>
    </div>
    <div class="managementActions">
        <a class="button" id="<?=$entreprise->getEstValide()? "invalidation":"validation"?>" href="frontController.php?action=<?=$entreprise->getEstValide()? "invalider":"valider"?>Entreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>"><?=$entreprise->getEstValide()? "Invalider":"Valider"?></a>
        <a class="button" id="suppression" href="frontController.php?action=supprimerEntreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>">Supprimer</a>
        <a class="button" id="modification" href="frontController.php?action=panelModificationEntreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>">Modifier</a>
    </div>
</div>
