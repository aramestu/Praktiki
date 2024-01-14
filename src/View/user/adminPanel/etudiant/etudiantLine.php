<?php

use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Lib\ConversionMajuscule;

$conventionValidee = (new EtudiantRepository())->conventionEtudiantEstValide($etudiant, $anneeUniversitaire->getIdAnneeUniversitaire());
$etudiantAConvention = (new EtudiantRepository())->etudiantAConvention($etudiant, $anneeUniversitaire);
$etudiantAAlternance = (new EtudiantRepository())->etudiantAAlternance($etudiant, $anneeUniversitaire);
?>
<div class="container line <?php
if ($conventionValidee || $etudiantAAlternance) {
    echo "greenHover";
} elseif ($etudiantAConvention) {
    echo "yellowHover";
} else {
    echo "redHover";
}
?>">
    <div class="HBox containerDebutLine" title="<?php
    if ($conventionValidee || $etudiantAAlternance) {
        echo "Procédure finalisée";
    } elseif ($etudiantAConvention) {
        echo "Convention de stage non validée";
    } else {
        echo "Cette étudiant n'a trouvé ni stage ni alternance";
    }
    ?>">
        <div class="circle  <?php
        if ($conventionValidee || $etudiantAAlternance) {
            echo "greenColor";
        } elseif ($etudiantAConvention) {
            echo "yellowColor";
        } else {
            echo "redColor";
        }
        ?>"></div>
        <label class="lineNomPrenomEtudiant"><?= htmlspecialchars(ConversionMajuscule::convertirEnMajuscules($etudiant->getNomEtudiant())) . " " . htmlspecialchars($etudiant->getPrenomEtudiant()) ?></label>
    </div>
    <label class="lineNumEtudiant"><?= htmlspecialchars($etudiant->getNumEtudiant()) ?></label>
    <label class="lineMailUniversitaireEtudidant"><a class="link"
                                                     href="mailto:<?= $etudiant->getMailUniversitaireEtudiant() ?>"><?= htmlspecialchars($etudiant->getMailUniversitaireEtudiant()) ?></a></label>
    <a class="button consulterButton"
       href="frontController.php?action=panelGestionEtudiant&controller=PanelAdmin&numEtudiant=<?= rawurlencode($etudiant->getNumEtudiant()) ?>">Consulter</a>
</div>