<?php
   include "../Features/verifier_connex.php";
   if(verif()==0){ 
         header("location:supprimerQuestion.php");
   }
   else{
      //connexion base
      include "../Features/connexionBD.php";
      $rq="DELETE FROM `question` WHERE idQuestion=:idQ";
      
      //preparation rq
      $pre=$connex->prepare($rq);
      $tabSupprQuestion=array(":idQ"=>$_GET["idQ"]);
      
      //execution rq
      $e=$pre->execute($tabSupprQuestion);
      if($e) 
            header("location:../index.php");
   }
?>
