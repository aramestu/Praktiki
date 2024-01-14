<form class="managementPanel"
      action="frontController.php?action=modifierEtudiant&controller=PanelAdmin&numEtudiant=<?= rawurlencode($etudiant->getNumEtudiant()) ?>"
      method="post">
    <div class="container VBox entityInformation">
        <div class="top">
            <input id="managementEtudiantName" name="nom" type="text"
                   value="<?= htmlspecialchars($etudiant->getNomEtudiant()) ?>">
            <input id="managementEtudiantSurname" name="prenom" type="text"
                   value="<?= htmlspecialchars($etudiant->getPrenomEtudiant()) ?>">
        </div>
        <div class="down">
            <div class="VBox">
                <div id="managementEtudiantNumEtudiant">
                    <label for="numEtudiantInput">Num Etudiant :</label>
                    <input id="numEtudiantInput" name="numEtudiant" type="text" readonly
                           value="<?= htmlspecialchars($etudiant->getNumEtudiant()) ?>">
                </div>
                <div id="managementEtudiantTelephone">
                    <label for="telephoneInput">Téléphone :</label>
                    <input id="telephoneInput" name="telephone" type="text"
                           value="<?= htmlspecialchars($etudiant->getTelephoneEtudiant()) ?>">
                </div>
                <div id="managementEtudiantCodePostal">
                    <label for="codePostalInput">Code Postal :</label>
                    <input id="codePostalInput" name="codePostal" type="text"
                           value="<?= htmlspecialchars($etudiant->getCodePostalEtudiant()) ?>">
                </div>

            </div>
            <div class="VBox">
                <div id="managementEtudiantMailUniv">
                    <label for="mailUnivInput">Mail Univ :</label>
                    <input id="mailUnivInput" name="mailUniv" type="text"
                           value="<?= htmlspecialchars($etudiant->getMailUniversitaireEtudiant()) ?>">
                </div>
                <div id="managementEtudiantMailPerso">
                    <label for="mailPersoInput">Mail Perso :</label>
                    <input id="mailPersoInput" name="mailPerso" type="text"
                           value="<?= htmlspecialchars($etudiant->getMailPersoEtudiant()) ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="managementActions">
        <input type="submit" value="Confirmer">
    </div>
</form>