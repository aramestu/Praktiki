<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>VerifMail</title>

    <link rel="stylesheet" href="assets/css/connect.css">

</head>

<body>
<div class="container">
    <form method="get">
        <legend>Entrez votre mail</legend>
        <p>
            <label for="siret">Siret</label>
            <input type="text" name="siret" id="siret" required placeholder="01234567891011">
        </p>
        <p>
            <label for="mail">Email</label>
            <input type="text" name="mail" id="mail" required placeholder="rick.astley@roll.com">
        <p>
            <input type="hidden" name="action" value="changePassword">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Envoyer mail">
        </p>
    </form>
</div>
</body>

</html>