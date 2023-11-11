<div class="container line <?php
if ($entreprise->getEstValide() == 1){
    echo "valide";
}else{
    echo "nonValide";
}
?>
    ">
    <div class="HBox containerEtatNomEntreprise">
        <div class="circle<?=$entreprise->getEstValide() ? " greenColor" : " yellowColor"?>"></div>
        <label class="lineNomEntreprise"><?= htmlspecialchars($entreprise->getNomEntreprise())?></label>
    </div>
    <label class="lineCodePostalEntreprise"><?= htmlspecialchars($entreprise->getCodePostalEntreprise())?></label>
    <label class="lineTelephoneEntreprise"><a class="link" href="tel:<?= htmlspecialchars($entreprise->getTelephoneEntreprise())?>"><?= htmlspecialchars($entreprise->getTelephoneEntreprise())?></a></label>
    <label class="lineSiteWebEntreprise"><a class="link" href="https://<?= htmlspecialchars($entreprise->getSiteWebEntreprise())?>">Site web</a></label>
    <a><button>Consulter</button></a>
</div>