<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les membres</title>

    <!-- Main css -->
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../styleProjet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>

<body>
    <div class="container_pr">
        <table>
        <tr>
            <td style="width:25px;">
                <a class="cat" href="../index.php"><img class="arrow" style="width:25px; height:25px; border-radius:50%;" src="../images/arrow.png?>" alt="return"></a>
            </td>
            <td style="width:70%;">
                <b class="bold"> Les membres </b>
            </td>
        </tr>
        </table>
    </div>
    <br/>
    <?php
        include "verifier_connex.php";
        if(verif()==0){?>
            <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous n'êtes pas connecté.</b></p>
                </div>
            </div>
        <?php }
        else{
            if(strcmp($_SESSION["rang"],"A")!=0){?>
                <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés seulement pour l'admin.</b></p>
                </div>
            </div>
            <?php }
            else{
                // connexion avec la base des données
                include "connexionBD.php";
                
                //données du membre
                $rq=$connex->prepare("SELECT *
                                    FROM membre,`image`
                                    WHERE idMembre!=:id
                                    AND pdpMembre=idImage");

                $rq->bindValue(":id",$_SESSION["idMembre"]); 
                $rq->execute();
                $membre=$rq->fetchAll(PDO::FETCH_ASSOC);?>
                
                <div class="container_pr">
                <br/>
                    <?php foreach($membre as $m){ ?>
                        <div class="container_QH">
                            <img style="width:40px; height:40px; border-radius:50%;" src="../images/<?=$m["nomImage"]?>" alt="pdp">
                            <b><?=$m["pseudoMembre"]?></b>
                            <div class="dropdown_ alignRight">
                                <a class="espaceR"> &emsp; </a>  
                                <button class="dropbtnM">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../images/threeDots.png">    
                                </button>
                                <div class="dropdown-content">
                                    <a href="../Member/consulterProfil.php?id=<?=$m["idMembre"]?>"> Voir plus d'informations </a>
                                    <a href="../Member/supprimerProfil.php?id=<?=$m["idMembre"]?>"> Supprimer membre</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <br/>
                </div>
            <?php } ?>
        <?php } ?>

</body>
</html>