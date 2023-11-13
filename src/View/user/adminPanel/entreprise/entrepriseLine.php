<div class="container line <?= $entreprise->getEstValide() ? "greenHover" : "yellowHover" ?>">
    <div class="HBox containerDebutLine" title="Entreprise <?=$entreprise->getEstValide() ? "" : "non " ?>validée">
        <div class="circle<?=$entreprise->getEstValide() ? " greenColor" : " yellowColor"?>"></div>
        <label class="lineNomEntreprise"><?= htmlspecialchars($entreprise->getNomEntreprise())?></label>
    </div>
    <label class="lineCodePostalEntreprise"><?= htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
    <label class="lineTelephoneEntreprise"><a class="link" href="tel:<?=$entreprise->getTelephoneEntreprise()?>"><?=htmlspecialchars($entreprise->getTelephoneEntreprise())?></a></label>
    <label class="lineSiteWebEntreprise"><a class="link" href="https://<?= rawurldecode($entreprise->getSiteWebEntreprise())?>">Site web</a></label>
    <!--TODO: voir avec norman comment faire affichage -->
    <a class="button">Consulter</a>
</div>