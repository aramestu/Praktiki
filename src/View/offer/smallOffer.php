<?php

use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
?>
<a href="frontController.php?controller=ExpPro&action=afficherOffre&experiencePro=<?php echo rawurlencode($expPro->getIdExperienceProfessionnel()) ?>"
   style="text-decoration:none">
    <div class="subContainer small <?php echo $expPro->getNomExperienceProfessionnel(); ?>">
        <div class="header">
            <div class="left">
                <p class="bold typeExpPro">
                    <label><?php
                    $expPro->getNomExperienceProfessionnel();
                    if ($expPro->getNomExperienceProfessionnel() == "Stalternance") {
                        echo "Non définie";
                    } else {
                        echo htmlspecialchars($expPro->getNomExperienceProfessionnel());
                    }
                    ?>
                    </label>
                </p>
                <p><?php echo AbstractExperienceProfessionnelRepository::getDelayDatePublication($expPro) ?></p>
            </div>
            <div class="right">
                <p>Du <?php echo htmlspecialchars($expPro->getDateDebutExperienceProfessionnel()); ?></p>
                <p>au <?php echo htmlspecialchars($expPro->getDateFinExperienceProfessionnel()); ?></p>
            </div>
        </div>
        <div class="information">
            <h3><?php echo htmlspecialchars($expPro->getSujetExperienceProfessionnel()); ?></h3>
            <p><?php $entreprise = (new EntrepriseRepository())->getById($expPro->getSiret());
                echo(htmlspecialchars($entreprise->getNomEntreprise()));
                ?></p>
            <p><span class="codePostalID"><?php echo htmlspecialchars($expPro->getCodePostalExperienceProfessionnel()); ?></span>
            </p>
        </div>
    </div>
</a>
