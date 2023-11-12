<div class="container line greenHover">
    <div class="HBox containerDebutLine">
        <div class="circle greenColor"></div>
        <label class="lineNomPrenomEtudiant"><?=htmlspecialchars(strtoupper($etudiant->getNomEtudiant())) . " " . htmlspecialchars($etudiant->getPrenomEtudiant())?></label>
    </div>
    <label class="lineNumEtudiant"><?=htmlspecialchars($etudiant->getNumEtudiant())?></label>
    <label class="lineMailUniversitaireEtudidant"><?=htmlspecialchars($etudiant->getMailUniversitaireEtudiant())?></label>
    <button>Consulter</button>
</div>