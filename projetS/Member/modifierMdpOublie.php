<?php
    // On verifie si l'adresse e-mail et la ddn sont associées à un seul compte
    //connexion avec la base des données
    include "../Features/connexionBD.php";
    
    //membre ayant cette adresse et ddn
    $rq=$connex->prepare("SELECT COUNT(*) 
                            FROM membre 
                            WHERE emailMembre=:email
                            AND ddnMembre=:ddn");
    
    $rq->bindValue(":email",$_POST["Oemail"]);
    $rq->bindValue(":ddn",$_POST["Oddn"]);
    
    $rq->execute();
    $tabMdp=$rq->fetch();
    var_dump($tabMdp);

    if ($tabMdp[0]==1){ 
        // On génère notre token

        $string=implode('', array_merge(range('A', 'Z'), range('a', 'z'), range('0','9')));

        $token = substr(str_shuffle($string),0,8);

        // On insertion date et jeton dans bd
        $rqToken=$connex->prepare("UPDATE Membre 
                                    SET dateDemandeReintialisationMdp=NOW(),
                                        jetonRecuperationMdp=:jeton 
                                    WHERE emailMembre=:email");

        $rqToken->bindValue(":jeton",$token);
        $rqToken->bindvalue(":email",$_POST["Oemail"]);

        $rqToken->execute();
    
        $message="Mot de passe temporaire (valable pour uniquement 2 heures): '$token'.";
        $jeton="true";

        header("location:forms/form_connex.php?messageD=$message&jeton=$jeton");
    } 
    else { 
        //pas associé à un compte 
        $message = "pas de membre avec ces données, veuillez réessayer.";

        header("location:forms/form_modifMdp.php?message=$message");
    }
?>
