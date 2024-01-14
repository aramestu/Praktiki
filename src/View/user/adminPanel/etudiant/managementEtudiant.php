<?php
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\AnneeUniversitaireRepository;
$anneeUniversitaire = (new AnneeUniversitaireRepository())->getCurrentAnneeUniversitaire();
$conventionValidee = (new EtudiantRepository())->conventionEtudiantEstValide($etudiant, $anneeUniversitaire->getIdAnneeUniversitaire());
$etudiantAConvention = (new EtudiantRepository())->etudiantAConvention($etudiant, $anneeUniversitaire);
$etudiantAAlternance = (new EtudiantRepository())->etudiantAAlternance($etudiant, $anneeUniversitaire);
?>

<div class="managementPanel">
    <div class="container VBox entityInformation">
        <div class="top">
            <label id="managementEtudiantName"><?=htmlspecialchars(strtoupper($etudiant->getNomEtudiant()) . " " .$etudiant->getPrenomEtudiant())?></label>
            <div class="state">
                <label id="managementEtudiantState"><?php
                                                        if($conventionValidee || $etudiantAAlternance){
                                                            echo "Procédure finalisée";
                                                        }elseif ($etudiantAConvention){
                                                            echo "En attente de convention";
                                                        }else{
                                                            echo "En recherche";
                                                        }
                                                    ?></label>
                <div class="circle <?php
                                        if($conventionValidee || $etudiantAAlternance){
                                            echo "greenColor";
                                        }elseif ($etudiantAConvention){
                                            echo "yellowColor";
                                        }else{
                                            echo "redColor";
                                        }
                                    ?>"></div>
            </div>
        </div>
        <div class="down">
            <div class="VBox">
                <div id="managementEtudiantNumEtudiant">
                    <label >Num Etudiant :</label>
                    <label><?=htmlspecialchars($etudiant->getNumEtudiant())?></label>
                </div>
                <div id="managementEtudiantTelephone">
                    <label>Téléphone :</label>
                    <label><?=htmlspecialchars($etudiant->getTelephoneEtudiant())?></label>
                </div>
                <div id="managementEtudiantCodePostal">
                    <label>Code Postal :</label>
                    <label><?=htmlspecialchars($etudiant->getCodePostalEtudiant())?></label>
                </div>

            </div>
            <div class="VBox">
                <div id="managementEtudiantMailUniv">
                    <label>Mail Univ :</label>
                    <label><a class="link" href="mailto:<?=$etudiant->getMailUniversitaireEtudiant()?>"><?=htmlspecialchars($etudiant->getMailUniversitaireEtudiant())?></a></label>
                </div>
                <div id="managementEtudiantMailPerso">
                    <label>Mail Perso :</label>
                    <label><a class="link" href="mailto:<?=$etudiant->getMailPersoEtudiant()?>"><?=htmlspecialchars($etudiant->getMailPersoEtudiant())?></a></label>
                </div>
            </div>
        </div>
    </div>
    <div class="managementActions">
        <a class="button" id="suppression" href="frontController.php?action=supprimerEtudiant&controller=PanelAdmin&numEtudiant=<?=rawurlencode($etudiant->getNumEtudiant())?>">Supprimer</a>
        <a class="button" id="modification" href="frontController.php?action=panelModificationEtudiant&controller=PanelAdmin&numEtudiant=<?=rawurlencode($etudiant->getNumEtudiant())?>">Modifier</a>
    </div>
</div>

