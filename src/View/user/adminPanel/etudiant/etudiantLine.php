<?php
use App\SAE\Model\Repository\EtudiantRepository;
$conventionValidee = (new EtudiantRepository())->conventionEtudiantEstValide($etudiant);
$etudiantAStage = (new EtudiantRepository())->etudiantAStage($etudiant);
$etudiantAAlternance = (new EtudiantRepository())->etudiantAAlternance($etudiant);
?>
<div class="container line <?php
                                if(($conventionValidee && $etudiantAStage) || $etudiantAAlternance){
                                    echo "greenHover";
                                }elseif ($etudiantAStage){
                                    echo "yellowHover";
                                }else{
                                    echo "redHover";
                                }
                                ?>">
    <div class="HBox containerDebutLine" title="<?php
                                                    if(($conventionValidee && $etudiantAStage) || $etudiantAAlternance){
                                                        echo "Procédure finalisée";
                                                    }elseif ($etudiantAStage){
                                                        echo "Convention de stage non validée";
                                                    }else{
                                                        echo "Cette étudiant n'a trouvé ni stage ni alternance";
                                                    }
                                                ?>">
        <div class="circle  <?php
                                if(($conventionValidee && $etudiantAStage) || $etudiantAAlternance){
                                    echo "greenColor";
                                }elseif ($etudiantAStage){
                                    echo "yellowColor";
                                }else{
                                    echo "redColor";
                                }
                            ?>"></div>
        <label class="lineNomPrenomEtudiant"><?=htmlspecialchars(strtoupper($etudiant->getNomEtudiant())) . " " . htmlspecialchars($etudiant->getPrenomEtudiant())?></label>
    </div>
    <label class="lineNumEtudiant"><?=htmlspecialchars($etudiant->getNumEtudiant())?></label>
    <label class="lineMailUniversitaireEtudidant"><a class="link" href="mailto:<?=$etudiant->getMailUniversitaireEtudiant()?>"><?=htmlspecialchars($etudiant->getMailUniversitaireEtudiant())?></a></label>
    <a class="button" href="frontController.php?action=panelGestionEtudiant&controller=PanelAdmin&numEtudiant=<?=rawurlencode($etudiant->getNumEtudiant())?>">Consulter</a>
</div>