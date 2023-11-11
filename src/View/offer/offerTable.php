<div class="tableResponsive">
    <?php
    if(empty($listeExpPro)){
        require 'noOfferFound.php';
    }else{
        foreach ($listeExpPro as $expPro) {
            require 'smallOffer.php';
        }
    }
    ?>
</div>