<div class="container line greenHover">
    <div class="HBox containerDebutLine" title="Convention validée">
        <div class="circle greenColor"></div>
        <label class="lineNomPrenomEtudiant"><?=htmlspecialchars(strtoupper($etudiant->getNomEtudiant())) . " " . htmlspecialchars($etudiant->getPrenomEtudiant())?></label>
    </div>
    <label class="lineNumEtudiant"><?=htmlspecialchars($etudiant->getNumEtudiant())?></label>
    <label class="lineMailUniversitaireEtudidant"><a class="link" href="mailto:<?=$etudiant->getMailUniversitaireEtudiant()?>"><?=htmlspecialchars($etudiant->getMailUniversitaireEtudiant())?></a></label>
    <a class="button">Consulter</a>
</div>