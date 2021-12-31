<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mot de passe oublié </title> 

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../style/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../bootstrap.min.css">
    <link rel="stylesheet" href="../../styleProjet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>

<body>
    <?php 
        //message d'erreur
        if (isset($_GET["message"])){?>
            <div class=container_ERR_M>
                <div class=" text-center p-3" >
                    <div class="text-dark" >
                        <span class="closebtn" onclick="this.parentElement.style.display='none';
                                                        this.parentElement.parentElement.style.display='none';">
                            &times;
                        </span>    
                        <?=$_GET["message"]?> 
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <div class="container_pr">
        <table>
            <tr>
                <td style="width:25px;">
                    <a class="cat" href="../../index.php"><img class="arrow" style="width:25px; height:25px; border-radius:50%;" src="../../images/arrow.png?>" alt="return"></a>
                </td>
                <td style="width:70%;">
                    <b class="bold"> Mot de passe oublié </b>
                </td>
            </tr>
        </table>
    </div>
      
    <div class="container_pf">
        <p> <b>Veuillez d'abord saisir votre adresse et votre date de naissance.</b> </p><br/>
        <form method="POST" action="../modifierMdpOublie.php" class="register-form" id="login-form">
            <!-- pseudo/email -->
            <div class="form-group">
                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="Oemail" id="email" placeholder="votre adresse e-mail" required/>
            </div>

            <!-- ddn -->
            <div class="form-group">
                <label for="ddn"></label>
                <input type="date" name="Oddn" id="dnn" placeholder="Votre date de naissance" required/>
            </div>

            <div class="form-group form-button">
                <input type="submit" name="suivant" id="suivant" class="form-submit" value="Suivant"/>
            </div>
        </form>
    </div>    

</body>
</html>