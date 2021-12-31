

<?php
    include "../Features/verifier_connex.php";
    if(verif()==1){
        header("location:forms/form_connex.php");
    }
    else{
        if(!(isset($_POST["pseudo_email"],$_POST["pwd"]))){ 
            header("location:forms/form_connex.php");
        }
        else{
            //un champ (ou plus) est/sont vide(s)
            if(empty($_POST["pseudo_email"])||empty($_POST["pwd"])){
                $message="Veuillez remplir le formulaire.";
                header("location:forms/form_connex.php?message=$message");
            }
            else{
                session_start();
                
                //connexion avec la base des données
                include "../Features/connexionBD.php";

                $rq=$connex->prepare("SELECT idMembre,mdpMembre,pseudoMembre,emailMembre,jetonRecuperationMdp,
                                            dateDemandeReintialisationMdp,rangMembre 
                                    FROM membre 
                                    WHERE pseudoMembre = :pseudo OR emailMembre=:email"); 
                                    
                $rq->bindValue(":pseudo",$_POST["pseudo_email"]);
                $rq->bindValue(":email",$_POST["pseudo_email"]);

                $rq->execute();
                
                $tabConnexion=$rq->fetch();
                var_dump($tabConnexion);
                
                //aucune correspondance
                if(empty($tabConnexion)){
                    $message="Pas de membre avec cette adresse mail ou ce pseudo.";
                    header("location:forms/form_connex.php?message=$message");
                }
                else{
                    // crypter le mot de passe saisi par l'utilisateur
                    $hashedPwd=password_hash($_POST["pwd"], PASSWORD_DEFAULT); 
                    var_dump($_POST);
                    $timeToken=strtotime('+1 hours',strtotime($tabConnexion["dateDemandeReintialisationMdp"]));
                    $timeNow=time();
                    
                    if(isset($_GET["jeton"])&& $timeNow<$timeToken)
                        $pwd=$tabConnexion["jetonRecuperationMdp"];
                    else
                        $pwd=$tabConnexion["mdpMembre"];
                    
                        echo "pwd: $pwd";
                    if(password_verify($pwd ,$hashedPwd)) {  
                        $_SESSION["idMembre"]=$tabConnexion["idMembre"];
                        $_SESSION["pwd"]=$hashedPwd; 
                        $_SESSION["pseudo"]=$tabConnexion["pseudoMembre"];
                        $_SESSION["rang"]=$tabConnexion["rangMembre"];
                        header("location:../index.php");
                    } 
                    else{
                        $message="Mot de passe incorrecte.";
                        $add=$_POST["pseudo_email"];
                        header("location:forms/form_connex.php?message=$message&PE=$add");
                    }
                }
            }
        }
    }
?>