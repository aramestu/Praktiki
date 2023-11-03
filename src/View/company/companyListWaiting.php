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
    foreach ($listEntreprises as $entreprise) {
        require "company.php";
    }
    ?>
</div>
</body>