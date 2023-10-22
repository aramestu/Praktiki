<body>
<div class="header">
    <div class="header">
        <h2>
            Liste des entreprises validées
        </h2>
    </div>
</div>
<div class="container">
    <?php
    use App\SAE\Model\Repository\EntrepriseRepository;
    $listEntreprises = EntrepriseRepository::getEntrepriseValide();
    foreach ($listEntreprises as $entreprise){
        require "company.php";
    }
    ?>
</div>
</body>