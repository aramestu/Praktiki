<link rel="stylesheet" href="assets/css/convention.css">
<link rel="stylesheet" href="assets/css/button.css">

<?php
$s = $stage;
$en = $entreprise;
$et = $etudiant;
$t = $tuteur;
$p = $prof;
?>
<form method="post" action="home.php">
    <div class="containerConvention">
        <h2>Etudiant : </h2>
        <div class="container-label-input">
            <label for="nomEtudiant">Nom de l'étudiant :</label>
            <input type="text" name="nomEtudiant" id="nomEtudiant" readonly="readonly" placeholder="Nom de l'étudiant" value="<?php echo htmlspecialchars($et->getNomEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomEtudiant">Prénom de l'étudiant :</label>
            <input type="text" name="prenomEtudiant" id="prenomEtudiant" readonly="readonly" placeholder="Prénom de l'étudiant" value="<?php echo htmlspecialchars($et->getPrenomEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="addresseEtudiant">Adresse de l'étudiant :</label>
            <input type="text" name="addresseEtudiant" id="addresseEtudiant" readonly="readonly" placeholder="Adresse de l'étudiant" value="<?php echo htmlspecialchars($et->getNomEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="telephoneEtudiant">Téléphone de l'étudiant :</label>
            <input type="text" name="telephoneEtudiant" id="telephoneEtudiant" readonly="readonly" placeholder="Téléphone de l'étudiant" value="<?php echo htmlspecialchars($et->getTelephoneEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="courrielEtudiant">Courriel de l'étudiant :</label>
            <input type="text" name="courrielEtudiant" id="courrielEtudiant" readonly="readonly" placeholder="Courriel de l'étudiant" value="<?php echo htmlspecialchars($et->getMailUniversitaireEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="assuranceMaladie">Caisse d'assurance maladie de l'étudiant :</label>
            <input type="text" name="assuranceMaladie" id="assuranceMaladie" readonly="readonly" placeholder="Assurance maladie de l'étudiant" value="Amelie">
        </div>
    </div>

    <div class="containerConvention">
        <h2>Stage et entreprise : </h2>
        <div class="container-label-input">
            <label for="typeStage">Type du stage :</label>
            <input type="text" name="typeStage" id="typeStage" readonly="readonly" placeholder="Type du stage" value="Formation Initiale - Stage Obligatoire">
        </div>
        <div class="container-label-input">
            <label for="thematiqueStage">Thématique du stage :</label>
            <input type="text" name="thematiqueStage" id="thematiqueStage" readonly="readonly" placeholder="Thématique du stage" value="<?php echo htmlspecialchars($s->getThematiqueExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="sujetStage">Sujet du stage :</label>
            <input type="text" name="sujetStage" id="sujetStage" readonly="readonly" placeholder="Sujet du stage" value="<?php echo htmlspecialchars($s->getSujetExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="fonctionsEtTache">Fonctions et tâches du stage :</label>
            <input type="text" name="fonctionsEtTache" id="fonctionsEtTache" readonly="readonly" placeholder="Fonctions et tâches du stage" value="<?php echo htmlspecialchars($s->getTachesExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="competences">Compétence à développer ou à acquérir :</label>
            <input type="text" name="competences" id="competences" placeholder="Compétence à développer ou à acquérir" value="">
        </div>
        <div class="container-label-input">
            <!--TODO: changer les for -->
            <label for="periodeStage">Période du stage :</label>
            <h4 for="debutPeriodeStage">Début</h4>
            <input type="date" name="debutPeriodeStage" id="debutPeriodeStage" readonly="readonly" value="<?php echo htmlspecialchars($s->getDateDebutExperienceProfessionnel());?>">
            <h4 for="finPeriodeStage">Fin</h4>
            <input type="date" name="finPeriodeStage" id="finPeriodeStage" readonly="readonly" value="<?php echo htmlspecialchars($s->getDateFinExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="langueConvention">Langue de la convention :</label>
            <input type="text" name="langueConvention" id="langueConvention" placeholder="Langue de la convention"  value="">
        </div>
        <div class="container-label-input">
            <label for="gratificationStage">Gratification lors du stage :</label>
            <input type="number" name="gratificationStage" id="gratificationStage" readonly="readonly" placeholder="Gratification lors du stage"  value="<?php echo htmlspecialchars($s->getGratificationStage());?>">
        </div>
        <div class="container-label-input">
            <label for="origineStage">Origine du stage :</label>
            <input type="text" name="origineStage" id="origineStage" placeholder="Origine du stage"  value="">
        </div>
        <div class="container-label-input">
            <label for="confidentialite">Confidentialité du sujet/thème du stage :</label>
            <input type="checkbox" name="confidentialite" id="confidentialite" placeholder="Confidentialité du sujet et du thème du Stage" value="">
        </div>
        <div class="container-label-input">
            <label for="nombreHeureHebdo">Nombre d'heures par semaine :</label>
            <input type="number" name="nombreHeureHebdo" id="nombreHeureHebdo" placeholder="Nombre d'heures par semaine" value="">
        </div>
        <div class="container-label-input">
            <label for="modaliteVersement">Modalité du versement :</label>
            <input type="text" name="modaliteVersement" id="modaliteVersement" placeholder="Modalité du versement" value="">
        </div>
        <div class="container-label-input">
            <label for="travailApresStage">Nature du travail après le stage :</label>
            <input type="text" name="travailApresStage" id="travailApresStage" readonly="readonly" placeholder="Nature du travail après le stage" value="Rapport de Stage">
        </div>
        <div class="container-label-input">
            <label for="modaliteValidationStage">Modalité de validation du stage :</label>
            <input type="text" name="modaliteValidationStage" id="modaliteValidationStage" readonly="readonly" placeholder="Modalité de validation du stage" value="Soutenance">
        </div>
        <div class="container-label-input">
            <label for="dureeStage">Durée du stage :</label>
            <input type="number" name="dureeStage" id="dureeStage" placeholder="Durée du stage" value="">
        </div>
        <div class="container-label-input">
            <label for="nomEntreprise">Nom de l'entreprise :</label>
            <input type="text" name="nomEntreprise" id="nomEntreprise" readonly="readonly" placeholder="Nom de l'entreprise" value="<?php echo htmlspecialchars($en->getNomEntreprise());?>">
        </div>
        <div class="container-label-input">
            <label for="addresseEntreprise">Addresse de l'entreprise :</label>
            <input type="text" name="addresseEntreprise" id="addresseEntreprise" readonly="readonly" placeholder="Addresse de l'entreprise" value="<?php echo htmlspecialchars($s->getAdresseExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="nomTuteur">Nom du tuteur :</label>
            <input type="text" name="nomTuteur" id="nomTuteur" readonly="readonly" placeholder="Nom du tuteur" value="<?php echo htmlspecialchars($t->getNomTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomTuteur">Prénom du tuteur :</label>
            <input type="text" name="prenomTuteur" id="prenomTuteur" readonly="readonly" placeholder="Prénom du tuteur" value="<?php echo htmlspecialchars($t->getPrenomTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="professionTuteur">Profession du tuteur :</label>
            <input type="text" name="professionTuteur" id="professionTuteur" readonly="readonly" placeholder="Profession du tuteur" value="<?php echo htmlspecialchars($t->getFonctionTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="mailTuteur">Mail du tuteur :</label>
            <input type="text" name="mailTuteur" id="mailTuteur" readonly="readonly" placeholder="Mail du tuteur" value="<?php echo htmlspecialchars($t->getMailTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="nomSignataire">Nom du signataire :</label>
            <input type="text" name="nomSignataire" id="nomSignataire" placeholder="Nom du signataire" value="">
        </div>
        <div class="container-label-input">
            <label for="prenomSignataire">Prénom du signataire :</label>
            <input type="text" name="prenomSignataire" id="prenomSignataire" placeholder="Prénom du signataire" value="">
        </div>
        <div class="container-label-input">
            <label for="professionSignataire">Profession du signataire :</label>
            <input type="text" name="professionSignataire" id="professionSignataire" placeholder="Profession du signataire" value="">
        </div>
    </div>

    <div class="containerConvention">
        <h2>Etablissement : </h2>
        <div class="container-label-input">
            <label for="nomEnseignant">Nom de l'enseignant référant :</label>
            <input type="text" name="nomEnseignant" id="nomEnseignant" readonly="readonly" placeholder="Nom de l'enseignant référant" value="<?php echo htmlspecialchars($p->getNomEnseignant());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomEnseignant">Prénom de l'enseignant référant :</label>
            <input type="text" name="prenomEnseignant" id="prenomEnseignant" readonly="readonly" placeholder="Prénom de l'enseignant référant" value="<?php echo htmlspecialchars($p->getPrenomEnseignant());?>">
        </div>
    </div>

    <div>
        <button class="button">Enregistrer le brouillon de la convention</button>
        <button class="button">Envoyer la convention</button>
    </div>
</form>