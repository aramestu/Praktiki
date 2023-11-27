<?php

namespace App\SAE\Model\DataObject;

class Convention extends AbstractDataObject {

    private string $idConvention;
    private string $mailEnseignant;
    private string $nomEnseignant;
    private string $prenomEnseignant;
    private string $competencesADevelopper;
    private string $dureeDeTravail;
    private string $languesImpression;
    private string $origineDeLaConvention;
    private bool $sujetEstConfidentiel;
    private string $nbHeuresHebdo;
    private string $modePaiement;
    private string $dureeExperienceProfessionnel;
    private string $caisseAssuranceMaladie;
    private string $mailTuteurProfessionnel;
    private string $prenomTuteurProfessionnel;
    private string $nomTuteurProfessionnel;
    private string $fonctionTuteurProfessionnel;
    private string $telephoneTuteurProfessionnel;
    private string $sujetExperienceProfessionnel;
    private string $thematiqueExperienceProfessionnel;
    private string $tachesExperienceProfessionnel;
    private string $codePostalExperienceProfessionnel;
    private string $adresseExperienceProfessionnel;
    private string $dateDebutExperienceProfessionnel;
    private string $dateFinExperienceProfessionnel;
    private string $nomSignataire;
    private string $prenomSignataire;
    private string $siret;
    private string $nomEntreprise;
    private string $codePostalEntreprise;
    private string $effectifEntreprise;
    private string $telephoneEntreprise;
    private bool $estFini;
    private bool $estValidee;

    /**
     * @param string $mailEnseignant
     * @param string $nomEnseignant
     * @param string $prenomEnseignant
     * @param string $competencesADevelopper
     * @param string $dureeDeTravail
     * @param string $languesImpression
     * @param string $origineDeLaConvention
     * @param bool $sujetEstConfidentiel
     * @param string $nbHeuresHebdo
     * @param string $modePaiement
     * @param string $dureeExperienceProfessionnel
     * @param string $caisseAssuranceMaladie
     * @param string $mailTuteurProfessionnel
     * @param string $prenomTuteurProfessionnel
     * @param string $nomTuteurProfessionnel
     * @param string $fonctionTuteurProfessionnel
     * @param string $telephoneTuteurProfessionnel
     * @param string $sujetExperienceProfessionnel
     * @param string $thematiqueExperienceProfessionnel
     * @param string $tachesExperienceProfessionnel
     * @param string $codePostalExperienceProfessionnel
     * @param string $adresseExperienceProfessionnel
     * @param string $dateDebutExperienceProfessionnel
     * @param string $dateFinExperienceProfessionnel
     * @param string $nomSignataire
     * @param string $prenomSignataire
     * @param string $siret
     * @param string $nomEntreprise
     * @param string $codePostalEntreprise
     * @param string $effectifEntreprise
     * @param string $telephoneEntreprise
     * @param bool $estSignee
     * @param bool $estValidee
     */
    public function __construct(string $mailEnseignant, string $nomEnseignant, string $prenomEnseignant, string $competencesADevelopper, string $dureeDeTravail, string $languesImpression, string $origineDeLaConvention, bool $sujetEstConfidentiel, string $nbHeuresHebdo, string $modePaiement, string $dureeExperienceProfessionnel, string $caisseAssuranceMaladie, string $mailTuteurProfessionnel, string $prenomTuteurProfessionnel, string $nomTuteurProfessionnel, string $fonctionTuteurProfessionnel, string $telephoneTuteurProfessionnel, string $sujetExperienceProfessionnel, string $thematiqueExperienceProfessionnel, string $tachesExperienceProfessionnel, string $codePostalExperienceProfessionnel, string $adresseExperienceProfessionnel, string $dateDebutExperienceProfessionnel, string $dateFinExperienceProfessionnel, string $nomSignataire, string $prenomSignataire, string $siret, string $nomEntreprise, string $codePostalEntreprise, string $effectifEntreprise, string $telephoneEntreprise, bool $estFini, bool $estValidee)
    {
        $this->mailEnseignant = $mailEnseignant;
        $this->nomEnseignant = $nomEnseignant;
        $this->prenomEnseignant = $prenomEnseignant;
        $this->competencesADevelopper = $competencesADevelopper;
        $this->dureeDeTravail = $dureeDeTravail;
        $this->languesImpression = $languesImpression;
        $this->origineDeLaConvention = $origineDeLaConvention;
        $this->sujetEstConfidentiel = $sujetEstConfidentiel;
        $this->nbHeuresHebdo = $nbHeuresHebdo;
        $this->modePaiement = $modePaiement;
        $this->dureeExperienceProfessionnel = $dureeExperienceProfessionnel;
        $this->caisseAssuranceMaladie = $caisseAssuranceMaladie;
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
        $this->telephoneTuteurProfessionnel = $telephoneTuteurProfessionnel;
        $this->sujetExperienceProfessionnel = $sujetExperienceProfessionnel;
        $this->thematiqueExperienceProfessionnel = $thematiqueExperienceProfessionnel;
        $this->tachesExperienceProfessionnel = $tachesExperienceProfessionnel;
        $this->codePostalExperienceProfessionnel = $codePostalExperienceProfessionnel;
        $this->adresseExperienceProfessionnel = $adresseExperienceProfessionnel;
        $this->dateDebutExperienceProfessionnel = $dateDebutExperienceProfessionnel;
        $this->dateFinExperienceProfessionnel = $dateFinExperienceProfessionnel;
        $this->nomSignataire = $nomSignataire;
        $this->prenomSignataire = $prenomSignataire;
        $this->siret = $siret;
        $this->nomEntreprise = $nomEntreprise;
        $this->codePostalEntreprise = $codePostalEntreprise;
        $this->effectifEntreprise = $effectifEntreprise;
        $this->telephoneEntreprise = $telephoneEntreprise;
        $this->estFini = $estFini;
        $this->estValidee = $estValidee;
    }


