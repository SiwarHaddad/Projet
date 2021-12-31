<?php
    //connexion à la base de donnée
    try {
        $connex=new PDO("mysql:host=localhost;dbname=projet","root","");
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>