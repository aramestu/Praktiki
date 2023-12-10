<div class="container">
    <h1> Message de <?php echo $enseignant->getNomEnseignant() . ' ' . $enseignant->getPrenomEnseignant() . ' le ' . $annotation->getDateAnnotation();?> </h1>

    <p> <?php echo $annotation->getContenu();?> </p>
</div>