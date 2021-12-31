<?php
   include "../Features/verifier_connex.php";
   if(verif()==0){
      header("location:supprimerProfil.php");
   }
   else{
      //connexion base
      include "../Features/connexionBD.php";
      var_dump($_SESSION);
      $rq=$connex->prepare("DELETE FROM `membre` WHERE idMembre=:id ");
      
      if((isset($_GET["id"])&&(strcmp($_SESSION["rang"],"A")==0)))
         $rq->bindValue(":id",$_GET["id"]); 
      else
         $rq->bindValue(":id",$_SESSION["idMembre"]);    
      $rq->execute();
     
      if((isset($_GET["id"])&&(strcmp($_SESSION["rang"],"A")==0)))
         header("location:../Features/membre.php");
      else
         header("location:../Features/deconnexion.php");
   }
?>