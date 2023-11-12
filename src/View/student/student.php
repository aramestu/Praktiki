<link rel="stylesheet" href="assets/css/button.css">
<div class="container">
    <div class="header">
        <div class="company">
            <h2>
                <?php echo(htmlspecialchars($etudiant->getNomEtudiant())); ?>
            </h2>
        </div>
    </div>
    <div class="text">
        <p>
            Prenom : <?php echo(htmlspecialchars($etudiant->getPrenomEtudiant())); ?>
        </p>
        <p>
            Numéro étudiant : <?php echo(htmlspecialchars($etudiant->getNumEtudiant())); ?>
        </p>
        <p>
            Mail perso : <?php echo(htmlspecialchars($etudiant->getMailPersoEtudiant())); ?>
        </p>
        <p>
            Mail universitaire : <?php echo(htmlspecialchars($etudiant->getMailUniversitaireEtudiant())); ?>
        </p>
        <p>
            Numéro de téléphone : <?php echo(htmlspecialchars($etudiant->getTelephoneEtudiant())); ?>
        </p>
        <p>
            Code Postal : <?php echo(htmlspecialchars($etudiant->getCodePostalEtudiant())); ?>
        </p>
    </div>
</div>