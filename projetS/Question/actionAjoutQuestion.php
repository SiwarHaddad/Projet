<?php
    include "../Features/verifier_connex.php";
    if(verif()==0){
        header("location:poserQuestion.php");
    }
    else{
        // connexion avec la base des données
        include "../Features/connexionBD.php";
        
        $rq="INSERT INTO `question`(`idPoserQuestion`, `categorieQuestion`, `objetQuestion`, `contenuQuestion`, `dateQuestion`)
        VALUES (:idPoserQuestion, :categorieQuestion, :objetQuestion, :contenuQuestion, :dateQuestion)";

        //preparation rq
        $pre=$connex->prepare($rq);
        $tabl=array(":idPoserQuestion"=>$_SESSION["idMembre"],
                    ":objetQuestion"=>$_POST["objQuestion"],
                    ":categorieQuestion"=>$_POST["categorieQ"],
                    ":contenuQuestion"=>$_POST["question"],
                    ":dateQuestion"=>date("Y-m-d H:i:s"));

        //execution rq
        $Er=$pre->execute($tabl);

        if($Er)
        header("location:../index.php");
    } 
?>