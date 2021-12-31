<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter profil</title>

    <!-- Main css -->
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../styleProjet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>

<body>
<div class="container_pr">
<table>
    <tr>
        <td style="width:10%;">
            <a class="cat" href="<?php if(!isset($_GET["id"])) echo"../index.php"; else echo"../Features/membre.php"; ?>"><img class="arrow" style="width:25px; height:25px; border-radius:50%;" src="../images/arrow.png?>" alt="return"></a>
        </td>
        <td style="width:50%;">
            <b class="bold"> <?php if(!isset($_GET["id"])) echo"Mon" ?> Profil </b>
        </td>
        <?php if(!isset($_GET["id"])){ ?>
        <td style="width:10%;">
            <div class="dropdown_ alignRight">
                <button class="dropbtnM">
                    <img style="width:25px; height:25px; border-radius:50%;float:right;" src="../images/threeDots.png">    
                </button>
                <div class="dropdown-content">
                    <a href="modifierProfil.php"> Modifier mon profil </a>
                    <a href="supprimerProfil.php"> supprimer mon profil </a>
                    <a href="modifierMdp.php"> Modifier mot de passe </a>
                </div>
            </div>  
        <?php } ?> 
        </td>
    </tr>
</table>
</div>
    
<?php
    include "../Features/verifier_connex.php";
    if(verif()==0){ ?>
        <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous n'êtes pas connecté.</b></p>
                </div>
            </div>
        <?php }
    
    else{ 
        //connexion avec la base des données
        include "../Features/connexionBD.php";
        
        $rq=$connex->prepare("SELECT nomImage
                            FROM membre,`image`
                            WHERE idMembre=:id
                            AND pdpMembre=idImage");

        if((isset($_GET["id"]))&&(strcmp($_SESSION["rang"],"A")==0))
            $rq->bindValue(":id",$_GET["id"]); 
        else
            $rq->bindValue(":id",$_SESSION["idMembre"]);    
        
            $rq->execute();
        $image=$rq->fetch(PDO::FETCH_ASSOC);

        //donnees membre
        $rq=$connex->prepare("SELECT *
                            FROM membre
                            WHERE idMembre=:id");

        if(isset($_GET["id"]))
            $rq->bindValue(":id",$_GET["id"]); 
        else
            $rq->bindValue(":id",$_SESSION["idMembre"]);  
        $rq->execute();
        $donnee=$rq->fetch(PDO::FETCH_ASSOC);
        ?>
    
        <div class="container_pr">
            <br/>
            <div class="photo">
                <img  style="width:20%; height:20%;" src="../images/<?=$image["nomImage"];?>" alt="pdp">
            </div> <br/>
            <div class="container_I">
                <b>Pseudonyme: </b> &emsp; <?=$donnee["pseudoMembre"]?>
            </div>
            <div class="container_I">
                <b>E-mail: </b> &emsp; <?=$donnee["emailMembre"]?>
            </div>
            <div class="container_I">
                <b>Nom: </b> &emsp; <?=$donnee["nomMembre"]?>
            </div> 
            <div class="container_I">
                <b>Prenom: </b> &emsp; <?=$donnee["prenomMembre"]?>
            </div> 
            <div class="container_I"> 
                <b>Date de naissance: </b> &emsp; <?=$donnee["ddnMembre"]?>
            </div>
            <div class="container_I">
                <b>Rang: </b> &emsp; <?php if (strcmp($donnee["rangMembre"],"A")==0) echo "Admin"; else echo "simple membre";?>
            </div>
            <br/>
        </div>
    <?php } ?>    
</body>
</html>
