<?php
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
?>
<div class="container line <?php
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

    </div>
    <label class="lineSujetExperienceProfessionnel"><?=$offre->getSujetExperienceProfessionnel()?></label>
</div>