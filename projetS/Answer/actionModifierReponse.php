<?php
   include "../Features/verifier_connex.php";
   if(verif()==0){
      header("location:modifierReponse.php");
   }
   else{
      //connexion base
      include "../Features/connexionBD.php";
      $rq="UPDATE `reponse` SET `contenuReponse`=:contenuReponse, `dateReponse`=:dateReponse
                          WHERE idReponse=:idR";
      
      //preparation rq
      $pre=$connex->prepare($rq);
      $tabModReponse=array(":idR"=>$_GET["id"],
                        ":contenuReponse"=>$_POST["reponse"],
                        ":dateReponse"=>date("Y-m-d H:i:s"));
      //execution rq
      $e=$pre->execute($tabModReponse);
      if($e) header("location:../index.php");
   }
?>