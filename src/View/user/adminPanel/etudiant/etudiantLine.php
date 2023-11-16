<?php
use App\SAE\Model\Repository\EtudiantRepository;
$conventionValidee = (new EtudiantRepository())->conventionEtudiantEstValide($etudiant);
?>
<div class="container line <?php
                                if($conventionValidee){
                                    echo "greenHover";
                                }elseif ($conventionValidee===false){
                                    echo "yellowHover";
                                }else{
                                    echo "redHover";
                                }
                                ?>">
    <div class="HBox containerDebutLine" title="Convention <?=$conventionValidee? "":"non "?>validée">
        <div class="circle  <?php
                                if($conventionValidee){
                                    echo "greenColor";
                                }elseif ($conventionValidee===false){
                                    echo "yellowColor";
                                }else{
                                    echo "redColor";
                                }
                            ?>"></div>
        <label class="lineNomPrenomEtudiant"><?=htmlspecialchars(strtoupper($etudiant->getNomEtudiant())) . " " . htmlspecialchars($etudiant->getPrenomEtudiant())?></label>
    </div>
    <label class="lineNumEtudiant"><?=htmlspecialchars($etudiant->getNumEtudiant())?></label>
    <label class="lineMailUniversitaireEtudidant"><a class="link" href="mailto:<?=$etudiant->getMailUniversitaireEtudiant()?>"><?=htmlspecialchars($etudiant->getMailUniversitaireEtudiant())?></a></label>
    <a class="button">Consulter</a>
</div>