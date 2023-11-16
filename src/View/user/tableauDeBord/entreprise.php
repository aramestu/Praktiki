<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>

<h2>Vos offres</h2>
<div id="tableOffer">
    <?php
    /*var_dump($taille);
    foreach ($listeExpPro as $o){
        var_dump($o);
    }*/



    \App\SAE\Controller\ControllerExpPro::getExpProEntreprise(); ?>
</div>