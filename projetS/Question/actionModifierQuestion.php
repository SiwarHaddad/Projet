<?php
   include "../Features/verifier_connex.php";
   if(verif()==0){
      header("location:modifierQuestion.php");
   }
   else{
      //connexion base
      include "../Features/connexionBD.php";
      $rq="UPDATE `question`SET `categorieQuestion`=:categorieQuestion, `objetQuestion`=:objetQuestion, 
                              `contenuQuestion`=:contenuQuestion, `dateQuestion`=:dateQuestion
                           WHERE idQuestion=:idQ";
      
      //preparation rq
      $pre=$connex->prepare($rq);
      $tabModQuestion=array(":idQ"=>$_GET["id"],
                           ":categorieQuestion"=>$_POST["categorieQ"],
                           ":objetQuestion"=>$_POST["objQuestion"],
                           ":contenuQuestion"=>$_POST["question"],
                           ":dateQuestion"=>date("Y-m-d H:i:s"));
      //execution rq
      $e=$pre->execute($tabModQuestion);
      if($e) header("location:../index.php");
   }
?>