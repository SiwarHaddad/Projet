<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer reponse</title>

    
    <!-- Main css -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="styleform.css">
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
                <b class="bold"> Supprimer la reponse </b>
            </td>
        </tr>
    </table>
    </div>
    <br/>
    <?php
        include "../Features/verifier_connex.php";
        if(verif()==0){?>
            <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous n'êtes pas connecté.</b></p>
                </div>
            </div>
        <?php }
        else{?>
            <div class="container_pr">
                <div>
                    <br/>
                    <div class="container_QH">
                        <h4> &emsp;Etes-vous sur de vouloir supprimer cette reponse? </h4>
                    </div>
                    <div>
                        <a class="espace">&emsp;</a>
                        <a class="btn btn-success my-2 mx-2 my-sm-0 bouton2 " href="supprimerReponse_action.php?idR=<?=$_GET["idR"];?>"> &emsp;Oui&emsp;  </a>
                        <a class="btn btn-success my-2 mx-2 my-sm-0 bouton2" href="../index.php"> &emsp;Non&emsp;  </a>  
                    </div>
                <br/>
                </div>
            </div>
            <br/>
    <?php } ?>

</body>
</html>