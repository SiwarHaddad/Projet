<?php
    session_start();

    //connexion avec la base des données
    include "../Features/connexionBD.php";

    $rq=$connex->prepare("SELECT idMembre,rangMembre
                          FROM membre
                          where pseudoMembre=:pseudo");

    $rq->bindValue(":pseudo",$_SESSION["pseudo"]); 

    $rq->execute();
    $tabMembre=$rq->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION["rang"]=$tabMembre["rangMembre"];
    $_SESSION["idMembre"]=$tabMembre["idMembre"];

    header("location:../index.php");  
?>