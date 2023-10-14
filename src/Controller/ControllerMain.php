<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\AlternanceRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\Model;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\DataObject\Stage;

class ControllerMain extends ControllerGenerique
{




    public static function connect()
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Connexion',
                        'cheminVueBody' => 'user/connect.php',
                    ]
                );
    }

    public static function createAccount()
    {
        self::afficheVue(
                    'view.php',
                    [
                        'pagetitle' => 'Créer un compte',
                        'cheminVueBody' => 'user/createAccount.php',
                    ]
                );
    }
}
