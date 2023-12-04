<link rel="stylesheet" href="assets/css/connect.css">

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Mes informations</h2>
        <?php
        $num=htmlspecialchars($user->getNumEtudiant());
        $nom=htmlspecialchars($user->getNomEtudiant());
        $prenom=htmlspecialchars($user->getPrenomEtudiant());
        $mailPerso=htmlspecialchars($user->getMailPersoEtudiant());
        $mailUniv=htmlspecialchars($user->getMailUniversitaireEtudiant());
        $Telephone=htmlspecialchars($user->getTelephoneEtudiant());
        $codePostal=htmlspecialchars($user->getCodePostalEtudiant());

        echo '
          <p>
            <label class="InputAddOn-item" for="num">Numéro Etudiant :</label> 
            <input class="InputAddOn-field" type="text" value="' . $num . '" name="num" id="num" readonly>
            <br>
            <label class="InputAddOn-item" for="nom">Nom :</label> 
            <input class="InputAddOn-field" type="text" value="' . $nom . '" name="nom" id="nom" required/>
            <br>
            <label class="InputAddOn-item" for="prenom">Prenom : </label> 
            <input class="InputAddOn-field" type="text" value="' . $prenom . '" name="prenom" id="prenom" required>
            <br>
            <label class="InputAddOn-item" for="mailPerso">Email Personnel :</label> 
            <input class="InputAddOn-field" type="text" value="' . $mailPerso . '" name="mailPerso" id="mailPerso" required>
            <br>
            <label class="InputAddOn-item" for="mailUniv">Email Universitaire :</label> 
            <input class="InputAddOn-field" type="text" value="' . $mailUniv . '" name="mailUniv" id="mailUniv" required>            <br>
            <br>
            <label class="InputAddOn-item" for="telephone">Telephone :</label> 
            <input class="InputAddOn-field" type="text" value="' . $Telephone . '" name="telephone" id="telephone" required>
            <br>
            <label class="InputAddOn-item" for="postcode">Code Postal :</label> 
            <input class="InputAddOn-field" type="text" value="' . $codePostal . '" name="postcode" id="postcode" required>
            
        </p>
        <p>
            <input type="hidden" name="action" value="mettreAJour">
            <input type="hidden" name="controller" value="Etudiant">
            <input type="submit" value="Mettre à jour">
        </p>
';
        ?>
</div>


