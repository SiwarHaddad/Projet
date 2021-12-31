<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Donner réponse </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../style/fonts/material-icon/css/material-design-iconic-font.min.css">

    
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
                    <b class="bold"> Donner réponse </b>
                </td>
            </tr>
        </table>
    </div>
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
            <div class="container_pf">
                <br/>
                <form action="actionAjoutReponse.php?idQ=<?=$_GET["idQ"]?>" method="post" class="register-form">
                    <!-- reponse  -->
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <textarea name="reponse" id="reponse" placeholder="Votre reponse" class="form-control" style="height: 99px;" required ></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group form-button">
                        <input class="button button-brand btn-lg mb-5 mb-lg-2 bouton" type="submit" name="signup" id="signup" class="form-submit" value="Donner réponse"/>
                    </div>   
                </form>
            </div>
        <?php } ?>
</body>
</html>
