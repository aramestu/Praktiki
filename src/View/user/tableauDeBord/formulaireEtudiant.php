<link rel="stylesheet" href="assets/css/connect.css">

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Mes informations</h2>
        <?php
$nom=htmlspecialchars($user->getNomEtudiant());
$prenom=htmlspecialchars($user->getPrenomEtudiant());
$numero=htmlspecialchars($user->getNumEtudiant());
$codePostal=htmlspecialchars($user->getCodePostalEtudiant());
$Telephone=htmlspecialchars($user->getTelephoneEtudiant());
$mailUniversite=htmlspecialchars($user->getMailUniversitaireEtudiant());
$mailPerso=htmlspecialchars($user->getMailPersoEtudiant());

echo '
          <p>
            <label class="InputAddOn-item" for="nom">Nom :</label> 
            <input class="InputAddOn-field" type="text" value="' . $nom . '" name="nom" id="nom" readonly/>
            <br>
            <label class="InputAddOn-item" for="prenom">Prenom : </label> 
            <input class="InputAddOn-field" type="text" value="' . $prenom . '" name="prenom" id="prenom" required>
            <br>
            <label class="InputAddOn-item" for="num">Numéro Etudiant :</label> 
            <input class="InputAddOn-field" type="text" value="' . $numero . '" name="num" id="num" required>
            <br>
            <label class="InputAddOn-item" for="codePostal">Code Postal :</label> 
            <input class="InputAddOn-field" type="text" value="' . $codePostal . '" name="codePostal" id="codePostal" required>
            <br>
            <label class="InputAddOn-item" for="tel">Telephone :</label> 
            <input class="InputAddOn-field" type="text" value="' . $Telephone . '" name="tel" id="tel" required>
            <br>
            <label class="InputAddOn-item" for="mailUniv">Email Universitaire :</label> 
            <input class="InputAddOn-field" type="text" value="' . $mailUniversite . '" name="mailUniv" id="mailUniv" required>
            <br>
            <label class="InputAddOn-item" for="mailPerso">Email Personnel :</label> 
            <input class="InputAddOn-field" type="text" value="' . $mailPerso . '" name="mailPerso" id="mailPerso" required>
        </p>
        <p>
            <input type="hidden" name="action" value="mettreAJour">
            <input type="hidden" name="controller" value="Etudiant">
            <input type="submit" value="Mettre à jour">
        </p>
';
?>
</div>


