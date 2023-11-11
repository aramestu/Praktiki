<?php

namespace App\SAE\Lib;

use App\SAE\Config\Conf;
use App\SAE\Controller\ControllerEntreprise;
use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EntrepriseRepository;

class VerificationEmail
{
    public static function envoiEmailValidation(Entreprise $Entreprise): void
    {

        $loginURL = rawurlencode($Entreprise->getSiret());
        $nonceURL = rawurlencode($Entreprise->getNonce());
        $absoluteURL = Conf::getAbsoluteURL();
        $lienValidationEmail = "$absoluteURL?controller=Entreprise&action=validerEmail&siret=$loginURL&nonce=$nonceURL";
        $corpsEmail = "<a href=\"$lienValidationEmail\">Validation</a>";
        $message = '
<html>
    <body>
        <div align="center">
            <a href="'.$lienValidationEmail.'">Valider mon email</a>
        </div>
</body>
</html>';
        $headers = [
            "From" => "From: IUT-Montpellier-Sete",
            "Reply-To" => "Reply-To: IUT-Montpellier-Sete",
            "Cc" => "Cc: IUT-Montpellier-Sete",
            "Bcc" => "Bcc: IUT-Montpellier-Sete",
            "Content-Type" => "Content-Type: text/html; charset=UTF-8"
        ];
        mail($Entreprise->getEmailAValider(), "Validation de votre email",
            $message, implode("\r\n", $headers));


        // Temporairement avant d'envoyer un vrai mail
        MessageFlash::ajouter("success", $corpsEmail);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        $user = (new EntrepriseRepository())->getById($login);
        if (!is_null($user)) {
            if ($user->formatTableau()["nonceTag"] == $nonce) {
                $user->setEmailEntreprise($user->getEmailAValider());
                $user->setEmailAValider("");
                $user->setNonce("");
                (new EntrepriseRepository())->mettreAJour($user);
                return true;
            }
        }
        return false;

    }

    public static function aValideEmail(Entreprise $Entreprise): bool
    {
        // À compléter
        return true;
    }
}