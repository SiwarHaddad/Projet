<?php
   include "../Features/verifier_connex.php";
   if(verif()==0){ 
         header("location:supprimerQuestion.php");
   }
   else{
      //connexion base
      include "../Features/connexionBD.php";
      $rq="DELETE FROM `reponse` WHERE idReponse=:idR";
      
      //preparation rq
      $pre=$connex->prepare($rq);
      $tabSupprReponse=array(":idR"=>$_GET["idR"]);
      
      //execution rq
      $e=$pre->execute($tabSupprReponse);
      if($e) 
            header("location:../index.php");
   }
?>
