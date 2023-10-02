<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Offre</title>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="information">
                <p id="bold">stage/alternance</p>
                <p>du 01/10/2023</p>
                <p>au 20/11/2023</p>
            </div>
            <div class="company">
                <h2>Entreprise</h2>
                <label>adresse de l'entreprise / code postal stage</label>
            </div>

        </div>
        <ul>
            <li>Date de création de l'offre</li>
            <li>Effectif entreprise</li>
            <li>téléphone (pas sûr)</li>
            <li><a href="http://localhost/sae_web_s1/web/frontController.php?action=home" class="link">site web</a></li>
        </ul>
        <div class="text">
            <?php
            echo "information sur le stage avec le sujet, les tâches, la thématique peut être aussi la durée... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec accumsan sem. Quisque at ligula dui. Mauris eleifend tempor mi ac faucibus. In varius velit non sem fringilla, eu convallis elit commodo. Donec nunc velit, placerat at molestie at, ornare eu augue. Curabitur sed elit vitae tellus sollicitudin ullamcorper. Proin non libero sed eros vehicula gravida. Donec in leo nibh. Curabitur mattis urna non leo facilisis, quis laoreet lectus consectetur.

Integer laoreet nulla arcu, ullamcorper cursus sapien tempor in. Ut non vestibulum libero. In porta, eros non placerat vestibulum, orci justo feugiat dolor, quis dignissim justo lectus id diam. Nam at metus sem. Donec vel elit sit amet elit ornare euismod vel at mi. Sed gravida auctor velit. Nunc egestas, purus ut rhoncus ornare, sem felis fringilla mi, nec vulputate lacus risus at tellus. Pellentesque bibendum purus vel turpis aliquam euismod."
            ?>
        </div>
        <button id="apply">Postuler</button>
    </div>
</body>

</html>