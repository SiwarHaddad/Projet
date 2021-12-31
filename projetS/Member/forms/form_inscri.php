<!-- import 'images' -->
<?php
     include "../../Features/connexionBD.php";

    $pre=$connex->prepare("SELECT  `idImage`, `nomImage` FROM `IMAGE`");
    $pre->execute();
    $tabImage=$pre->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inscription </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../style/fonts/material-icon/css/material-design-iconic-font.min.css">
    
    <!-- Main css -->
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="styleform.css">
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
                    <b class="bold"> Créer un compte </b>
                </td>
            </tr>
        </table>
    </div>

    <?php
        //verifier si le membre est deja connecté
        include "../../Features/verifier_connex.php";
        
        if(verif()==1){ ?> 
            <div class="container_pr">
                <div class='signin-form'><br/>
                    <p class='form-title'><b>Accés impossible: vous êtes déjà connecté.</b></p>
                </div>
            </div>
        <?php }

        else{ ?>
            <div class="container_pf">
                <br/>
                <form method="POST" action="../ajouterMembre.php" onSubmit="return validation(this)">
                    <!-- nom -->
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="votre nom" required/>
                    </div>

                    <!-- prenom -->
                    <div class="form-group">
                        <label for="firstname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" required />
                    </div>

                    <!-- pseudo -->
                    <div class="form-group">
                        <label for="pseudonym"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="pseudonym" id="pseudonym" placeholder="Votre pseudo" required/>
                    </div>
                    
                    <!-- email -->
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Votre adresse Email" required/>
                    </div>
                    
                    <!-- ddn -->
                    <div class="form-group">
                        <label for="ddn"></label>
                        <input type="date" name="ddn" id="dnn" placeholder="Votre date de naissance" required/>
                    </div>
                    
                    <!-- pwd -->
                    <div class="form-group" >
                    <table>
                        <tr>
                            <td style="width:90%;">
                                <label for="password"><i  class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="password" name="password" id="password" placeholder="votre mot de passe(composé de 8 caractères)" pattern=".{8}" required/>
                            </td>
                            <td>
                                <button class="eye" id="eye">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../../images/eye.png">    
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
                                <input type="password" class="confirmpwd" name="confirmpwd" id="confirmpwd" placeholder="Confirmer votre mot de passe(composé de 8 caractères)" pattern=".{8}" required/>
                            </td>
                            <td>
                                <button class="eye" id="eyeconfirm">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="../../images/eye.png">    
                                </button>
                            </td>
                        </tr>
                    </table>        
                    </div>

                    <!-- pdp -->
                    <div class="form-group">
                        <label for="pdp"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="pdp" id="pdp" placeholder="Votre photo de profil" disabled/>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
                            <div class="checkbox-tick">
                                <?php for($i=0;$i<count($tabImage);$i++){ ?>
                                    <label >
                                        <input type="radio" name="pdp" value="<?=$i+1;?>"> 
                                        <img style="width:40px; height:40px; border-radius:50%;" src="../../images/<?=$tabImage[$i]["nomImage"];?>" alt="<?=$tabImage[$i]["nomImage"];?>">
                                        <span class="checkmark"></span><br/>
                                    </label>
                                    <?php } ?> 
                            </div>
                        </div>
                    </div>
                    <!-- acceptation -->
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"/>
                        <!-- required="" autofocus="" -->
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>j'accepte tous les termes du site</label>
                        <!-- don't forget about it -->
                    </div>

                    <div class="form-group form-button">
                        <input class="button button-brand btn-lg mb-5 mb-lg-2 bouton" type="submit" name="signup" id="signup" class="form-submit" value="Creer le compte"/>
                    </div>
                    <div>
                        
                    <a href="form_connex.php" class="signup-image-link"><u>Déjà un membre</u></a>
                    </div> 
                    <div>
                        &emsp;
                    </div>   
                </form>
            </div>

    <!-- code javascript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script language="javascript">
    // affichage mot de passe 
        document.getElementById("eye").addEventListener("click", function(e){
            var pwd = document.getElementById("password");
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
            if (f.password.value != f.confirmpwd.value) {
                alert('Les deux mots de passe saisis ne sont pas les mêmes');
                f.password.focus();
                return false;
            }
            else if (f.password.value == f.confirmpwd.value) {
                return true;
            }
            else {
                f.password.focus();
                return false;
            }
        }
    </script>
    <?php } ?>
</body>
</html>
