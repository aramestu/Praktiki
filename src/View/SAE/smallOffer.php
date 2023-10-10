<div class="subContainer small">
    <div class="information">
        <p class="bold"><?php
                                        $full_path = get_class($expPro);
                                        $elements = explode('\\', $full_path);
                                        $last_element = end($elements);
                                        echo $last_element
                                        ?></p>
        <p>Date du poste</p>

    </div>
    <div class="company">
        <h2>Entreprise</h2>
        <label><?php echo $expPro->getAdresse();?></label>
    </div>
    <div class="information2">
        <p>du date <?php echo $expPro->getDateDebut();?></p>
        <p>au date <?php echo $expPro->getDateFin();?></p>
    </div>
</div>