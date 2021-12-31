<?php
    include "../Features/verifier_connex.php";
    if(verif()==0){
        header("location:ajoutercategorie.php");
    }
    else{
        // connexion avec la base des données
        include "../Features/connexionBD.php";
        
        $rq="INSERT INTO `categoriequestion`(`nomCategorie`) VALUES (:nomCategorie)";

        //preparation rq
        $pre=$connex->prepare($rq);
        $tablCategorie=array(":nomCategorie"=>$_POST["categorie"]);

        //execution rq
        $Er=$pre->execute($tablCategorie);

        if($Er)
            header("location:../index.php");
    } 
?>