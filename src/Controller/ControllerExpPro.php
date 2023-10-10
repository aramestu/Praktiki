<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\Stage;

class ControllerExpPro{
    public static function getExpProByDefault(): void
    {
        $listeExpPro = ExperienceProfessionnelRepository::getAllExperienceProfessionnelByDefault();
        self::afficheVue(
                            'view.php',
                            [
                                'pagetitle' => 'Offre',
                                'listeExpPro' => $listeExpPro,
                                'cheminVueBody' => 'SAE/offerList.php',
                            ]
                        );
    }

    public static function getExpProByFiltre(): void
    {
        $dateDebut = null;
        $dateFin = null;
        $optionTri = null;
        if (isset($_GET['dateDebut'])){
            $dateDebut = $_GET['dateDebut'];
        }
        if (isset($_GET['dateFin'])){
            $dateFin = $_GET['dateFin'];
        }
        if (isset($_GET['optionTri'])){
            $optionTri = $_GET['optionTri'];
        }
        $listeExpPro = ExperienceProfessionnelRepository::filtre($dateDebut, $dateFin, $optionTri);
        self::afficheVue('view.php', ['listeExpPro' => $listeExpPro, 'cheminVuebody' => 'SAE/offerListFilter.php']);
    }

    private static function afficheVue(string $cheminVue, array $parametres = []): void
        {
            extract($parametres);
            require __DIR__ . '/../View/' . $cheminVue;
        }
}


