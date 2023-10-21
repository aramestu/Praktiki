<?php
use App\SAE\Model\Repository\EntrepriseRepository;

/* IL Y AVAIT CELA A LA PLACE DE echo $expPro->getNomExperienceProfessionnel();
* DONC SI CA NE FONCTIONNE PLUS, C EST PEUT ETRE A CAUSE DE CA

$full_path = get_class($expPro);
$elements = explode('\\', $full_path);
$last_element = end($elements);
echo htmlspecialchars($last_element) */

?>



<a href="frontController.php?controller=ExpPro&action=afficherOffre&experiencePro= <?php echo rawurlencode($expPro->getIdExperienceProfessionnel())?> " style="text-decoration:none" id="offerButton">
    <div class="subContainer small <?php echo $expPro->getNomExperienceProfessionnel(); ?>">
        <div class="header">
            <div class="left">
                <p class="bold typeExpPro"><?php echo $expPro->getNomExperienceProfessionnel();?></p>
                <p><?php echo $expPro->getDatePublication();?></p>
            </div>
            <div class="right">
                <p>Du <?php echo htmlspecialchars($expPro->getDateDebutExperienceProfessionnel());?></p>
                <p>au <?php echo htmlspecialchars($expPro->getDateFinExperienceProfessionnel());?></p>
            </div>
        </div>
        <div class="information">
            <h3><?php echo htmlspecialchars($expPro->getSujetExperienceProfessionnel());?></h3>
            <p><?php $entreprise = (new EntrepriseRepository())->get($expPro->getSiret());
                               echo(htmlspecialchars($entreprise->getNomEntreprise()));
                               ?></p>
            <p><img src="assets/images/map-pin-icon.png" class="mapPin"><label><?php echo htmlspecialchars($expPro->getCodePostalExperienceProfessionnel());?></label></p>
        </div>
    </div>
</a>