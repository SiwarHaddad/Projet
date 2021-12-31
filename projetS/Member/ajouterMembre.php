<?php
    include "../Features/verifier_connex.php";
    if(verif()==1){
        header("location:../index.php");
    }
    else{
        if(!(isset($_POST["pdp"]))){ 
            $message="Veuillez choisir une photo pour votre profil.";
            header("location:forms/form_inscri.php?message=$message");
        }
        else{
            if(!(isset($_POST["agree-term"]))){ 
                $message="Veuillez accepter les termes du site.";
                header("location:forms/form_inscri.php?message=$message");
            }
            else{
                //connexion avec la base des données
                include "../Features/connexionBD.php";

                $rq=$connex->prepare("SELECT idMembre,mdpMembre,pseudoMembre,emailMembre,rangMembre 
                                    FROM membre 
                                    WHERE pseudoMembre = :pseudo OR emailMembre=:email"); 
                
                $rq->bindValue(":pseudo",$_POST["pseudonym"]);
                $rq->bindValue(":email",$_POST["email"]);

                $rq->execute();
                
                $tabPseudo_email=$rq->fetch();
                var_dump($tabPseudo_email);
                
                if(!empty($tabPseudo_email)){
                    $message="cette adresse mail ou ce pseudo existe déjà.";
                    echo $message;
                    header("location:forms/form_inscri.php?message=$message");
                }
                else{
                    //insertion nouveau membre dans la base
                    $rq="INSERT INTO `membre`(`pseudoMembre`, `emailMembre`, `mdpMembre`, `nomMembre`, `prenomMembre`,
                                            `ddnMembre`, `pdpMembre`,`rangMembre`)
                        VALUES ( :pseudoMembre, :emailMembre, :mdpMembre, :nomMembre, :prenomMembre, :ddnMembre, 
                                :pdpMembre,:rangMembre)";
                    
                    //preparation rq
                    $pre=$connex->prepare($rq);
                    $tabMembre=array(":pseudoMembre"=>$_POST["pseudonym"],
                                    ":emailMembre"=>$_POST["email"],
                                    ":mdpMembre"=>$_POST["password"],
                                    ":nomMembre"=>$_POST["name"],
                                    ":prenomMembre"=>$_POST["firstname"],
                                    ":ddnMembre"=>$_POST["ddn"],
                                    ":pdpMembre"=>$_POST["pdp"],
                                    ":rangMembre"=>"C");

                    //execution rq
                    $Er=$pre->execute($tabMembre);
                    if ($Er){
                        session_start();
                        $hashedPwd=password_hash($_POST["password"], PASSWORD_DEFAULT); 
                        $_SESSION["pwd"]=$hashedPwd; 
                        $_SESSION["pseudo"]=$tabMembre[":pseudoMembre"];
                        
                        header("location:ajouterMembre_suite.php");
                    }
                    else 
                        header("location:../index.php?message='echec enregistrement'");
                }
            }
        }
    }
?>