<?php

namespace App\SAE\Controller;

use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;

class ControllerPanelAdmin extends ControllerGenerique {

    public static function panelEtudiants(): void {
        $listEtudiants = (new EtudiantRepository())->getAll();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panel.php',
                                                'adminPanelView' => 'student/studentList.php',
                                                'listEtudiants' => $listEtudiants]);
    }

    public static function panelEntreprises(): void {
        $keywords = ControllerEntreprise::keywordsExiste();
        $codePostalEntreprise = ControllerEntreprise::codePostalExiste();
        $effectifEntreprise = ControllerEntreprise::effectifExiste();
        $listEntreprises = (new EntrepriseRepository)->getEntrepriseEnAttenteFiltree($keywords, $codePostalEntreprise, $effectifEntreprise);
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
                                                'cheminVueBody' => 'user/adminPanel/panel.php',
                                                'adminPanelView' => 'company/companyListWaiting.php',
                                                'listEntreprises' => $listEntreprises ]);
    }

    public static  function panelListeEntreprises(): void {
        $listEntreprises = (new EntrepriseRepository)->getAll();
        self::afficheVue('view.php', ['pagetitle' => 'Panel Administrateur',
            'cheminVueBody' => 'user/adminPanel/panel.php',
            'adminPanelView' => 'user/adminPanel/entreprise/entrepriseList.php',
            'listEntreprises' => $listEntreprises ]);
    }

}