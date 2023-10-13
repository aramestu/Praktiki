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
        $listeExpPro = ExperienceProfessionnelRepository::getAll();
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
        $stage = null;
        $alternance = null;
        $codePostal = null;
        if (isset($_GET['dateDebut'])){
            $dateDebut = $_GET['dateDebut'];
        }
        if (isset($_GET['dateFin'])){
            $dateFin = $_GET['dateFin'];
        }
        if (isset($_GET['optionTri'])){
            $optionTri = $_GET['optionTri'];
        }
        if (isset($_GET['stage'])){
            $stage = $_GET['stage'];
        }
        if (isset($_GET['alternance'])){
            $alternance = $_GET['alternance'];
        }
        if (isset($_GET['codePostal'])){
            $codePostal = $_GET['codePostal'];
        }
        $listeExpPro = ExperienceProfessionnelRepository::filtre($dateDebut, $dateFin, $optionTri, $stage, $alternance, $codePostal);
        self::afficheVue('view.php', ['pagetitle' => 'Offre', 'listeExpPro' => $listeExpPro, 'cheminVueBody' => 'SAE/offerList.php']);
    }

    private static function afficheVue(string $cheminVue, array $parametres = []): void
        {
            extract($parametres);
            require __DIR__ . '/../View/' . $cheminVue;
        }
}


