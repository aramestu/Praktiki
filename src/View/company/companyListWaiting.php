<body>
<div class="header">
    <div class="header">
        <h2>
            Liste des entreprises en attente de validation
        </h2>
    </div>
</div>
<div id="mainContainer" class="subContainer">
    <?php

    use App\SAE\Model\Repository\EntrepriseRepository;

    $listEntreprises = EntrepriseRepository::getEntrepriseEnAttente();
    foreach ($listEntreprises as $entreprise) {
        require "company.php";
    }
    ?>
</div>
</body>