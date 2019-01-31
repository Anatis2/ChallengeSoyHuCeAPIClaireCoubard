<?php

    try {
        $connexion = new PDO("mysql:host=localhost; port=3306; dbname=challengesoyhuce; charset=utf8", "root", "");   // local
    } catch (Exception $ex) {
        echo "ERREUR : échec de la connection à la Base De Données";
    }

?>

