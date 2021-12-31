<?php
    include "../Features/verifier_connex.php";
    if(verif()==0)
        header("location:consulterProfil.php");
    else{
        //connexion avec la base des données
        include "../Features/connexionBD.php";

        //verifier le mot de passe anien
        $rq=$connex->prepare("SELECT mdpMembre,jetonRecuperationMdp,dateDemandeReintialisationMdp
                        FROM membre 
                        WHERE pseudoMembre = :pseudo"); 

        $rq->bindValue(":pseudo",$_SESSION["pseudo"]);

        $rq->execute();

        $tabMdpO=$rq->fetch();
        var_dump($tabMdpO);
        $timeToken=strtotime('+1 hours',strtotime($tabMdpO["dateDemandeReintialisationMdp"]));
        $timeNow=time();

        if(($tabMdpO["mdpMembre"]==$_POST["passwordO"])
          ||($tabMdpO["jetonRecuperationMdp"]==$_POST["passwordO"]&&$timeNow<$timeToken)){ 
            
            $rq="UPDATE `membre`SET `mdpMembre`=:mdpMembre 
                                WHERE pseudoMembre=:pseudo";
                                        
            //preparation rq
            $pre=$connex->prepare($rq);
            $tabModMembre=array(":mdpMembre"=>$_POST["passwordN"], 
                                ":pseudo"=>$_SESSION["pseudo"]
                                );
                            
            //execution rq
            $pre->execute($tabModMembre); 

            $rq=$connex->prepare("SELECT mdpMembre
                                FROM membre 
                                WHERE pseudoMembre = :pseudo"); 

            $rq->bindValue(":pseudo",$_SESSION["pseudo"]);

            $rq->execute();

            $tabConnexion=$rq->fetch();
            
            $hashedPwd=password_hash($_POST["passwordN"], PASSWORD_DEFAULT); 
            $pwd=$tabConnexion["mdpMembre"];

            if(password_verify($pwd ,$hashedPwd)) {  
                $_SESSION["pwd"]=$hashedPwd; 
                var_dump($_SESSION); 
                header("location:consulterProfil.php");
            }
            else{
                header("location:../index.php?message='Erreur lors de la modification du mot de passe.'");
            }
        }
        else {
            echo"anien non valide";
            header("location:modifierMdp.php?message='Ancien mot de passe invalide;'");
        }
    }
?>
