<?php

    include('modele/fonctions.php');
    include('view_header.php');
    include('view_accueil.php');

?>

<?php

    if (isset($_GET['nomVille'])) {
        
        if (empty($_GET['nomVille'])) {
            echo "<p>Veuillez taper un nom de ville</p>";
        } else {
            afficheResultatsRequete();
            insertionDansBDD();
            echo "<br/>";
            echo "<hr/>";
            afficheDonneesBDD();
        }           
    } else {
        echo "ERREUR";
    }

?>

<p><a href='view_accueil.php'>Retour à l'accueil</a></p>

<?php

    include('view_footer.php');

?>