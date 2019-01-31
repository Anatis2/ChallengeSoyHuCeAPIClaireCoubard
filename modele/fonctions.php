<?php

    /**
     * Supprime les majuscules, les caractères spéciaux, les espaces multiples et les underscores
     * @param type $string
     * @return type
     */
    function cleanString($string) {
        // 
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", " ", $string);
        return $string;
    }
    
    /**
     * Affiche les résultats de la requête en cours
     */
    function afficheResultatsRequete() {
        
        date_default_timezone_set('Europe/Paris');
        $date = date("d-m-Y");
        $heure = date("H:i");

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }

        /*echo "DATA :";
        var_dump($data);*/
        
        $idIcone = $weather[0]['icon'];
        $urlIcone = "http://openweathermap.org/img/w/" . $idIcone . ".png";

        echo "<h2>Résultats de la dernière requête :</h2>";
        echo "<table>
                <tr>
                    <th>Ville</th>
                    <th>Date (heure de Paris)</th>
                    <th>En résumé</th>
                    <th>Conditions générales</th>
                    <th>Température</th>
                    <th>Pression</th>
                    <th>Humidité</th>
                    <th>Vent (vitesse)</th>
                    <th>Couverture nuageuse</th>
                </tr>
                <tr>
                    <td>". ucfirst($nomVille) . "</td>
                    <td>Le " . $date . " à " . $heure . "</td>
                    <td><img src='" . $urlIcone . "'</td>
                    <td>" . ucfirst($weather[0]['description']) . "</td>
                    <td>" . $main['temp'] . "°C</td>
                    <td>" . $main['pressure'] . " hPa</td>
                    <td>" . $main['humidity'] . "%</td>
                    <td>" . $wind['speed'] . " m/s</td>
                    <td>" . $clouds['all'] . "%</td>
                </tr>
            </table>";

    }
    
    /**
     * Insère les données de la dernière requête dans la BDD
     */
    function insertionDansBDD() {
        include('connectionBDD.php');
        
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");
        $heure = date("H:i");

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }
        
        $reqInsertData = $connexion->prepare('INSERT INTO requete(`dateRequete`, `valeurTemperature`, `valeurPression`, `valeurHumidite`, `valeurVent`, `valeurNuages`) VALUES (?, ?, ?, ?, ?, ?)');
        $reqInsertData->execute(array($date . " " . $heure, $main['temp'], $main['pressure'], $main['humidity'], $wind['speed'], $clouds['all'] ));
        $reqInsertData->closeCursor();
    }
    
    function afficheDonneesBDD() {
        include('connectionBDD.php');
        
        $selectDonneesMeteo = "SELECT * FROM `requete` ORDER BY `dateRequete` DESC LIMIT 10";
        $reqSelectDonneesMeteo = $connexion->query($selectDonneesMeteo);        
        $resSelectDonneesMeteo = $reqSelectDonneesMeteo->fetchAll();
        
        echo "<br/>";
        echo "<table>
                <tr>
                    <th>Ville</th>
                    <th>Date (heure de Paris)</th>
                    <th>Température</th>
                    <th>Pression</th>
                    <th>Humidité</th>
                    <th>Vent (vitesse)</th>
                    <th>Couverture nuageuse</th>
                </tr>";
        
        foreach ($resSelectDonneesMeteo as $value1) {
            extract ($resSelectDonneesMeteo);
            
            //var_dump($value1);
            
            echo "<tr>
                    <td>Ville</td>
                    <td>" . $value1['dateRequete'] . "</td>
                    <td>" . $value1['valeurTemperature'] . "</td>
                    <td>" . $value1['valeurPression'] . "</td>
                    <td>" . $value1['valeurHumidite'] . "</td>
                    <td>" . $value1['valeurVent'] . "</td>
                    <td>" . $value1['valeurNuages'] . "</td>
                </tr>";
            
        }

        echo "</table>";
    }

?>

