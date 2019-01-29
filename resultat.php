<?php

    include('vue/view_header.php');


?>
        
    <h2>Page de résultats</h2>

    <?php

    if (isset($_POST['nomVille'])) {
        $nomVille = $_POST['nomVille'];
        if (empty($_POST['nomVille'])) {
            echo "<p>Veuillez taper un nom de ville</p>";
            include('vue/view_accueil.php');
        } else {
            echo "Vous avez tapé : " . $nomVille;
        }                
    } else {
        echo "ERREUR";
    }

    ?>

<?php

    include('vue/view_footer.php');

?>
