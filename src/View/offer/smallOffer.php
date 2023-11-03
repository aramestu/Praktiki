<?php

use App\SAE\Model\Repository\EntrepriseRepository;
?>
<a href="frontController.php?controller=ExpPro&action=afficherOffre&experiencePro= <?php echo rawurlencode($expPro->getIdExperienceProfessionnel()) ?> "
   style="text-decoration:none" id="offerButton">
    <div class="subContainer small <?php echo $expPro->getNomExperienceProfessionnel(); ?>">
        <div class="header">
            <div class="left">
                <p class="bold typeExpPro"><?php
                    $expPro->getNomExperienceProfessionnel();
                    if ($expPro->getNomExperienceProfessionnel() == "Stalternance") {
                        echo "Non définie";
                    } else {
                        echo htmlspecialchars($expPro->getNomExperienceProfessionnel());
                    }
                    ?></p>
                <p><?php echo $expPro->getDatePublication(); ?></p>
            </div>
            <div class="right">
                <p>Du <?php echo htmlspecialchars($expPro->getDateDebutExperienceProfessionnel()); ?></p>
                <p>au <?php echo htmlspecialchars($expPro->getDateFinExperienceProfessionnel()); ?></p>
            </div>
        </div>
        <div class="information">
            <h3><?php echo htmlspecialchars($expPro->getSujetExperienceProfessionnel()); ?></h3>
            <p><?php $entreprise = (new EntrepriseRepository())->get($expPro->getSiret());
                echo(htmlspecialchars($entreprise->getNomEntreprise()));
                ?></p>
            <p><img src="assets/images/map-pin-icon.png"
                    class="mapPin"><label><?php echo htmlspecialchars($expPro->getCodePostalExperienceProfessionnel()); ?></label>
            </p>
        </div>
    </div>
</a>
