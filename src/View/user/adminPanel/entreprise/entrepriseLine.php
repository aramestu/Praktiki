<div class="container line">
    <div>
        <div class="circle<?=$entreprise->getEstValide() ? " greenColor" : " orangeColor"?>"></div>
        <label class="lineNomEntreprise"><?= htmlspecialchars($entreprise->getNomEntreprise())?></label>
    </div>
    <label class="lineCodePostalEntreprise">Code Postal : <?= htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
    <label class="lineTelephoneEntreprise">Téléphone : <a href="tel:<?= htmlspecialchars($entreprise->getTelephoneEntreprise())?>"><?= htmlspecialchars($entreprise->getTelephoneEntreprise())?></a></label>
    <label class="lineSiteWebEntreprise"><a href="https://<?= htmlspecialchars($entreprise->getSiteWebEntreprise())?>">Site web</a></label>
    <a><button>Consulter</button></a>
</div>