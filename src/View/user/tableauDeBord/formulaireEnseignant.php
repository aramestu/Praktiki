<link rel="stylesheet" href="assets/css/connect.css">

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Mes informations</h2>
        <?php
        $mail=htmlspecialchars($user->getMailEnseignant());
        $nom=htmlspecialchars($user->getNomEnseignant());
        $prenom=htmlspecialchars($user->getPrenomEnseignant());
        $admin=htmlspecialchars($user->isEstAdmin());


        echo '
          <p>
            <label class="InputAddOn-item" for="mail">Adresse mail :</label> 
            <input class="InputAddOn-field" type="text" value="' . $mail . '" name="mail" id="mail" readonly>
            <br>
            <label class="InputAddOn-item" for="nom">Nom :</label> 
            <input class="InputAddOn-field" type="text" value="' . $nom . '" name="nom" id="nom" required/>
            <br>
            <label class="InputAddOn-item" for="prenom">Prenom : </label> 
            <input class="InputAddOn-field" type="text" value="' . $prenom . '" name="prenom" id="prenom" required>
            <input type="hidden" value="' . $admin . '" name="admin" id="admin" required>

        </p>
        <p>
            <input type="hidden" name="action" value="mettreAJour">
            <input type="hidden" name="controller" value="Enseignant">
            <input type="submit" value="Mettre à jour">
        </p>
';
        ?>
</div>


