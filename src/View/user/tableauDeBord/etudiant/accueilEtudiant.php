<h1>Bienvenue <?= $user->getPrenomEtudiant()?></h1>
<div class="accueilContainer">
    <div class="infoUtilisateur">
        <h2>Informations personnelles:</h2>
        <p>Nom : <?php echo htmlspecialchars($user->getNomEtudiant());?></p>
        <p>Prenom : <?php echo htmlspecialchars($user->getPrenomEtudiant());?></p>
        <p>Numéro étudiant : <?php echo htmlspecialchars($user->getNumEtudiant());?></p>
        <p>Code postal : <?php echo htmlspecialchars($user->getCodePostalEtudiant());?></p>
        <p>Téléphone : <?php echo htmlspecialchars($user->getTelephoneEtudiant());?></p>
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

