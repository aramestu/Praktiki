<link rel="stylesheet" href="assets/css/convention.css">
<link rel="stylesheet" href="assets/css/button.css">

<?php
$c = $convention;
$et = $etudiant;
?>
<form method="post" action="frontController.php?controller=Convention&action=modifierConvention">
    <div class="containerConvention">
        <h2>Etudiant : </h2>
        <div class="container-label-input">
            <label for="nomEtudiant">Nom de l'étudiant :</label>
            <input type="text" name="nomEtudiant" id="nomEtudiant" placeholder="Nom de l'étudiant" value="<?php echo htmlspecialchars($et->getNomEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomEtudiant">Prénom de l'étudiant :</label>
            <input type="text" name="prenomEtudiant" id="prenomEtudiant" placeholder="Prénom de l'étudiant" value="<?php echo htmlspecialchars($et->getPrenomEtudiant());?>">
        </div>
        <!--<div class="container-label-input">
            <label for="addresseEtudiant">Adresse de l'étudiant :</label>
            <input type="text" name="addresseEtudiant" id="addresseEtudiant" placeholder="Adresse de l'étudiant" value="">
        </div> -->
        <div class="container-label-input">
            <label for="telephoneEtudiant">Téléphone de l'étudiant :</label>
            <input type="text" name="telephoneEtudiant" id="telephoneEtudiant" placeholder="Téléphone de l'étudiant" value="<?php echo htmlspecialchars($et->getTelephoneEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="courrielEtudiant">Courriel de l'étudiant :</label>
            <input type="text" name="courrielEtudiant" id="courrielEtudiant" placeholder="Courriel de l'étudiant" value="<?php echo htmlspecialchars($et->getMailUniversitaireEtudiant());?>">
        </div>
        <div class="container-label-input">
            <label for="assuranceMaladie">Assurance maladie de l'étudiant :</label>
            <input type="text" name="assuranceMaladie" id="assuranceMaladie" placeholder="Assurance maladie de l'étudiant" value="<?php echo htmlspecialchars($c->getCaisseAssuranceMaladie());?>">
        </div>
    </div>

    <div class="containerConvention">
        <h2>Stage : </h2>
        <!--<div class="container-label-input">
            <label for="typeStage">Type du stage :</label>
            <input type="text" name="typeStage" id="typeStage" placeholder="Type du stage" value="Formation Initiale - Stage Obligatoire">
        </div>-->
        <div class="container-label-input">
            <label for="thematiqueStage">Thématique du stage :</label>
            <input type="text" name="thematiqueStage" id="thematiqueStage" placeholder="Thématique du stage" value="<?php echo htmlspecialchars($c->getThematiqueExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="sujetStage">Sujet du stage :</label>
            <input type="text" name="sujetStage" id="sujetStage" placeholder="Sujet du stage" value="<?php echo htmlspecialchars($c->getSujetExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="fonctionsEtTache">Fonctions et tâches du stage :</label>
            <input type="text" name="fonctionsEtTache" id="fonctionsEtTache" placeholder="Fonctions et tâches du stage" value="<?php echo htmlspecialchars($c->getTachesExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="competences">Compétence à développer ou à acquérir :</label>
            <input type="text" name="competences" id="competences" placeholder="Compétence à développer ou à acquérir" value="<?php echo htmlspecialchars($c->getCompetencesADevelopper());?>">
        </div>
        <div class="container-label-input">
            <!--TODO: changer les for -->
            <label for="periodeStage">Période du stage :</label>
            <h4>Début</h4>
            <input type="date" name="debutPeriodeStage" id="debutPeriodeStage" value="<?php echo htmlspecialchars($c->getDateDebutExperienceProfessionnel());?>">
            <h4>Fin</h4>
            <input type="date" name="finPeriodeStage" id="finPeriodeStage" value="<?php echo htmlspecialchars($c->getDateFinExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="dureeTravail">Durée de travail :</label>
            <input type="text" name="dureeTravail" id="dureeTravail" placeholder="Temps plein"  value="<?php echo htmlspecialchars($c->getDureeDeTravail());?>">
        </div>
        <div class="container-label-input">
            <label for="langueConvention">Langue de la convention :</label>
            <input type="text" name="langueConvention" id="langueConvention" placeholder="Langue de la convention"  value="<?php echo htmlspecialchars($c->getLanguesImpression());?>">
        </div>
        <!--<div class="container-label-input">
            <label for="gratificationStage">Gratification lors du stage :</label>
            <input type="number" name="gratificationStage" id="gratificationStage" placeholder="Gratification lors du stage"  value="<?php /*echo htmlspecialchars($c->getGratificationStage());*/?>">
        </div> -->
        <div class="container-label-input">
            <label for="origineStage">Origine du stage :</label>
            <input type="text" name="origineStage" id="origineStage" placeholder="Origine du stage"  value="<?php echo htmlspecialchars($c->getOrigineDeLaConvention());?>">
        </div>
        <div class="container-label-input">
            <label for="confidentialite">Confidentialité du sujet/thème du stage :</label>
            <input type="checkbox" name="confidentialite" id="confidentialite" placeholder="Confidentialité du sujet et du thème du Stage" checked value="true">
        </div>
        <div class="container-label-input">
            <label for="nombreHeuresHebdo">Nombre d'heures par semaine :</label>
            <input type="text" name="nombreHeuresHebdo" id="nombreHeuresHebdo" placeholder="Nombre d'heures par semaine" value="<?php echo htmlspecialchars($c->getNbHeuresHebdo());?>">
        </div>
        <div class="container-label-input">
            <label for="modaliteVersement">Modalité du versement :</label>
            <input type="text" name="modaliteVersement" id="modaliteVersement" placeholder="Modalité du versement" value="<?php echo htmlspecialchars($c->getModePaiement());?>">
        </div>
        <!--<div class="container-label-input">
            <label for="travailApresStage">Nature du travail après le stage :</label>
            <input type="text" name="travailApresStage" id="travailApresStage" placeholder="Nature du travail après le stage" value="Rapport de Stage">
        </div> -->
        <!--<div class="container-label-input">
            <label for="modaliteValidationStage">Modalité de validation du stage :</label>
            <input type="text" name="modaliteValidationStage" id="modaliteValidationStage" placeholder="Modalité de validation du stage" value="Soutenance">
        </div> -->
        <div class="container-label-input">
            <label for="dureeStage">Durée du stage :</label>
            <input type="number" name="dureeStage" id="dureeStage" placeholder="Durée du stage" value="<?php echo htmlspecialchars($c->getDureeExperienceProfessionnel());?>">
        </div>
    </div>

    <div class="containerConvention">
        <h2>Entreprise : </h2>
        <div class="container-label-input">
            <label for="nomEntreprise">Nom de l'entreprise :</label>
            <input type="text" name="nomEntreprise" id="nomEntreprise" placeholder="Nom de l'entreprise" value="<?php echo htmlspecialchars($c->getNomEntreprise());?>">
        </div>
        <div class="container-label-input">
            <label for="addresseEntreprise">Addresse de l'entreprise :</label>
            <input type="text" name="addresseEntreprise" id="addresseEntreprise" placeholder="Addresse de l'entreprise" value="<?php echo htmlspecialchars($c->getAdresseExperienceProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="nomTuteur">Nom du tuteur :</label>
            <input type="text" name="nomTuteur" id="nomTuteur" placeholder="Nom du tuteur" value="<?php echo htmlspecialchars($c->getNomTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomTuteur">Prénom du tuteur :</label>
            <input type="text" name="prenomTuteur" id="prenomTuteur" placeholder="Prénom du tuteur" value="<?php echo htmlspecialchars($c->getPrenomTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="professionTuteur">Profession du tuteur :</label>
            <input type="text" name="professionTuteur" id="professionTuteur" placeholder="Profession du tuteur" value="<?php echo htmlspecialchars($c->getFonctionTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="mailTuteur">Mail du tuteur :</label>
            <input type="text" name="mailTuteur" id="mailTuteur" placeholder="Mail du tuteur" value="<?php echo htmlspecialchars($c->getMailTuteurProfessionnel());?>">
        </div>
        <div class="container-label-input">
            <label for="nomSignataire">Nom du signataire :</label>
            <input type="text" name="nomSignataire" id="nomSignataire" placeholder="Nom du signataire" value="<?php echo htmlspecialchars($c->getNomSignataire());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomSignataire">Prénom du signataire :</label>
            <input type="text" name="prenomSignataire" id="prenomSignataire" placeholder="Prénom du signataire" value="<?php echo htmlspecialchars($c->getPrenomSignataire());?>">
        </div>
        <!--<div class="container-label-input">
            <label for="professionSignataire">Profession du signataire :</label>
            <input type="text" name="professionSignataire" id="professionSignataire" placeholder="Profession du signataire" value="">
        </div>-->
    </div>

    <div class="containerConvention">
        <h2>Etablissement : </h2>
        <div class="container-label-input">
            <label for="nomEnseignant">Nom de l'enseignant référant :</label>
            <input type="text" name="nomEnseignant" id="nomEnseignant" placeholder="Nom de l'enseignant référant" value="<?php echo htmlspecialchars($c->getNomEnseignant());?>">
        </div>
        <div class="container-label-input">
            <label for="prenomEnseignant">Prénom de l'enseignant référant :</label>
            <input type="text" name="prenomEnseignant" id="prenomEnseignant" placeholder="Prénom de l'enseignant référant" value="<?php echo htmlspecialchars($c->getPrenomEnseignant());?>">
        </div>
    </div>

    <div>
        <button class="button">Enregistrer le brouillon de la convention</button>
        <button class="button">Envoyer la convention</button>
        <input type="hidden" name="idConvention" value="<?php echo htmlspecialchars($c->getIdConvention());?>">
        <!--<input type="hidden" name="idStage" value="<?php //echo htmlspecialchars($c->getIdStage());?>">-->
        <input type="hidden" name="estSignee" value="true">
        <input type="hidden" name="estValidee" value="true">
    </div>
</form>