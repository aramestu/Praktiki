<?php

namespace App\SAE\Model\DataObject;

/**
 * La classe Convention représente une convention de stage.
 *
 * @package App\SAE\Model\DataObject
 */
class Convention extends AbstractDataObject {

    /**
     * @var string Identifiant de la convention.
     */
    private string $idConvention;

    /**
     * @var string Adresse e-mail de l'enseignant.
     */
    private string $mailEnseignant;

    /**
     * @var string Nom de l'enseignant.
     */
    private string $nomEnseignant;

    /**
     * @var string Prénom de l'enseignant.
     */
    private string $prenomEnseignant;

    /**
     * @var string Compétences à développer pendant le stage.
     */
    private string $competencesADevelopper;

    /**
     * @var string Durée de travail hebdomadaire.
     */
    private string $dureeDeTravail;

    /**
     * @var string Langues d'impression de la convention.
     */
    private string $languesImpression;

    /**
     * @var string Origine de la convention.
     */
    private string $origineDeLaConvention;

    /**
     * @var bool Indique si le sujet est confidentiel.
     */
    private bool $sujetEstConfidentiel;

    /**
     * @var string Nombre d'heures hebdomadaires.
     */
    private string $nbHeuresHebdo;

    /**
     * @var string Mode de paiement.
     */
    private string $modePaiement;

    /**
     * @var string Durée de l'expérience professionnelle.
     */
    private string $dureeExperienceProfessionnel;

    /**
     * @var string Caisse d'assurance maladie.
     */
    private string $caisseAssuranceMaladie;

    /**
     * @var string Adresse e-mail du tuteur professionnel.
     */
    private string $mailTuteurProfessionnel;

    /**
     * @var string Prénom du tuteur professionnel.
     */
    private string $prenomTuteurProfessionnel;

    /**
     * @var string Nom du tuteur professionnel.
     */
    private string $nomTuteurProfessionnel;

    /**
     * @var string Fonction du tuteur professionnel.
     */
    private string $fonctionTuteurProfessionnel;

    /**
     * @var string Numéro de téléphone du tuteur professionnel.
     */
    private string $telephoneTuteurProfessionnel;

    /**
     * @var string Sujet de l'expérience professionnelle.
     */
    private string $sujetExperienceProfessionnel;

    /**
     * @var string Thématique de l'expérience professionnelle.
     */
    private string $thematiqueExperienceProfessionnel;

    /**
     * @var string Tâches de l'expérience professionnelle.
     */
    private string $tachesExperienceProfessionnel;

    /**
     * @var string Code postal de l'expérience professionnelle.
     */
    private string $codePostalExperienceProfessionnel;

    /**
     * @var string Adresse de l'expérience professionnelle.
     */
    private string $adresseExperienceProfessionnel;

    /**
     * @var string Date de début de l'expérience professionnelle.
     */
    private string $dateDebutExperienceProfessionnel;

    /**
     * @var string Date de fin de l'expérience professionnelle.
     */
    private string $dateFinExperienceProfessionnel;

    /**
     * @var string Nom du signataire.
     */
    private string $nomSignataire;

    /**
     * @var string Prénom du signataire.
     */
    private string $prenomSignataire;

    /**
     * @var string Numéro SIRET de l'entreprise.
     */
    private string $siret;

    /**
     * @var string Nom de l'entreprise.
     */
    private string $nomEntreprise;

    /**
     * @var string Code postal de l'entreprise.
     */
    private string $codePostalEntreprise;

    /**
     * @var string Effectif de l'entreprise.
     */
    private string $effectifEntreprise;

    /**
     * @var string Numéro de téléphone de l'entreprise.
     */
    private string $telephoneEntreprise;

    /**
     * @var bool Indique si la convention est terminée.
     */
    private bool $estFini;

    /**
     * @var bool Indique si la convention est validée par l'administration.
     */
    private bool $estValideeAdmin;

    /**
     * @var bool Indique si la convention est validée par le secrétariat.
     */
    private bool $estValideeSecretariat;

    /**
     * @var bool Indique si la convention est validée par le service des stages.
     */
    private bool $estValideePstage;

    /**
     * @var string Raison du refus, le cas échéant.
     */
    private string $raisonRefus;

    /**
     * @var bool Indique si la convention est signée.
     */
    private bool $estSignee;

