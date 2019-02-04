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
            verifDoublonsVille(); // 1. On insère la ville dans la table correspondante, si cette ville n'existe pas déjà
            verifDoublonsConditionsMeteo(); // 2. On insère les conditions météo dans la table correspondante, si cette condition météo n'existe pas déjà
            insertionRequeteDansBDD(); // 3. On insère les données nécessaires dans la table requete et dans la table refleter            
            echo "<br/><br/>";
            afficheDonneesBDD();
        }     
    } else {
        echo "ERREUR";
    }

?>

<br/>
<p id='lienRetourAccueil'><a href='view_accueil.php'>Retour à l'accueil</a></p>

<?php

    include('view_footer.php');

?>
