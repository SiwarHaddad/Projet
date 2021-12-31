<?php
   include "../Features/verifier_connex.php";
   if(verif()==0)
      header("location:modifierProfil.php");
   else{
      //connexion avec la base des données
      include "../Features/connexionBD.php";

      $rq="UPDATE `membre`SET `pseudoMembre`=:pseudoMembre ,`emailMembre`=:emailMembre, `nomMembre`=:nomMembre,
                              `prenomMembre`=:prenomMembre,`ddnMembre`=:ddnMembre, `pdpMembre`=:pdpMembre
                        WHERE idMembre=:id";
                                 
      //preparation rq
      $pre=$connex->prepare($rq);
      $tabModMembre=array(":id"=>$_SESSION["idMembre"], 
                        ":pseudoMembre"=>$_POST["pseudonym"],
                        ":emailMembre"=>$_POST["email"],
                        ":nomMembre"=>$_POST["name"],
                        ":prenomMembre"=>$_POST["firstname"],
                        ":ddnMembre"=>$_POST["ddn"],
                        ":pdpMembre"=>$_POST["pdp"]
                        );
      
      $_SESSION["pseudo"]=$_POST["pseudonym"];
                           
      //execution rq
      $e=$pre->execute($tabModMembre); 
      if($e)
         header("location:modifierProfil.php");
   }
?>