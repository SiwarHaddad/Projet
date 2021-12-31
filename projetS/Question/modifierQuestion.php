<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier question</title>

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
                    <b class="bold"> Modifier question </b>
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
        else{
            include "../Features/connexionBD.php";
            $rqQ=$connex->prepare("SELECT *
                                FROM question
                                WHERE idQuestion = :idQ");
            $rqQ->bindValue(":idQ",$_GET["idQ"]);
            $rqQ->execute();
            $tabQuestion=$rqQ->fetchAll();
            $Q=$tabQuestion[0];
            
            $rqC=$connex->query("SELECT nomCategorie,idCategorie 
                                    FROM categoriequestion");

            $tabCategories=$rqC->fetchAll();
            ?>

            <div class="container_pf">
                <br/>
                <form action="actionModifierQuestion.php?id=<?=$_GET["idQ"]?>" method="post" class="register-form">
                    <!-- Categorie question -->  
                    <div class="form-row">
                    <b>Categorie question</b><br/>
                        <select name="categorieQ" id="cat">
                            <?php for($i=0;$i<count($tabCategories);$i++){ ?>
                                <option value="<?=$tabCategories[$i]["idCategorie"]?>" <?php if($Q["categorieQuestion"]==$tabCategories[$i]["idCategorie"]) echo "selected";?>><?=$tabCategories[$i]["nomCategorie"]?></option>
                            <?php } ?>
                            </select>
                        </div><br/>
                            
                    <!-- objet question -->
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" name="objQuestion" placeholder="Objet de votre question" value="<?=$Q["objetQuestion"];?>" class="form-control">
                        </div>
                    </div><br/>

                    <!-- question  -->
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <textarea name="question" id="question" placeholder="Votre question" class="form-control" style="height: 99px;"><?=$Q["contenuQuestion"]?></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group form-button">
                        <input class="button button-brand btn-lg mb-5 mb-lg-2 bouton" type="submit" name="signup" id="signup" class="form-submit" value="Modifier la question"/>
                    </div>   
                </form>
            </div>
        <?php } ?>
</body>
</html>