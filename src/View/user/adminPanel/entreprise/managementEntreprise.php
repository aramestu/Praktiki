<div class="managementPanel">
    <div class="container VBox entityInformation">
        <div class="top">
            <label id="managementEntrepriseName"><?=htmlspecialchars($entreprise->getNomEntreprise())?></label>
            <div class="state">
                <label id="managementEntrepriseValidation">Entreprise <?=$entreprise->getEstValide() ? "validée" : "non validée"?></label>
                <div class="circle <?=$entreprise->getEstValide() ? "greenColor" : "yellowColor"?>"></div>
            </div>
        </div>
        <label id="managementEntrepriseSiret">Siret : <?=htmlspecialchars($entreprise->getSiret())?></label>
        <label id="managementEntrepriseCodePostal">Code Postal : <?=htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
        <label id="managementEntrepriseEffectif">effectif : <?=htmlspecialchars($entreprise->getEffectifEntreprise())?></label>
        <label id="managementEntrepriseTelephone">téléphone : <?=htmlspecialchars($entreprise->getTelephoneEntreprise())?></label>
        <label id="managementEntrepriseMail">mail : <?=htmlspecialchars($entreprise->getEmailEntreprise())?></label>
    </div>
    <div class="managementActions">
        <a class="button" href="frontController.php?action=<?=$entreprise->getEstValide()? "invalider":"valider"?>Entreprise&controller=PanelAdmin&siret=<?=rawurlencode($entreprise->getSiret())?>"><?=$entreprise->getEstValide()? "Invalider":"Valider"?></a>
        <a class="button">Supprimer</a>
        <a class="button">Modifier</a>
    </div>
</div>
