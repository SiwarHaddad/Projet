<?php
    include "../Features/verifier_connex.php";
    if(verif()==0){
        header("location:donnerReponse.php");
    }
    else{
        // connexion avec la base des données
        include "../Features/connexionBD.php";
        
        $rq="INSERT INTO `reponse`(`idDonnerReponse`, `idQuestion`, `contenuReponse`, `dateReponse`) 
            VALUES (:idDonnerReponse, :idQuestion, :contenuReponse, :dateReponse)";

        //preparation rq
        $pre=$connex->prepare($rq);
        $tabl=array(":idDonnerReponse"=>$_SESSION["idMembre"],
                    ":idQuestion"=>$_GET["idQ"],
                    ":contenuReponse"=>$_POST["reponse"],
                    ":dateReponse"=>date("Y-m-d H:i:s"));
        //execution rq
        $Er=$pre->execute($tabl);

        if($Er)
            header("location:../index.php");
    } 
?>