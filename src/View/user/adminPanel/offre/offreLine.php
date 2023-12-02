<?php
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
?>
<div class="container line offre <?php
                                $offre->getNomExperienceProfessionnel();
                                if ($offre->getNomExperienceProfessionnel() == "Stalternance") {
                                    echo "Non définie";
                                } else {
                                    echo htmlspecialchars($offre->getNomExperienceProfessionnel());
                                }
                                ?>">
    <div class="HBox containerDebutLine">
        <p class="bold typeExpPro"><?php
            $offre->getNomExperienceProfessionnel();
            if ($offre->getNomExperienceProfessionnel() == "Stalternance") {
                echo "Non définie";
            } else {
                echo htmlspecialchars($offre->getNomExperienceProfessionnel());
            }
            ?></p>
        <label class="lineSujetOffre"><?=htmlspecialchars($offre->getSujetExperienceProfessionnel())?></label>
    </div>
    <label class="lineEntrepriseOffre">
        <?php $entreprise = (new EntrepriseRepository())->getById($offre->getSiret());
        echo(htmlspecialchars($entreprise->getNomEntreprise()));
        ?>
    </label>
    <label class="lineDateOffre"><?php echo AbstractExperienceProfessionnelRepository::getDelayDatePublication($offre) ?></label>

    <a class="deleteButtonOrigin"><span></span></a>
    <a class="editButton" href="frontController.php?controller=ExpPro&action=afficherFormulaireModification&experiencePro=<?php echo rawurlencode($offre->getIdExperienceProfessionnel()) ?>"><span></span></a>
</div>