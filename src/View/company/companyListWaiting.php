<body>
<div class="header">
    <h2>
        Liste des entreprises en attente de validation
    </h2>
</div>
<?php $action="afficherListeEntrepriseEnAttenteFiltree";
$controller="Entreprise";
require_once __DIR__ . '/../utilitaire/searchBar.php';?>
<div id="mainContainer" class="subContainer">
    <?php
    foreach ($listEntreprises as $entreprise) {
        require "company.php";
    }
    ?>
</div>
</body>