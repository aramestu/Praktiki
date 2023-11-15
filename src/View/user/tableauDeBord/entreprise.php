<?php
$i=0;
if (is_array($objects) || is_object($objects)) {
    foreach ($objects as $o) {
        // Traitement de chaque élément du tableau ou de l'objet
        if (is_object($o)) {
            echo $o->getsiret();
        } elseif (is_array($o)) {
            $i++;
            echo implode(', ', $o); // Si c'est un tableau, afficher les éléments séparés par une virgule (à ajuster selon vos besoins)
            echo "<br>";
        }
    }
} else {
    // Gérer le cas où $objects n'est ni un tableau ni un objet
    echo "Erreur : \$objects n'est ni un tableau ni un objet.";
}

echo '\n'.$i;