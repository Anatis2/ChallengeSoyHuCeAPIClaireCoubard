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
        
        include('connectionBDD.php');
        
        date_default_timezone_set('Europe/Paris');
        $date = date("d-m-Y");
        $heure = date("H:i");

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        
        if ($json == false) {
            echo "Cette ville est inconnue : veuillez rééssayer";
            exit();
        } else {
            $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.
            foreach ($data as $value1) {
                extract ($data);    
            }

            //var_dump($data);

            $idIcone = $weather[0]['icon'];
            $urlIcone = "http://openweathermap.org/img/w/" . $idIcone . ".png";

            echo "<section>";
            echo "<h3>Résultats de la dernière requête</h3>";
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
                        <td><img src='" . $urlIcone . "'/></td>
                        <td>" . ucfirst($weather[0]['description']) . "</td>
                        <td>" . $main['temp'] . "°C</td>
                        <td>" . $main['pressure'] . " hPa</td>
                        <td>" . $main['humidity'] . "%</td>
                        <td>" . $wind['speed'] . " m/s</td>
                        <td>" . $clouds['all'] . "%</td>
                    </tr>
                </table>";
            echo "</section>";
        }
    }
    
    
    /*
     * Insère une ville dans la table ville de la BDD
     */
    function insertionVilleDansBDD() {
        include('connectionBDD.php');

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }
        
        $reqInsertDataVille = $connexion->prepare('INSERT INTO ville(`nomVille`) VALUES(?)');
        $reqInsertDataVille->execute(array($nomVille));
        $reqInsertDataVille->closeCursor();
        
    }
    
    
    /*
     * Vérifie si la ville existe déjà dans la table ville
     */
    function verifDoublonsVille() {
        include('connectionBDD.php');
        
        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        
        $selectNomVille = "SELECT * FROM ville WHERE nomVille='$nomVille'";
        $reqSelectNomVille = $connexion->query($selectNomVille);        
        $resSelectNomVille = $reqSelectNomVille->fetchAll();

        if(!$resSelectNomVille){ // Si la ville n'existe pas dans la table, alors on insère la ville dans la table ville
            echo insertionVilleDansBDD();
        }  
        $reqSelectNomVille->closeCursor();
    }
    
    
    /*
     * Insère une condition météorologique dans la table conditiongenerale de la BDD
     */
    function insertionConditionMeteoDansBDD() {
        include('connectionBDD.php');

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }
        
        $reqInsertConditionsGenerales = $connexion->prepare('INSERT INTO conditiongenerale(`nomCondition`, `idIcone`) VALUES (?, ?)');
        $reqInsertConditionsGenerales->execute(array($weather[0]['description'], $weather[0]['icon']));
        $reqInsertConditionsGenerales->closeCursor();
        
    }
    
    
    /*
     * Vérifie si la condition météo existe déjà dans la table conditiongenerale
     */
    function verifDoublonsConditionsMeteo() {
        include('connectionBDD.php');
        
        $nomVille = htmlspecialchars(cleanString($_GET['nomVille'])); 
        
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }
        
        $selectNomCondition = "SELECT * FROM conditiongenerale WHERE nomCondition='" . $weather[0]['description'] . "'";
        $reqSelectNomCondition = $connexion->query($selectNomCondition);        
        $resNomCondition = $reqSelectNomCondition->fetchAll();

        if(!$resNomCondition){ // Si la condition météo n'existe pas dans la table, alors on insère cette condition dans la table conditionGenerale
            echo insertionConditionMeteoDansBDD();           
        } 
        $reqSelectNomCondition->closeCursor();
    }
    
    
    /**
     * Insère les données de la dernière requête dans la BDD
     */
    function insertionRequeteDansBDD() {
        include('connectionBDD.php');
        
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");
        $heure = date("H:i");

        $nomVille = htmlspecialchars(cleanString($_GET['nomVille']));
        $selectIdVille = "SELECT idVille FROM ville WHERE nomVille='" . $nomVille . "'";
        $reqSelectIdVille = $connexion->query($selectIdVille);        
        $resIdVille = $reqSelectIdVille->fetchAll();
        
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $nomVille . "&units=metric&lang=fr&appid=34266f6b097e0c17aeddb1f71e21f16a";
        $json = file_get_contents($url); //Lit le fichier et le récupère dans un tableau
        $data = json_decode($json, true); //Récupère une chaîne encodée en JSON et la convertit en une variable PHP.

        foreach ($data as $value1) {
            extract ($data);    
        }
        
        /*------------------------------- Insertions dans la table requete -------------------------------------*/
        $reqInsertData = $connexion->prepare('INSERT INTO requete(`dateRequete`, `valeurTemperature`, `valeurPression`, `valeurHumidite`, `valeurVent`, `valeurNuages`, `idVille`) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $reqInsertData->execute(array($date . " " . $heure, $main['temp'], $main['pressure'], $main['humidity'], $wind['speed'], $clouds['all'], $resIdVille[0]['idVille']));
        $reqInsertData->closeCursor();
        
        /*------------------------------- Insertions dans la table refleter -------------------------------------*/
        $selectIdCondition = "SELECT idCondition FROM `conditiongenerale` WHERE  nomCondition='" . $weather[0]['description'] . "'";
        $reqSelectIdCondition = $connexion->query($selectIdCondition);        
        $resIdCondition = $reqSelectIdCondition->fetchAll();
        
        foreach ($resIdCondition as $value) {
            extract ($resIdCondition);    
        }
        
        $idCondition = $resIdCondition[0][0];
       
        $selectIdRequete = "SELECT idRequete FROM `requete` WHERE idRequete=LAST_INSERT_ID()";
        $reqIdRequete = $connexion->query($selectIdRequete);        
        $resIdRequete = $reqIdRequete->fetchAll();
        
        $resIdRequete = $resIdRequete[0][0];
        
        $reqInsertDataRefleter = $connexion->prepare('INSERT INTO refleter(`idCondition`, `idRequete`) VALUES (?, ?)');
        $reqInsertDataRefleter->execute(array($idCondition, $resIdRequete));
        $reqInsertDataRefleter->closeCursor();
                
    }
  
    
    /*
     * Affiche les 10 dernières données de la BDD
     */
    function afficheDonneesBDD() {
        
        include('connectionBDD.php');
        
        echo "<table class='tabBDD'>
                <tr>
                    <th>Ville</th>
                    <th>Date (heure de Paris)</th>
                    <th>Conditions générales</th>
                    <th>Température</th>
                    <th>Pression</th>
                    <th>Humidité</th>
                    <th>Vent (vitesse)</th>
                    <th>Couverture nuageuse</th>
                </tr>";
        
        $selectDonneesMeteo = "SELECT * FROM `requete` req "
                        . "JOIN `ville` vil ON req.idVille = vil.idVille "
                        . "JOIN `refleter` refl ON req.idRequete = refl.idRequete "
                        . "JOIN `conditionGenerale` cond ON refl.idCondition = cond.idCondition "
                        . "ORDER BY req.idRequete DESC LIMIT 10";
        $reqSelectDonneesMeteo = $connexion->query($selectDonneesMeteo);        
        $resSelectDonneesMeteo = $reqSelectDonneesMeteo->fetchAll();

        foreach ($resSelectDonneesMeteo as $value1) {
            extract ($resSelectDonneesMeteo);

            echo "<tr>
                    <td>" . ucfirst($value1['nomVille']) . "</td>
                    <td>" . $value1['dateRequete'] . "</td>
                    <td>" . ucfirst($value1['nomCondition']) . "</td>
                    <td>" . $value1['valeurTemperature'] . "</td>
                    <td>" . $value1['valeurPression'] . "</td>
                    <td>" . $value1['valeurHumidite'] . "</td>
                    <td>" . $value1['valeurVent'] . "</td>
                    <td>" . $value1['valeurNuages'] . "</td>
                </tr>";
        }        
        
        echo "</table>";
    }
    
    
    /*
     * Affiche les 10 dernières données de la BDD, par ville
     */
    function afficheDonneesBDDParVille() {
        include('connectionBDD.php');
        
        $nomVilleComparaison = htmlspecialchars(cleanString($_GET['nomVilleComparaison']));

        echo "<table class='tabBDD'>
                <tr>
                    <th>Ville</th>
                    <th>Date (heure de Paris)</th>
                    <th>Conditions générales</th>
                    <th>Température</th>
                    <th>Pression</th>
                    <th>Humidité</th>
                    <th>Vent (vitesse)</th>
                    <th>Couverture nuageuse</th>
                </tr>";
        
        $selectDonneesMeteo = "SELECT * FROM `requete` req "
                        . "JOIN `ville` vil ON req.idVille = vil.idVille "
                        . "JOIN `refleter` refl ON req.idRequete = refl.idRequete "
                        . "JOIN `conditionGenerale` cond ON refl.idCondition = cond.idCondition "
                        . "WHERE nomVille='" . $nomVilleComparaison . "'"
                        . "ORDER BY req.idRequete DESC LIMIT 10";
        $reqSelectDonneesMeteo = $connexion->query($selectDonneesMeteo);        
        $resSelectDonneesMeteo = $reqSelectDonneesMeteo->fetchAll();

        foreach ($resSelectDonneesMeteo as $value1) {
            extract ($resSelectDonneesMeteo);

            echo "<tr>
                    <td>" . ucfirst($value1['nomVille']) . "</td>
                    <td>" . $value1['dateRequete'] . "</td>
                    <td>" . ucfirst($value1['nomCondition']) . "</td>
                    <td>" . $value1['valeurTemperature'] . "</td>
                    <td>" . $value1['valeurPression'] . "</td>
                    <td>" . $value1['valeurHumidite'] . "</td>
                    <td>" . $value1['valeurVent'] . "</td>
                    <td>" . $value1['valeurNuages'] . "</td>
                </tr>";
        }        
        
        echo "</table>";
    
    }
    
    
    /*
     * Récupère les noms de ville présents dans la BDD et les affiche dans une liste
     */
    function recupNomsVilles() {
        include('connectionBDD.php');
    
        $selectVilles = "SELECT nomVille FROM `ville`";
        $reqSelectVilles = $connexion->query($selectVilles);        
        $resSelectVilles = $reqSelectVilles->fetchAll();
        
        foreach ($resSelectVilles as $resVille) {
            echo "<option value='" . ucfirst($resVille['nomVille']) . "'>" . ucfirst($resVille['nomVille']) . "</option>";
        }

    }
    

?>

