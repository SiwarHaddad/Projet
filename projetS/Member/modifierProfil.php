<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inscription </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../style/fonts/material-icon/css/material-design-iconic-font.min.css">

    
    <!-- Main css -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="forms/styleform.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../styleProjet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>

<body>
<!-- header -->
<div class="container_pr">
    <table>
        <tr>
            <td style="width:25px;">
                <a class="cat" href="../index.php"><img class="arrow" style="width:25px; height:25px; border-radius:50%;" src="../images/arrow.png?>" alt="return"></a>
            </td>
            <td style="width:70%;">
                <b class="bold"> Modifier profil</b>
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
        //import member_data
        include "../Features/connexionBD.php";
        
        $rq=$connex->prepare("SELECT *
                                FROM membre,`image` 
                                WHERE idImage=pdpMembre
                                AND idMembre = :id");

        $rq->bindValue(":id",$_SESSION["idMembre"]);
        $rq->execute();
        $tabMembre=$rq->fetch(PDO::FETCH_ASSOC);

        // import 'images'
        $pre=$connex->prepare("SELECT  `idImage`, `nomImage` FROM `IMAGE`");
        $pre->execute();
        $tabImage=$pre->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container_pf">
        <br/>
        <form method="POST" action="modifierProfil_action.php" onSubmit="return validation(this)">
            
            <!-- nom -->
            <div class="form-group">
                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="name" id="name" placeholder="votre nom" value="<?=$tabMembre["nomMembre"]?>" required/>
            </div>

            <!-- prenom -->
            <div class="form-group">
                <label for="firstname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" value="<?=$tabMembre["prenomMembre"]?>"required/>
            </div>

            <!-- pseudo -->
            <div class="form-group">
                <label for="pseudonym"><i class="zmdi zmdi-account material-icons-name"></i></label>
                <input type="text" name="pseudonym" id="pseudonym" placeholder="Votre pseudo" value="<?=$tabMembre["pseudoMembre"]?>"required/>
            </div>
            
            <!-- email -->
            <div class="form-group">
                <label for="email"><i class="zmdi zmdi-email"></i></label>
                <input type="email" name="email" id="email" placeholder="Votre adresse Email" value="<?=$tabMembre["emailMembre"]?>" required/>
            </div>
            
            <!-- ddn -->
            <div class="form-group">
                <label for="ddn"></label>
                <input type="date" name="ddn" id="dnn" placeholder="Votre date de naissance" value="<?=$tabMembre["ddnMembre"]?>" required/>
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
                                <input type="radio" name="pdp" value="<?=$i+1;?>" <?php if($tabMembre["pdpMembre"]==$tabImage[$i]["idImage"]) echo "checked";?>> 
                                <img width="30px" src="../images/<?=$tabImage[$i]["nomImage"];?>" alt="<?=$tabImage[$i]["nomImage"];?>">
                                <span class="checkmark"></span><br/>
                                </label>
                            <?php } ?> 
                    </div>
                </div>
            </div>
            
            <div class="form-group form-button">
                <input class="button button-brand btn-lg mb-5 mb-lg-2 bouton" type="submit" name="signup" id="signup" class="form-submit" value="modifier profil"/>
            </div>
        </form>
    </div>

<?php } ?>

</body>
</html>