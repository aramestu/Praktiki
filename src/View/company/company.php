<?php
$siteWeb = htmlspecialchars($entreprise->getSiteWebEntreprise());
$siret = $entreprise->getSiret();
?>
<link rel="stylesheet" href="assets/css/button.css">
<div class="container">
    <div class="header">
        <div class="company">
            <h2>
                <?php echo(htmlspecialchars($entreprise->getNomEntreprise()));?>
            </h2>
        </div>
    </div>
    <div class="text">
        <p>
            Siret : <?php echo(htmlspecialchars($siret));?>
        </p>
        <p>
            Code Postal : <?php echo(htmlspecialchars($entreprise->getCodePostalEntreprise()));?>
        </p>
        <p>
            Effectif : <?php echo(htmlspecialchars($entreprise->getEffectifEntreprise()));?>
        </p>
        <p>
            Numéro de téléphone : <?php echo(htmlspecialchars($entreprise->getTelephoneEntreprise()));?>
        </p>
        <p>
            Site web : <a href="https://<?php echo $siteWeb; ?>"> <?php echo $siteWeb;?> </a>
        </p>
    </div>
    <!--<?php /*if (! $entreprise->getEstValide()) :*/ ?>
        <a href="frontController.php?controller=Entreprise&action=accepter&siret=<?php //echo $siret; ?>" class="button">Accepter</a>
    <?php /*endif;*/ ?>
    <a href="frontController.php?controller=Entreprise&action=refuser&siret=<?php //echo $siret?>" class="button">Supprimer</a> -->
</div>