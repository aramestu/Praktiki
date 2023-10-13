<a href="frontController.php?controller=Main&action=afficherOffre&experiencePro= <?php echo rawurlencode($expPro->getId())?> " style="text-decoration:none" id="offerButton">
    <div class="subContainer small">
        <div class="header">
            <div class="left">
                <p class="bold"><?php
                    $full_path = get_class($expPro);
                    $elements = explode('\\', $full_path);
                    $last_element = end($elements);
                    echo $last_element
                    ?></p>
                <p>Date du poste</p>
            </div>
            <div class="right">
                <p>Du <?php echo $expPro->getDateDebut();?></p>
                <p>au <?php echo $expPro->getDateFin();?></p>
            </div>
        </div>
        <div class="information">
            <h3><?php echo $expPro->getSujet();?></h3>
            <p>Entreprise</p>
            <label><?php echo $expPro->getAdresse();?></label>
        </div>
    </div>
</a>