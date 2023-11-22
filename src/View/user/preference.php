<link rel="stylesheet" href="assets/css/connect.css">
<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Choisissez votre compte</h2>
        <p>
            <input type="hidden" name="action" value="afficherConnexionLdap">
            <input type="hidden" name="controller" value="Connexion">
            <input type="submit" value="Compte IUT">
    </form>
    <form method="get">
        <p>
            <input type="hidden" name="action" value="afficherConnexionEntreprise">
            <input type="hidden" name="controller" value="Connexion">
            <input type="submit" value="Compte Entreprise">
        </p>
    </form>
    <form method="get">
        <p>
            <input type="hidden" name="action" value="afficherConnexionPersonnel">
            <input type="hidden" name="controller" value="Connexion">
            <input type="submit" value="Compte Personnel">
        </p>
    </form>
</div>