    public function getIdConvention(): string
    {
        return $this->idConvention;
    }

    public function setIdConvention(string $idConvention): void
    {
        $this->idConvention = $idConvention;
    }

    public function getCompetencesADevelopper(): string
    {
        return $this->competencesADevelopper;
    }

    public function setCompetencesADevelopper(string $competencesADevelopper): void
    {
        $this->competencesADevelopper = $competencesADevelopper;
    }

    public function getLanguesImpression(): string
    {
        return $this->languesImpression;
    }

    public function setLanguesImpression(string $languesImpression): void
    {
        $this->languesImpression = $languesImpression;
    }

    public function getNbHeuresHebdo(): string
    {
        return $this->nbHeuresHebdo;
    }

    public function setNbHeuresHebdo(string $nbHeuresHebdo): void
    {
        $this->nbHeuresHebdo = $nbHeuresHebdo;
    }

    public function getModePaiement(): string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): void
    {
        $this->modePaiement = $modePaiement;
    }

    public function getEstFini(): bool
    {
        return ($this->estFini == 1);
    }

    public function setEstFini(bool $estFini): void
    {
        $this->estFini = $estFini;
    }

    public function getDureeDeTravail(): string
    {
        return $this->dureeDeTravail;
    }

    public function setDureeDeTravail(string $dureeDeTravail): void
    {
        $this->dureeDeTravail = $dureeDeTravail;
    }

    public function getOrigineDeLaConvention(): string
    {
        return $this->origineDeLaConvention;
    }

    public function setOrigineDeLaConvention(string $origineDeLaConvention): void
    {
        $this->origineDeLaConvention = $origineDeLaConvention;
    }

    public function isSujetEstConfidentiel(): bool
    {
        return ($this->sujetEstConfidentiel == 1);
    }

    public function setSujetEstConfidentiel(bool $sujetEstConfidentiel): void
    {
        $this->sujetEstConfidentiel = $sujetEstConfidentiel;
    }

    public function getDureeExperienceProfessionnel(): string
    {
        return $this->dureeExperienceProfessionnel;
    }

    public function setDureeExperienceProfessionnel(string $dureeExperienceProfessionnel): void
    {
        $this->dureeExperienceProfessionnel = $dureeExperienceProfessionnel;
    }

    public function getCaisseAssuranceMaladie(): string
    {
        return $this->caisseAssuranceMaladie;
    }

    public function setCaisseAssuranceMaladie(string $caisseAssuranceMaladie): void
    {
        $this->caisseAssuranceMaladie = $caisseAssuranceMaladie;
    }

    public function getMailEnseignant(): string
    {
        return $this->mailEnseignant;
    }

    public function setMailEnseignant(string $mailEnseignant): void
    {
        $this->mailEnseignant = $mailEnseignant;
    }

    public function getNomEnseignant(): string
    {
        return $this->nomEnseignant;
    }

    public function setNomEnseignant(string $nomEnseignant): void
    {
        $this->nomEnseignant = $nomEnseignant;
    }

    public function getPrenomEnseignant(): string
    {
        return $this->prenomEnseignant;
    }

    public function setPrenomEnseignant(string $prenomEnseignant): void
    {
        $this->prenomEnseignant = $prenomEnseignant;
    }

    public function getMailTuteurProfessionnel(): string
    {
        return $this->mailTuteurProfessionnel;
    }

    public function setMailTuteurProfessionnel(string $mailTuteurProfessionnel): void
    {
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
    }

    public function getPrenomTuteurProfessionnel(): string
    {
        return $this->prenomTuteurProfessionnel;
    }

    public function setPrenomTuteurProfessionnel(string $prenomTuteurProfessionnel): void
    {
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
    }

    public function getNomTuteurProfessionnel(): string
    {
        return $this->nomTuteurProfessionnel;
    }

    public function setNomTuteurProfessionnel(string $nomTuteurProfessionnel): void
    {
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
    }

    public function getFonctionTuteurProfessionnel(): string
    {
        return $this->fonctionTuteurProfessionnel;
    }

    public function setFonctionTuteurProfessionnel(string $fonctionTuteurProfessionnel): void
    {
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
    }

    public function getTelephoneTuteurProfessionnel(): string
    {
        return $this->telephoneTuteurProfessionnel;
    }

    public function setTelephoneTuteurProfessionnel(string $telephoneTuteurProfessionnel): void
    {
        $this->telephoneTuteurProfessionnel = $telephoneTuteurProfessionnel;
    }

    public function getSujetExperienceProfessionnel(): string
    {
        return $this->sujetExperienceProfessionnel;
    }

    public function setSujetExperienceProfessionnel(string $sujetExperienceProfessionnel): void
    {
        $this->sujetExperienceProfessionnel = $sujetExperienceProfessionnel;
    }

    public function getThematiqueExperienceProfessionnel(): string
    {
        return $this->thematiqueExperienceProfessionnel;
    }

    public function setThematiqueExperienceProfessionnel(string $thematiqueExperienceProfessionnel): void
    {
        $this->thematiqueExperienceProfessionnel = $thematiqueExperienceProfessionnel;
    }

    public function getTachesExperienceProfessionnel(): string
    {
        return $this->tachesExperienceProfessionnel;
    }

    public function setTachesExperienceProfessionnel(string $tachesExperienceProfessionnel): void
    {
        $this->tachesExperienceProfessionnel = $tachesExperienceProfessionnel;
    }

    public function getCodePostalExperienceProfessionnel(): string
    {
        return $this->codePostalExperienceProfessionnel;
    }

    public function setCodePostalExperienceProfessionnel(string $codePostalExperienceProfessionnel): void
    {
        $this->codePostalExperienceProfessionnel = $codePostalExperienceProfessionnel;
    }

    public function getAdresseExperienceProfessionnel(): string
    {
        return $this->adresseExperienceProfessionnel;
    }

    public function setAdresseExperienceProfessionnel(string $adresseExperienceProfessionnel): void
    {
        $this->adresseExperienceProfessionnel = $adresseExperienceProfessionnel;
    }

    public function getDateDebutExperienceProfessionnel(): string
    {
        return $this->dateDebutExperienceProfessionnel;
    }

    public function setDateDebutExperienceProfessionnel(string $dateDebutExperienceProfessionnel): void
    {
        $this->dateDebutExperienceProfessionnel = $dateDebutExperienceProfessionnel;
    }

    public function getDateFinExperienceProfessionnel(): string
    {
        return $this->dateFinExperienceProfessionnel;
    }

    public function setDateFinExperienceProfessionnel(string $dateFinExperienceProfessionnel): void
    {
        $this->dateFinExperienceProfessionnel = $dateFinExperienceProfessionnel;
    }

    public function getNomSignataire(): string
    {
        return $this->nomSignataire;
    }

    public function setNomSignataire(string $nomSignataire): void
    {
        $this->nomSignataire = $nomSignataire;
    }

    public function getPrenomSignataire(): string
    {
        return $this->prenomSignataire;
    }

    public function setPrenomSignataire(string $prenomSignataire): void
    {
        $this->prenomSignataire = $prenomSignataire;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): void
    {
        $this->siret = $siret;
    }

    public function getNomEntreprise(): string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): void
    {
        $this->nomEntreprise = $nomEntreprise;
    }

    public function getCodePostalEntreprise(): string
    {
        return $this->codePostalEntreprise;
    }

    public function setCodePostalEntreprise(string $codePostalEntreprise): void
    {
        $this->codePostalEntreprise = $codePostalEntreprise;
    }

    public function getEffectifEntreprise(): string
    {
        return $this->effectifEntreprise;
    }

    public function setEffectifEntreprise(string $effectifEntreprise): void
    {
        $this->effectifEntreprise = $effectifEntreprise;
    }

    public function getTelephoneEntreprise(): string
    {
        return $this->telephoneEntreprise;
    }

    public function setTelephoneEntreprise(string $telephoneEntreprise): void
    {
        $this->telephoneEntreprise = $telephoneEntreprise;
    }

    public function isEstValidee(): bool
    {
        return ($this->estValidee == 1);
    }

    public function setEstValidee(bool $estValidee): void
    {
        $this->estValidee = $estValidee;
    }

    public function formatTableau(): array {
        return array(
            "idConventionTag" => $this->idConvention,
            "mailEnseignantTag" => $this->mailEnseignant,
            "nomEnseignantTag" => $this->nomEnseignant,
            "prenomEnseignantTag" => $this->prenomEnseignant,
            "competencesADevelopperTag" => $this->competencesADevelopper,
            "dureeDeTravailTag" => $this->dureeDeTravail,
            "languesImpressionTag" => $this->languesImpression,
            "origineDeLaConventionTag" => $this->origineDeLaConvention,
            "sujetEstConfidentielTag" => $this->sujetEstConfidentiel,
            "nbHeuresHebdoTag" => $this->nbHeuresHebdo,
            "modePaiementTag" => $this->modePaiement,
            "dureeExperienceProfessionnelTag" => $this->dureeExperienceProfessionnel,
            "caisseAssuranceMaladieTag" => $this->caisseAssuranceMaladie,
            "mailTuteurProfessionnelTag" => $this->mailTuteurProfessionnel,
            "prenomTuteurProfessionnelTag" => $this->prenomTuteurProfessionnel,
            "nomTuteurProfessionnelTag" => $this->nomTuteurProfessionnel,
            "fonctionTuteurProfessionnelTag" => $this->fonctionTuteurProfessionnel,
            "telephoneTuteurProfessionnelTag" => $this->telephoneTuteurProfessionnel,
            "sujetExperienceProfessionnelTag" => $this->sujetExperienceProfessionnel,
            "thematiqueExperienceProfessionnelTag" => $this->thematiqueExperienceProfessionnel,
            "tachesExperienceProfessionnelTag" => $this->tachesExperienceProfessionnel,
            "codePostalExperienceProfessionnelTag" => $this->codePostalExperienceProfessionnel,
            "adresseExperienceProfessionnelTag" => $this->adresseExperienceProfessionnel,
            "dateDebutExperienceProfessionnelTag" => $this->dateDebutExperienceProfessionnel,
            "dateFinExperienceProfessionnelTag" => $this->dateFinExperienceProfessionnel,
            "nomSignataireTag" => $this->nomSignataire,
            "prenomSignataireTag" => $this->prenomSignataire,
            "siretTag" => $this->siret,
            "nomEntrepriseTag" => $this->nomEntreprise,
            "codePostalEntrepriseTag" => $this->codePostalEntreprise,
            "effectifEntrepriseTag" => $this->effectifEntreprise,
            "telephoneEntrepriseTag" => $this->telephoneEntreprise,
            "estFiniTag" => $this->estFini,
            "estValideeTag" => $this->estValidee
        );
    }
}