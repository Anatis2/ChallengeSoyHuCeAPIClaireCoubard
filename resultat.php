<?php

    include('modele/fonctions.php');
    include('vue/view_header.php');

?>

    <?php

    if (isset($_GET['nomVille'])) {
        $nomVille = htmlspecialchars(cleanString($_GET['nomVille']));
        if (empty($_GET['nomVille'])) {
            echo "<p>Veuillez taper un nom de ville</p>";
            include('vue/view_accueil.php');
        } else {
            echo "<h2>Voici les résultats pour la ville de " . ucfirst($nomVille) . " : </h2>";
            $url = ("https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&appid=34266f6b097e0c17aeddb1f71e21f16a");
            
            $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
            $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.
                    
            foreach ($data as $value1) {
                extract ($data);

                /*echo "DATA :";
                var_dump($data);
                echo "<br/>";*/
                
                echo "<h4>Conditions climatiques :</h4>";
                echo "<p>" . $weather[0]['description'] . "</p>";
                echo "<p>" . $weather[0]['icon'] . "</p>";

                echo "<br/>";
                
                echo "<hr/>";
                
                echo "<h4>Données principales :</h4>";                
                echo "<p>Température : " . $main['temp'] . "°C</p>";
                echo "<p>Pression : " . $main['pressure'] . " hPa</p>";
                echo "<p>Humidité : " . $main['humidity'] . "%</p>";
                
                echo "<hr/>";                

            }
            
        }           
    } else {
        echo "ERREUR";
    }

    ?>

<?php

    include('vue/view_footer.php');

?>
