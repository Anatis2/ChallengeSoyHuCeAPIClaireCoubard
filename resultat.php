<?php

    include('modele/fonctions.php');
    include('classes/class_donneesMeteo.php');
    include('view_header.php');
    include('view_accueil.php');

?>

<?php

    if (isset($_GET['nomVille'])) {
        if ((empty($_GET['nomVille'])) && (!isset($_GET['nomVilleComparaison']))) {
            echo "<p>Veuillez taper un nom de ville</p>";
            echo "<br/><br/>";
            afficheDonneesBDD();
        } else {
            afficheResultatsRequete();
            verifDoublonsVille(); // 1. On insère la ville dans la table correspondante, si cette ville n'existe pas déjà
            verifDoublonsConditionsMeteo(); // 2. On insère les conditions météo dans la table correspondante, si cette condition météo n'existe pas déjà
            insertionRequeteDansBDD(); // 3. On insère les données nécessaires dans la table requete et dans la table refleter            
            echo "<br/><br/>";
            afficheDonneesBDD();
        }     
    } elseif (isset($_GET['nomVilleComparaison'])) {
        if (($_GET['nomVilleComparaison']) == "Toutes") {
            echo "<br/><br/>";
            afficheDonneesBDD();
        } else {
            echo "<br/><br/>";
            afficheDonneesBDDParVille();
            echo "<br/><br/>";
            afficheGraphique();
        }
    }
        
?>

<?php
    include('view_footer.php');
?>