    /**
     * Constructeur de la classe Convention.
     *
     * @param string $mailEnseignant Adresse e-mail de l'enseignant.
     * @param string $nomEnseignant Nom de l'enseignant.
     * @param string $prenomEnseignant Prénom de l'enseignant.
     * @param string $competencesADevelopper Compétences à développer pendant le stage.
     * @param string $dureeDeTravail Durée de travail hebdomadaire.
     * @param string $languesImpression Langues d'impression de la convention.
     * @param string $origineDeLaConvention Origine de la convention (par exemple, école, entreprise).
     * @param bool $sujetEstConfidentiel Indique si le sujet de la convention est confidentiel.
     * @param string $nbHeuresHebdo Nombre d'heures hebdomadaires.
     * @param string $modePaiement Mode de paiement pour le stage.
     * @param string $dureeExperienceProfessionnel Durée totale de l'expérience professionnelle.
     * @param string $caisseAssuranceMaladie Caisse d'assurance maladie.
     * @param string $mailTuteurProfessionnel Adresse e-mail du tuteur professionnel.
     * @param string $prenomTuteurProfessionnel Prénom du tuteur professionnel.
     * @param string $nomTuteurProfessionnel Nom du tuteur professionnel.
     * @param string $fonctionTuteurProfessionnel Fonction du tuteur professionnel.
     * @param string $telephoneTuteurProfessionnel Numéro de téléphone du tuteur professionnel.
     * @param string $sujetExperienceProfessionnel Sujet de l'expérience professionnelle.
     * @param string $thematiqueExperienceProfessionnel Thématique de l'expérience professionnelle.
     * @param string $tachesExperienceProfessionnel Tâches de l'expérience professionnelle.
     * @param string $codePostalExperienceProfessionnel Code postal de l'expérience professionnelle.
     * @param string $adresseExperienceProfessionnel Adresse de l'expérience professionnelle.
     * @param string $dateDebutExperienceProfessionnel Date de début de l'expérience professionnelle.
     * @param string $dateFinExperienceProfessionnel Date de fin de l'expérience professionnelle.
     * @param string $nomSignataire Nom du signataire de la convention.
     * @param string $prenomSignataire Prénom du signataire de la convention.
     * @param string $siret Numéro SIRET de l'entreprise.
     * @param string $nomEntreprise Nom de l'entreprise.
     * @param string $codePostalEntreprise Code postal de l'entreprise.
     * @param string $effectifEntreprise Effectif de l'entreprise.
     * @param string $telephoneEntreprise Numéro de téléphone de l'entreprise.
     * @param bool $estFini Indique si la convention est terminée.
     * @param bool $estValideeAdmin Indique si la convention est validée par l'administration.
     * @param bool $estValideeSecretariat Indique si la convention est validée par le secrétariat.
     * @param bool $estValideePstage Indique si la convention est validée par le pôle stage.
     * @param string $raisonRefus Raison du refus de la convention.
     * @param bool $estSignee Indique si la convention est signée.
     */
    public function __construct(string $mailEnseignant, string $nomEnseignant, string $prenomEnseignant, string $competencesADevelopper, string $dureeDeTravail, string $languesImpression, string $origineDeLaConvention, bool $sujetEstConfidentiel, string $nbHeuresHebdo, string $modePaiement, string $dureeExperienceProfessionnel, string $caisseAssuranceMaladie, string $mailTuteurProfessionnel, string $prenomTuteurProfessionnel, string $nomTuteurProfessionnel, string $fonctionTuteurProfessionnel, string $telephoneTuteurProfessionnel, string $sujetExperienceProfessionnel, string $thematiqueExperienceProfessionnel, string $tachesExperienceProfessionnel, string $codePostalExperienceProfessionnel, string $adresseExperienceProfessionnel, string $dateDebutExperienceProfessionnel, string $dateFinExperienceProfessionnel, string $nomSignataire, string $prenomSignataire, string $siret, string $nomEntreprise, string $codePostalEntreprise, string $effectifEntreprise, string $telephoneEntreprise, bool $estFini, bool $estValideeAdmin, bool $estValideeSecretariat, bool $estValideePstage, string $raisonRefus, bool $estSignee)
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
        $this->estValideeAdmin = $estValideeAdmin;
        $this->estValideeSecretariat = $estValideeSecretariat;
        $this->estValideePstage = $estValideePstage;
        $this->raisonRefus = $raisonRefus;
        $this->estSignee = $estSignee;
    }

    public function getEstSignee(): bool
    {
        return $this->estSignee;
    }

    public function setEstSignee(bool $estSignee): void
    {
        $this->estSignee = $estSignee;
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

    public function getSujetEstConfidentiel(): bool
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

    public function getEstValideeAdmin(): bool{
        return $this->estValideeAdmin;

    }

    public function setEstValideeAdmin(bool $estValideeAdmin): void{
        $this->estValideeAdmin = $estValideeAdmin;
    }

    public function getEstValideeSecretariat(): bool
    {
        return $this->estValideeSecretariat;
    }

    public function setEstValideeSecretariat(bool $estValideeSecretariat): void
    {
        $this->estValideeSecretariat = $estValideeSecretariat;
    }

    public function isEstValideePstage(): bool
    {
        return $this->estValideePstage;
    }

    public function setEstValideePstage(bool $estValideePstage): void
    {
        $this->estValideePstage = $estValideePstage;
    }

    public function getRaisonRefus(): string
    {
        return $this->raisonRefus;
    }

    public function setRaisonRefus(string $raisonRefus): void
    {
        $this->raisonRefus = $raisonRefus;
    }

    /**
     * Formatte les données de l'objet en un tableau associatif.
     *
     * @return array Tableau associatif contenant les données formatées.
     */
    public function formatTableau(): array {
        $tab = array(
            "idConventionTag" => $this->idConvention,
            "mailEnseignantTag" => $this->mailEnseignant,
            "nomEnseignantTag" => $this->nomEnseignant,
            "prenomEnseignantTag" => $this->prenomEnseignant,
            "competencesADevelopperTag" => $this->competencesADevelopper,
            "dureeDeTravailTag" => $this->dureeDeTravail,
            "languesImpressionTag" => $this->languesImpression,
            "origineDeLaConventionTag" => $this->origineDeLaConvention,
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
            "raisonRefusTag" => $this->raisonRefus
        );
        $tab["sujetEstConfidentielTag"] = ($this->sujetEstConfidentiel) ? 1 : 0;
        $tab["estFiniTag"] = ($this->estFini) ? 1 : 0;
        $tab["estValideeAdminTag"] = ($this->estValideeAdmin) ? 1 : 0;
        $tab["estValideeSecretariatTag"] = ($this->estValideeSecretariat) ? 1 : 0;
        $tab["estValideePstageTag"] = ($this->estValideePstage) ? 1 : 0;
        $tab["estSigneeTag"] = ($this->estSignee) ? 1 : 0;
        return $tab;
    }

    /**
     * Récupère les noms des setters associés aux propriétés de l'objet.
     *
     * @return array Tableau associatif des noms des setters.
     */
    public function getSetters(): array{
        return [
            "mailEnseignant" => "setMailEnseignant",
            "nomEnseignant" => "setNomEnseignant",
            "prenomEnseignant" => "setPrenomEnseignant",
            "competencesADevelopper" => "setCompetencesADevelopper",
            "dureeDeTravail" => "setDureeDeTravail",
            "languesImpression" => "setLanguesImpression",
            "origineDeLaConvention" => "setOrigineDeLaConvention",
            "sujetEstConfidentiel" => "setSujetEstConfidentiel",
            "nbHeuresHebdo" => "setNbHeuresHebdo",
            "modePaiement" => "setModePaiement",
            "dureeExperienceProfessionnel" => "setDureeExperienceProfessionnel",
            "caisseAssuranceMaladie" => "setCaisseAssuranceMaladie",
            "mailTuteurProfessionnel" => "setMailTuteurProfessionnel",
            "prenomTuteurProfessionnel" => "setPrenomTuteurProfessionnel",
            "nomTuteurProfessionnel" => "setNomTuteurProfessionnel",
            "fonctionTuteurProfessionnel" => "setFonctionTuteurProfessionnel",
            "telephoneTuteurProfessionnel" => "setTelephoneTuteurProfessionnel",
            "sujetExperienceProfessionnel" => "setSujetExperienceProfessionnel",
            "thematiqueExperienceProfessionnel" => "setThematiqueExperienceProfessionnel",
            "tachesExperienceProfessionnel" => "setTachesExperienceProfessionnel",
            "codePostalExperienceProfessionnel" => "setCodePostalExperienceProfessionnel",
            "adresseExperienceProfessionnel" => "setAdresseExperienceProfessionnel",
            "dateDebutExperienceProfessionnel" => "setDateDebutExperienceProfessionnel",
            "dateFinExperienceProfessionnel" => "setDateFinExperienceProfessionnel",
            "nomSignataire" => "setNomSignataire",
            "prenomSignataire" => "setPrenomSignataire",
            "siret" => "setSiret",
            "nomEntreprise" => "setNomEntreprise",
            "codePostalEntreprise" => "setCodePostalEntreprise",
            "effectifEntreprise" => "setEffectifEntreprise",
            "telephoneEntreprise" => "setTelephoneEntreprise",
            "estFini" => "setEstFini",
            "estValideeAdmin" => "setEstValideeAdmin",
            "estValideeSecretariat" => "setEstValideeSecretariat",
            "estValideePstage" => "setEstValideePstage",
            "raisonRefus" => "setRaisonRefus",
            "estSignee" => "setEstSignee"
        ];
    }
}