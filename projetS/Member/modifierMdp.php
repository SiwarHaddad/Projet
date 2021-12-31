<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Modifier mot de passe </title> 

    <!-- Font Icon -->
    <link rel="stylesheet" href="../style/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../styleProjet.css">
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
                    <a class="cat" href="../index.php"><img class="arrow" style="width:25px; height:25px; border-radius:50%;" src="../images/arrow.png?>" alt="return"></a>
                </td>
                <td style="width:70%;">
                    <b class="bold"> Modifier mot de passe </b>
                </td>
            </tr>
        </table>
    </div>
    <?php
        include "../Features/verifier_connex.php";
            
        if(verif()==0){?> 
            <div cla0s="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous n'êtes pas connecté.</b></p>
                </div>
            </div>
        <?php }
        else{?> 
            <div class="container_pf">
                <form method="POST" action="modifierMdp_action.php" onSubmit="return validation(this)">
                    <!-- Old_pwd -->
                    <div class="form-group" >
                    <table>
                        <tr>
                            <td style="width:90%;">
                                <label for="passwordO"><i  class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="password" name="passwordO" id="passwordO" placeholder="ancien mot de passe(composé de 8 caractères)" pattern=".{8}" required/>
                            </td>
                            <td>
                                <button class="eye" id="eye">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../images/eye.png">    
                                </button>
                            </td>
                        </tr>
                    </table>        
                    </div>
                
                    <!-- new_pwd -->
                    <div class="form-group" >
                    <table>
                        <tr>
                            <td style="width:90%;">
                                <label for="passwordN"><i  class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="password" name="passwordN" id="passwordN" placeholder="nouveau mot de passe(composé de 8 caractères)" pattern=".{8}" required/>
                            </td>
                            <td>
                                <button class="eye" id="eyeN">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../images/eye.png">    
                                </button>
                            </td>
                        </tr>
                    </table>        
                    </div>

                    <!-- re-pwd -->
                    <div class="form-group" >
                    <table>
                        <tr>
                            <td style="width:90%;">
                            <label for="confirmpwd"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" class="confirmpwd" name="confirmpwd" id="confirmpwd" placeholder="Confirmer votre nouveau mot de passe(composé de 8 caractères)" pattern=".{8}" required/>
                            </td>
                            <td>
                                <button class="eye" id="eyeconfirm">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../images/eye.png">    
                                </button>
                            </td>
                        </tr>
                    </table>        
                    </div>

                    <div class="form-group form-button">
                        <input class="button button-brand btn-lg mb-5 mb-lg-2 bouton" type="submit" name="signup" id="signup" class="form-submit" value="modifier mot de passe"/>
                    </div>
                </form>
            </div> 
    <?php } ?>       
    
    <script language="javascript">
        // affichage mot de passe 
        document.getElementById("eye").addEventListener("click", function(e){
            var pwd = document.getElementById("passwordO");
            if(pwd.getAttribute("type")=="password"){
                pwd.setAttribute("type","text");
            } else {
                pwd.setAttribute("type","password");
            }
        });
 
        document.getElementById("eyeN").addEventListener("click", function(e){
            var pwd = document.getElementById("passwordN");
            if(pwd.getAttribute("type")=="password"){
                pwd.setAttribute("type","text");
            } else {
                pwd.setAttribute("type","password");
            }
        });

        document.getElementById("eyeconfirm").addEventListener("click", function(e){
            var pwd = document.getElementById("confirmpwd");
            if(pwd.getAttribute("type")=="password"){
                pwd.setAttribute("type","text");
            } else {
                pwd.setAttribute("type","password");
            }
        });

    // correspondance des deux mots de passe
        function validation(f) {
            if (f.passwordN.value != f.confirmpwd.value) {
                alert('Les deux nouveaux mots de passe saisis ne sont pas les mêmes');
                f.passwordN.focus();
                return false;
            }
            else if (f.passwordN.value == f.confirmpwd.value) {
                return true;
            }
            else {
                f.passwordN.focus();
                return false;
            }
        }
    </script>

</body>
</html>