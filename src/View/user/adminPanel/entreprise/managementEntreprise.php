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
                <label id="managementEntrepriseSiret">Siret : <?=htmlspecialchars($entreprise->getSiret())?></label>
                <label id="managementEntrepriseEffectif">Effectif : <?=htmlspecialchars($entreprise->getEffectifEntreprise())?></label>
                <label id="managementEntrepriseCodePostal">Code Postal : <?=htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
            </div>
            <div class="VBox">
                <label id="managementEntrepriseTelephone">Téléphone : <?=htmlspecialchars($entreprise->getTelephoneEntreprise())?></label>
                <label id="managementEntrepriseMail">Mail : <?=htmlspecialchars($entreprise->getEmailEntreprise())?></label>
            </div>
        </div>

    </div>
    <div class="managementActions">
        <a class="button" id="<?=$entreprise->getEstValide()? "invalidation":"validation"?>" href="frontController.php?action=<?=$entreprise->getEstValide()? "invalider":"valider"?>Entreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>"><?=$entreprise->getEstValide()? "Invalider":"Valider"?></a>
        <a class="button" id="suppression" href="frontController.php?action=supprimerEntreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>">Supprimer</a>
        <a class="button" id="modification">Modifier</a>
    </div>
</div>
