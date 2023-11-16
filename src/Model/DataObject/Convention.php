<?php

namespace App\SAE\Model\DataObject;

class Convention extends AbstractDataObject {

    private string $idConvention;
    private string $competencesADevelopper;
    private string $langueImpression;
    private string $dureeStage;
    private string $nbHeuresHebdo;
    private string $modePaiement;
    private string $estSignee;

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

    public function getLangueImpression(): string
    {
        return $this->langueImpression;
    }

    public function setLangueImpression(string $langueImpression): void
    {
        $this->langueImpression = $langueImpression;
    }

    public function getDureeStage(): string
    {
        return $this->dureeStage;
    }

    public function setDureeStage(string $dureeStage): void
    {
        $this->dureeStage = $dureeStage;
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

    public function getEstSignee(): string
    {
        return $this->estSignee;
    }

    public function setEstSignee(string $estSignee): void
    {
        $this->estSignee = $estSignee;
    }

    public function formatTableau(): array {
        return array(
            "idConventionTag" => $this->idConvention,
            "competencesADevelopperTag" => $this->competencesADevelopper,
            "langueImpressionTag" => $this->langueImpression,
            "dureeStageTag" => $this->dureeStage,
            "nbHeuresHebdoTag" => $this->nbHeuresHebdo,
            "modePaiementTag" => $this->modePaiement,
            "estSigneeTag" => $this->estSignee
        );
    }
}