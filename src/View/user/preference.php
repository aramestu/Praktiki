<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Choix du compte</title>

    <link rel="stylesheet" href="assets/css/connect.css">

</head>

<body>
<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend">Choisissez votre compte</h2>
        <p>
            <input type="hidden" name="action" value="connect">
            <input type="hidden" name="controller" value="LDAP">
            <input type="submit" value="Compte IUT">
    </form>
    <form method="get">
        <p>
            <input type="hidden" name="action" value="connect">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Compte Entreprise">
        </p>
    </form>
</div>
</body>

</html>
