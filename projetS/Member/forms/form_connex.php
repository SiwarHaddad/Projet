<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Connexion </title> 

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
    <?php } 
    //message alerte
    if (isset($_GET["messageD"])){?>
        <div class="container_ERR_D">
            <div class=" text-center p-3" >
                <div class="text-dark" >
                    <span class="closebtn" onclick="this.parentElement.style.display='none';
                                                    this.parentElement.parentElement.style.display='none';">
                        &times;
                    </span>    
                    <?=$_GET["messageD"]?><br/> Veuillez le conserver pour modifier votre mot de passe dans les paramètres de votre compte 
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
                    <b class="bold"> Se connecter </b>
                </td>
            </tr>
        </table>
    </div>
    
    <?php 
        //verifier si le membre est deja connecté
        include "../../Features/verifier_connex.php";
        
        if(verif()==1){?> 
            <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous êtes déjà connecté.</b></p>
                </div>
            </div>
        <?php }
        else{?>
            <div class="container_pf"> 
                <form method="POST" action="../action_connex.php<?php if(isset($_GET["jeton"])) echo "?jeton=".$_GET["jeton"]; ?>" class="register-form" id="login-form">
                    <!-- pseudo/email -->
                    <div class="form-group">
                        <label for="pseudo_email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="pseudo_email" id="pseudo_email" placeholder="votre pseudo ou adresse e-mail"
                            value="<?php if(isset($_GET["PE"])) echo $_GET["PE"];?>"/>
                    </div>

                    <!-- pwd -->
                    <div class="form-group" >
                    <table>
                        <tr>
                            <td style="width:90%;">
                                <label for="password"><i  class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="password" name="pwd" id="pwd" placeholder="votre mot de passe" 
                                        <?php if(isset($_GET["PE"])) echo "autofocus";?>/>
                            </td>
                            <td>
                                <button class="eye" id="eye">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../../images/eye.png">    
                                </button>
                            </td>
                        </tr>
                    </table>        
                    </div>

                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Se connecter"/>
                        <br/><br/>
                        <a href="form_modifMdp.php" class="signup-image-link"><u>Mot de passe oublié?</u></a>
                        <a href="form_inscri.php" class="signup-image-link"><u>Créer un nouveau compte</u></a>
                    </div>
                </form>
            </div>    
        <?php } ?>

<script language="javascript">
        // affichage mot de passe 
    document.getElementById("eye").addEventListener("click", function(e){
        var pwd = document.getElementById("pwd");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
        } else {
            pwd.setAttribute("type","password");
        }
    });
</script>

</body>
</html>