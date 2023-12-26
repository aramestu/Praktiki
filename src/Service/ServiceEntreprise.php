<?php

namespace App\SAE\Service;

use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\AbstractDataObject;

class ServiceEntreprise implements ServiceInterface {

    public static function mettreAJour(Entreprise|AbstractDataObject $entreprise, array $attributs): void{
        if(isset($attributs["siret"])){
            $entreprise->setSiret($attributs["siret"]);
        }
        if(isset($attributs["nomEntreprise"])){
            $entreprise->setNomEntreprise($attributs["nomEntreprise"]);
        }

        if(isset($attributs["codePostalEntreprise"])){
            $entreprise->setCodePostalEntreprise($attributs["codePostalEntreprise"]);
        }

        if(isset($attributs["effectifEntreprise"])){
            $entreprise->setEffectifEntreprise($attributs["effectifEntreprise"]);
        }

        if(isset($attributs["telephoneEntreprise"])){
            $entreprise->setTelephoneEntreprise($attributs["telephoneEntreprise"]);
        }

        if(isset($attributs["siteWebEntreprise"])){
            $entreprise->setSiteWebEntreprise($attributs["siteWebEntreprise"]);
        }

        if(isset($attributs["estValide"])){
            $entreprise->setEstValide($attributs["estValide"]);
        }

        if(isset($attributs["mailEntreprise"])){
            $entreprise->setMailEntreprise($attributs["mailEntreprise"]);
        }

        if(isset($attributs["mdpHache"])){
            $entreprise->setMdpHache($attributs["mdpHache"]);
        }

        if(isset($attributs["mailAValider"])){
            $entreprise->setMailAValider($attributs["mailAValider"]);
        }

        if(isset($attributs["nonce"])){
            $entreprise->setNonce($attributs["nonce"]);
        }
    }
}