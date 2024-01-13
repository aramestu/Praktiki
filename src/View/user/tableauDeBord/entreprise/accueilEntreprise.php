<h1>Bienvenue <?= $user->getNomEntreprise()?></h1>
<div class="accueilContainer">
    <div class="infoUtilisateur">
        <h2>Informations personnelles:</h2>
        <p>Siret : <?php echo htmlspecialchars($user->getSiret());?></p>
        <p>Nom : <?php echo htmlspecialchars($user->getNomEntreprise());?></p>
        <p>Effectif : <?php echo htmlspecialchars($user->getEffectifEntreprise());?></p>
        <p>Adresse : 123 rue de la paix</p>
        <p>Code postal : <?php echo htmlspecialchars($user->getCodePostalEntreprise());?></p>
        <p>Téléphone : <?php echo htmlspecialchars($user->getTelephoneEntreprise());?></p>
        <p>Couriel : <?php echo htmlspecialchars($user->getMailEntreprise());?></p>
        <p>Site web : <?php echo htmlspecialchars($user->getSiteWebEntreprise());?></p>
    </div>
    <div id="recentOffers">
        <h2>Vos offres</h2>
        <div id="tableOffer">
            <?php \App\SAE\Controller\ControllerExpPro::getExpProEntreprise(); ?>
        </div>
    </div>
</div>