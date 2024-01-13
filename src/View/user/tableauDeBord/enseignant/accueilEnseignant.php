<h1>Bienvenue M.<?= $user->getNomEnseignant()?></h1>
<div class="accueilContainer">
    <div class="infoUtilisateur">
        <h2>Informations personnelles:</h2>
        <p>Nom : <?php echo htmlspecialchars($user->getNomEnseignant());?></p>
        <p>Prenom : <?php echo htmlspecialchars($user->getPrenomEnseignant());?></p>
        <p>Adresse Mail : <?php echo htmlspecialchars($user->getMailEnseignant());?></p>
    </div>
    <div id="recentOffers">
        <h2>Offres récentes</h2>
        <div id="tableOffer">
            <?php
            require __DIR__ . "/../../../offer/offerTable.php"
            ?>
        </div>
    </div>
</div>

