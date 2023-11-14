<?php
namespace App\SAE\Model\Repository;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\OffreNonDefini;
use App\SAE\Model\DataObject\ExperienceProfessionnel;

class OffreNonDefiniRepository extends  AbstractExperienceProfessionnelRepository {
    protected function getNomDataObject(): string
    {
        return "OffreNonDefini";
    }

    protected function getNomClePrimaire(): string
    {
        return "idOffreNonDefini";
    }

    protected function getNomTable(): string
    {
        return "OffreNonDefini";
    }

    protected function getNomsColonnesSupplementaires(): array
    {
        return array("idOffreNonDefini");
    }

    public function construireDepuisTableau(array $expProFormatTableau): ExperienceProfessionnel
    {
        $exp = new OffreNonDefini($expProFormatTableau["sujetExperienceProfessionnel"], $expProFormatTableau["thematiqueExperienceProfessionnel"],
            $expProFormatTableau["tachesExperienceProfessionnel"], $expProFormatTableau["niveauExperienceProfessionnel"], $expProFormatTableau["codePostalExperienceProfessionnel"],
            $expProFormatTableau["adresseExperienceProfessionnel"], $expProFormatTableau["dateDebutExperienceProfessionnel"],
            $expProFormatTableau["dateFinExperienceProfessionnel"], $expProFormatTableau["siret"]);
        $this->updateAttribut($expProFormatTableau, $exp);
        return $exp;
    }

    public static function search(string $keywords): array
    {
        $sql = "SELECT *
                FROM ExperienceProfessionnel e
                JOIN OffreNonDefini o ON o.idOffreNonDefini = e.idExperienceProfessionnel
                JOIN Entreprises en ON en.siret = e.siret
                WHERE numEtudiant IS NULL
                AND en.estValide = true
                AND (sujetExperienceProfessionnel LIKE :keywordsTag
                OR thematiqueExperienceProfessionnel LIKE :keywordsTag
                OR tachesExperienceProfessionnel LIKE :keywordsTag
                OR niveauExperienceProfessionnel LIKE :keywordsTag
                OR codePostalExperienceProfessionnel LIKE :keywordsTag
                OR adresseExperienceProfessionnel LIKE :keywordsTag
                OR e.siret LIKE :keywordsTag)
                ORDER BY datePublication";

        $requestStatement = Model::getPdo()->prepare($sql);

        $values = array(
            "keywordsTag" => '%' . $keywords . '%'
        );

        $requestStatement->execute($values);

        $AllOffreNonDefini = [];
        $rep = new OffreNonDefiniRepository();
        foreach ($requestStatement as $offre) {
            $AllOffreNonDefini[] = $rep->construireDepuisTableau($offre);
        }
        return $AllOffreNonDefini;
    }

    public static function filtres(string $dateDebut = null, string $dateFin = null, string $optionTri = null, string $codePostal = null, string $datePublication = null): array
    {
        date_default_timezone_set('Europe/Paris');
        $pdo = Model::getPdo();
        $sql = "SELECT * 
                FROM OffreNonDefini o JOIN ExperienceProfessionnel e ON o.idOffreNonDefini = e.idExperienceProfessionnel WHERE numEtudiant IS NULL ";
        if (isset($datePublication)) {
            $sql .= match ($datePublication) {
                'last24' => "AND DATEDIFF(NOW(), datePublication) < 1 ",
                'lastWeek' => "AND DATEDIFF(NOW(), datePublication) < 7 ",
                'lastMonth' => "AND DATEDIFF(NOW(), datePublication) < 30 ",
            };
        }
        //TODO : A revoire quand Date dans BD
        if (strlen($dateDebut) > 0 && strlen($dateFin) > 0) {
            $sql .= "AND dateDebutExperienceProfessionnel >= $dateDebut AND dateFinExperienceProfessionnel <= $dateFin ";
        } elseif (strlen($dateDebut) > 0) {
            $sql .= "AND dateDebutExperienceProfessionnel = '$dateDebut' ";
        } elseif (strlen($dateFin) > 0) {
            $sql .= "AND dateFinExperienceProfessionnel = '$dateFin' ";
        }
        if (strlen($codePostal) > 0) {
            $sql .= "AND codePostalExperienceProfessionnel = '$codePostal' ";
        }
        if (isset($optionTri)) {
            if ($optionTri == "datePublication") {
                $sql .= "ORDER BY datePublication ASC";
            }
            if ($optionTri == "datePublicationInverse") {
                $sql .= "ORDER BY datePublication DESC";
            }
        }

        $requete = $pdo->query($sql);
        $offreNonDefiniTrie = [];
        $rep = new OffreNonDefiniRepository();
        foreach ($requete as $result) {
            $offreNonDefiniTrie[] = $rep->construireDepuisTableau($result);
        }
        return $offreNonDefiniTrie;
    }
}
