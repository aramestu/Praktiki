<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\DataObject\Stage;

class ControllerExpPro{
    public static function getExpProByDefault(){
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

    private static function afficheVue(string $cheminVue, array $parametres = []): void
        {
            extract($parametres);
            require __DIR__ . '/../View/' . $cheminVue;
        }
}

?>
