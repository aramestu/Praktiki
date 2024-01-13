<link rel="stylesheet" href="assets/css/convention.css">
<link rel="stylesheet" href="assets/css/button.css">

<?php
$c = $convention;
$et = $etudiant;
?>
<form method="post" action="frontController.php?controller=Convention&action=modifierConvention">
    <div class="container containerConvention">
        <h2>Etudiant : </h2>
        <div class="container-label-input">
            <label for="nomEtudiant">Nom de l'étudiant :</label>
            <input type="text" name="nomEtudiant" id="nomEtudiant" placeholder="Nom de l'étudiant" value="<?php echo htmlspecialchars($et->getNomEtudiant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="prenomEtudiant">Prénom de l'étudiant :</label>
            <input type="text" name="prenomEtudiant" id="prenomEtudiant" placeholder="Prénom de l'étudiant" value="<?php echo htmlspecialchars($et->getPrenomEtudiant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="telephoneEtudiant">Téléphone de l'étudiant :</label>
            <input type="text" name="telephoneEtudiant" id="telephoneEtudiant" placeholder="Téléphone de l'étudiant" value="<?php echo htmlspecialchars($et->getTelephoneEtudiant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="courrielEtudiant">Mail de l'étudiant :</label>
            <input type="text" name="courrielEtudiant" id="courrielEtudiant" placeholder="Mail de l'étudiant" value="<?php echo htmlspecialchars($et->getMailUniversitaireEtudiant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="caisseAssuranceMaladie">Assurance maladie de l'étudiant :</label>
            <input type="text" name="caisseAssuranceMaladie" id="caisseAssuranceMaladie" placeholder="Assurance maladie de l'étudiant" value="<?php echo htmlspecialchars($c->getCaisseAssuranceMaladie());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
    </div>

    <div class="container containerConvention">
        <h2>Stage : </h2>
        <div class="container-label-input">
            <label for="thematiqueExperienceProfessionnel">Thématique du stage :</label>
            <input type="text" name="thematiqueExperienceProfessionnel" id="thematiqueExperienceProfessionnel" placeholder="Thématique du stage" value="<?php echo htmlspecialchars($c->getThematiqueExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="sujetExperienceProfessionnel">Sujet du stage :</label>
            <input type="text" name="sujetExperienceProfessionnel" id="sujetExperienceProfessionnel" placeholder="Sujet du stage" value="<?php echo htmlspecialchars($c->getSujetExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="tachesExperienceProfessionnel">Fonctions et tâches du stage :</label>
            <input type="text" name="tachesExperienceProfessionnel" id="tachesExperienceProfessionnel" placeholder="Fonctions et tâches du stage" value="<?php echo htmlspecialchars($c->getTachesExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="competencesADevelopper">Compétence à développer ou à acquérir :</label>
            <input type="text" name="competencesADevelopper" id="competencesADevelopper" placeholder="Compétence à développer ou à acquérir" value="<?php echo htmlspecialchars($c->getCompetencesADevelopper());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label>Période du stage :</label>
            <h4>Début</h4>
            <input type="date" name="dateDebutExperienceProfessionnel" id="dateDebutExperienceProfessionnel" value="<?php echo htmlspecialchars($c->getDateDebutExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
            <h4>Fin</h4>
            <input type="date" name="dateFinExperienceProfessionnel" id="dateFinExperienceProfessionnel" value="<?php echo htmlspecialchars($c->getDateFinExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="dureeDeTravail">Durée de travail :</label>
            <input type="text" name="dureeDeTravail" id="dureeDeTravail" placeholder="Temps plein"  value="<?php echo htmlspecialchars($c->getDureeDeTravail());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="languesImpression">Langue de la convention :</label>
            <input type="text" name="languesImpression" id="languesImpression" placeholder="Langue de la convention"  value="<?php echo htmlspecialchars($c->getLanguesImpression());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="origineDeLaConvention">Origine du stage :</label>
            <input type="text" name="origineDeLaConvention" id="origineDeLaConvention" placeholder="Origine du stage"  value="<?php echo htmlspecialchars($c->getOrigineDeLaConvention());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="sujetEstConfidentiel">Confidentialité du sujet/thème du stage :</label>
            <input type="checkbox" name="sujetEstConfidentiel" id="sujetEstConfidentiel"  <?php echo ($c->getSujetEstConfidentiel()) ? "checked" : "";?> <?php if ($c->getEstFini()) echo 'disabled';?>>
        </div>
        <div class="container-label-input">
            <label for="nbHeuresHebdo">Nombre d'heures par semaine :</label>
            <input type="text" name="nbHeuresHebdo" id="nbHeuresHebdo" placeholder="Nombre d'heures par semaine" value="<?php echo htmlspecialchars($c->getNbHeuresHebdo());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="modePaiement">Modalité du versement :</label>
            <input type="text" name="modePaiement" id="modePaiement" placeholder="Modalité du versement" value="<?php echo htmlspecialchars($c->getModePaiement());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="dureeExperienceProfessionnel">Durée du stage :</label>
            <input type="number" name="dureeExperienceProfessionnel" id="dureeExperienceProfessionnel" placeholder="Durée du stage" value="<?php echo htmlspecialchars($c->getDureeExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="codePostalExperienceProfessionnel">Code postal du lieu du stage :</label>
            <input type="text" name="codePostalExperienceProfessionnel" id="codePostalExperienceProfessionnel" placeholder="Code postal du lieu du stage" value="<?php echo htmlspecialchars($c->getCodePostalExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="adresseExperienceProfessionnel">Adresse du lieu du stage :</label>
            <input type="text" name="adresseExperienceProfessionnel" id="adresseExperienceProfessionnel" placeholder="Adresse du lieu du stage" value="<?php echo htmlspecialchars($c->getAdresseExperienceProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
    </div>

    <div class="container containerConvention">
        <h2>Entreprise : </h2>
        <div class="container-label-input">
            <label for="nomEntreprise">Nom de l'entreprise :</label>
            <input type="text" name="nomEntreprise" id="nomEntreprise" placeholder="Nom de l'entreprise" value="<?php echo htmlspecialchars($c->getNomEntreprise());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="siret">Siret de l'entreprise :</label>
            <input type="text" name="siret" id="siret" placeholder="Siret de l'entreprise" value="<?php echo htmlspecialchars($c->getSiret());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="codePostalEntreprise">Code postal de l'entreprise :</label>
            <input type="text" name="codePostalEntreprise" id="codePostalEntreprise" placeholder="Code postal de l'entreprise" value="<?php echo htmlspecialchars($c->getCodePostalEntreprise());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="effectifEntreprise">Effectif de l'entreprise :</label>
            <input type="number" name="effectifEntreprise" id="effectifEntreprise" placeholder="Effectif de l'entreprise" value="<?php echo htmlspecialchars($c->getEffectifEntreprise());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="telephoneEntreprise">Telephone de l'entreprise :</label>
            <input type="text" name="telephoneEntreprise" id="telephoneEntreprise" placeholder="Telephone de l'entreprise" value="<?php echo htmlspecialchars($c->getTelephoneEntreprise());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="nomTuteurProfessionnel">Nom du tuteur :</label>
            <input type="text" name="nomTuteurProfessionnel" id="nomTuteurProfessionnel" placeholder="Nom du tuteur" value="<?php echo htmlspecialchars($c->getNomTuteurProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="prenomTuteurProfessionnel">Prénom du tuteur :</label>
            <input type="text" name="prenomTuteurProfessionnel" id="prenomTuteurProfessionnel" placeholder="Prénom du tuteur" value="<?php echo htmlspecialchars($c->getPrenomTuteurProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="fonctionTuteurProfessionnel">Profession du tuteur :</label>
            <input type="text" name="fonctionTuteurProfessionnel" id="fonctionTuteurProfessionnel" placeholder="Profession du tuteur" value="<?php echo htmlspecialchars($c->getFonctionTuteurProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="mailTuteurProfessionnel">Mail du tuteur :</label>
            <input type="text" name="mailTuteurProfessionnel" id="mailTuteurProfessionnel" placeholder="Mail du tuteur" value="<?php echo htmlspecialchars($c->getMailTuteurProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="telephoneTuteurProfessionnel">Téléphone du tuteur :</label>
            <input type="text" name="telephoneTuteurProfessionnel" id="telephoneTuteurProfessionnel" placeholder="Téléphone du tuteur" value="<?php echo htmlspecialchars($c->getTelephoneTuteurProfessionnel());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="nomSignataire">Nom du signataire :</label>
            <input type="text" name="nomSignataire" id="nomSignataire" placeholder="Nom du signataire" value="<?php echo htmlspecialchars($c->getNomSignataire());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="prenomSignataire">Prénom du signataire :</label>
            <input type="text" name="prenomSignataire" id="prenomSignataire" placeholder="Prénom du signataire" value="<?php echo htmlspecialchars($c->getPrenomSignataire());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
    </div>

    <div class="container containerConvention">
        <h2>Etablissement : </h2>
        <div class="container-label-input">
            <label for="nomEnseignant">Nom de l'enseignant référant :</label>
            <input type="text" name="nomEnseignant" id="nomEnseignant" placeholder="Nom de l'enseignant référant" value="<?php echo htmlspecialchars($c->getNomEnseignant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="prenomEnseignant">Prénom de l'enseignant référant :</label>
            <input type="text" name="prenomEnseignant" id="prenomEnseignant" placeholder="Prénom de l'enseignant référant" value="<?php echo htmlspecialchars($c->getPrenomEnseignant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
        <div class="container-label-input">
            <label for="mailEnseignant">Mail de l'enseignant référant :</label>
            <input type="text" name="mailEnseignant" id="mailEnseignant" placeholder="Mail de l'enseignant référant" value="<?php echo htmlspecialchars($c->getMailEnseignant());?>" <?php if ($c->getEstFini()) echo 'readonly';?>>
        </div>
    </div>

    <div>
        <button class="button">Enregistrer le brouillon de la convention</button>
        <input type="hidden" name="idConvention" value="<?php echo htmlspecialchars($c->getIdConvention());?>">
    </div>
</form>