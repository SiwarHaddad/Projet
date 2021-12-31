<?php
    //header_general
    include "Components/header_general.php";

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

    //header
    include "Features/verifier_connex.php";
    if (verif()==1)
        include "Components/header1.php";
    else
        include "Components/header0.php";

    
    // connexion avec la base des données
    include "Features/connexionBD.php";

    //nbre de question et 'tr' ( pour rowspan)
    if(isset($_GET["categorie"])){
        $rq=$connex->prepare("SELECT COUNT(*) 
                                FROM `question`,categoriequestion 
                                WHERE idCategorie=categorieQuestion
                                AND idCategorie=:idCat");
        $rq->bindValue(":idCat",$_GET["categorie"]); 
        $rq->execute();
        $tab=$rq->fetchAll();
        if (empty($tab))
            $nbQ=0;
        else
            $nbQ=$tab[0][0];
        $nbTr=($nbQ-1)*2+1;
    }
    else {
        $rq=$connex->query("SELECT COUNT(*) FROM `question`");
        $tab=$rq->fetchAll();
        if (empty($tab))
            $nbQ=0;
        else
            $nbQ=$tab[0][0];
        $nbTr=($nbQ-1)*2+1;
    }
    
    //importation de toutes les categories
    $rq=$connex->prepare("SELECT *
                        FROM categoriequestion");
    $rq->execute();
    $tab_categorie=$rq->fetchAll(PDO::FETCH_ASSOC);
    
    //inportation de toutes les questions
        $addToRq=""; 
        
        //affichage des questions selon categorie _ajout action dans la requete_
        if(isset($_GET["categorie"])){
            $addToRq.="AND idCategorie=:idCat ";
        }

        //affichage des questions selon la recherche _ajout action dans la requete_
        if (isset($_GET["idSQ"])){ // $_GET["idSQ"] contient les ids des questions correspondantes à la recherche
            $searchResultTab=unserialize($_GET["idSQ"]);
            
            for($i=0;$i<count($searchResultTab);$i++)
                $tabTE[]=$searchResultTab[$i]["idQuestion"];
            
            if(!empty($tabTE)){        
                $searchResult=implode(', ',$tabTE);

                $addToRq="AND idQuestion IN ($searchResult) ";
            }
        }
        
        //tri des qestions par date
        $sort="DESC";
        if(isset($_GET["sortby"]))
            $sort=$_GET["sortby"];
        $addToRq.="ORDER BY dateQuestion $sort";


        //requete
        $rq=$connex->prepare("SELECT idQuestion, pseudoMembre ,dateQuestion, idCategorie,nomCategorie ,idPoserQuestion, objetQuestion ,contenuQuestion, nomImage
                        FROM question ,membre , categoriequestion, `image`
                        WHERE question.idPoserQuestion=membre.idMembre
                        AND question.categorieQuestion=categoriequestion.idCategorie
                        AND pdpMembre=idImage $addToRq");

        if(isset($_GET["categorie"]))
            $rq->bindValue(":idCat",$_GET["categorie"]); 

        $rq->execute();
        $tab_Question=$rq->fetchAll();
    
    //intialisation
    $i=0; 
?>

<div class="container_">
    <!-- chemin -->
    &emsp;&emsp;&emsp;<a href="index.php">Home</a>
    <?php
        if (isset ($_GET["categorie"])){ 
            //affichage selon categories
            $rq=$connex->prepare("SELECT *
                                FROM categoriequestion
                                WHERE idCategorie=:idC");
            $rq->bindValue(":idC",$_GET["categorie"]); 
            $rq->execute();
            $tabcateg=$rq->fetchAll(PDO::FETCH_ASSOC);
        ?>   
            >> <?=$tabcateg[0]["nomCategorie"];?>
        <?php } ?>
</div>

<table id="question">
    <tr>
        <td <?php if($nbQ!=0){?> rowspan="<?=$nbTr?>" <?php } ?> class="container_c" style="width:20%;">
        <!-- liste des categories -->
        <h3> <b>Catégories</b> </h3>
            <ul>
                <?php foreach($tab_categorie as $c){ ?>
                    <a  class="cat <?php if((isset($_GET["categorie"]))&&( $c["idCategorie"]== $_GET["categorie"])) echo " catSetectionee"; ?> " 
                        href="index.php?categorie=<?=$c["idCategorie"];?>"><?=$c["nomCategorie"];?></a><br><br/>
                <?php } ?>
            </ul> 
            <br/>
            <?php 
                //seul l'admin qui peut ajoter une categorie 
                if ((isset($_SESSION["rang"]))&&(strcmp($_SESSION["rang"],"A")==0)){ ?>
                   <a class="btn btn-success my-2 mx-2 my-sm-0 bouton2" href="Category/ajoutercategorie.php"> Ajouter catégorie  </a>
            <?php } ?>
            
        </td>
        <td <?php if($nbQ!=0){?> rowspan="<?=$nbTr?>" <?php } ?> style="width:1%;"></td>

        <?php
            if(($nbQ==0) || ((isset($_GET["idSQ"])) && (empty($tabTE)))){
                if($nbQ==0){?>  <!-- pas de question -->
                    <td class="container_" style="width:69%;vertical-align:top;"><h3 style="text-align:center;padding-top:40px;"> <b> Pas de questions dans cette catégorie</b> </h3></td>
                <?php }
                else{?> <!-- recherche sans resultat --> 
                    <td class="container_" style="width:69%;vertical-align:top;"><h3 style="text-align:center;padding-top:40px;"> <b> Pas de resutats pour "<?=$_GET["search"]?>"</b> </h3></td>
                <?php }
            }
            else{
                $i++;
                if($i!=1)
                    echo "<tr>";
                
                //resultat de recherche
                if (isset($_GET["idSQ"])){?>
                    <h3 style="text-align:center;padding-top:40px;"> <b> Resultat(s) de la recherche "<?=$_GET["search"]?>" :  </b> </h3>
                <?php } ?>

                <?php
                foreach($tab_Question as $Q){ ?>
                    <!-- affichage question avec Reponse -->
                    <td class="container_" style="width:69%;">
                        <div class="container_QH">
                            <img style="width:40px; height:40px; border-radius:50%;" src="images/<?=$Q["nomImage"]?>" alt="pdp">
                            <b><?=$Q["pseudoMembre"]?></b> &emsp; <?=$Q["dateQuestion"]?>
                            <div class="dropdown_ alignRight">
                                <a class="espaceR"> &emsp; </a>  
                                <button class="dropbtnM">
                                    <img style="width:20px; height:20px; border-radius:50%;" src="images/threeDots.png">    
                                </button>
                                <div class="dropdown-content">
                                    <!-- modifier une question -->
                                    <a href="Question/modifierQuestion.php?idQ=<?=$Q["idQuestion"]?>"
                                        <?php if (!isset($_SESSION["idMembre"])||(!(strcmp($_SESSION["idMembre"],$Q["idPoserQuestion"])==0))){?> 
                                            class="disabled" <?php } ?>>
                                        Modifier 
                                    </a>
                                    <!-- supprimer une question -->
                                    <a href="Question/supprimerQuestion.php?idQ=<?=$Q["idQuestion"]?>"
                                        <?php if (!isset($_SESSION["idMembre"])||(!(strcmp($_SESSION["idMembre"],$Q["idPoserQuestion"])==0))){?>
                                            class="disabled" <?php } ?>> 
                                        Supprimer
                                    </a>
                                </div>
                            </div> 
                        </div>

                        <div class="container_I"> 
                            <b>Categorie:&nbsp;</b> <?=$Q["nomCategorie"]?> 
                        </div>

                        <div class="container_I"> 
                            <b>Objet:&nbsp;</b> <?=$Q["objetQuestion"]?><hr/>
                            <b>Question:</b><br/><?=$Q["contenuQuestion"]?> 
                        </div>

                        <?php
                            //nbReponse
                            $rq=$connex->prepare("SELECT COUNT(*) FROM `reponse` WHERE reponse.idQuestion=:idQ ");
                            $rq->bindValue(":idQ",$Q["idQuestion"]);
                            $rq->execute();
                            $tab=$rq->fetchAll();
                        
                            $nbR=$tab[0][0]; 
                        ?>
                        <div class="navbar_Q">
                            <hr/>
                            <a class="deconnex"> nombre de réponses: <?=$nbR;?> </a>
                            <a class="espace"> &emsp; </a>
                            <a class="button button-brand btn-lg mb-5 mb-lg-2 bouton" 
                                href="<?php if(verif()==0) echo "index.php?message=Connectez-vous pour avoir accés à cette fonctionnalité."; 
                                            else echo "Answer/donnerReponse.php?idQ=".$Q["idQuestion"]; ?>">
                                Répondre à cette question 
                            </a>
                        </div><br/>
                    
                        <!-- reponse -->
                        <div class="container_R">
                            <?php
                                //reponse
                                $rq=$connex->prepare("SELECT idReponse, pseudoMembre, dateReponse ,contenuReponse, nomImage,idDonnerReponse
                                                        FROM  membre , reponse, `image`
                                                        WHERE reponse.idQuestion=:idQ
                                                        AND reponse.idDonnerReponse=membre.idMembre
                                                        AND pdpMembre=idImage
                                                        ORDER BY dateReponse DESC");
                                $rq->bindValue(":idQ",$Q["idQuestion"]);
                                $rq->execute();
                                $tab_Reponse=$rq->fetchAll();
                                
                                foreach($tab_Reponse as $R){ ?>
                                <div class="container_QH">
                                    <img style="width:40px; height:40px; border-radius:50%;" src="images/<?=$R["nomImage"]?>" alt="pdp">
                                    <b><?=$R["pseudoMembre"]?></b> &emsp; <?=$R["dateReponse"]?>
                                    <div class="dropdown_ alignRight">
                                        <a class="espaceR"> &emsp; </a>  
                                        <button class="dropbtnM">
                                            <img style="width:20px; height:20px; border-radius:50%;" src="images/threeDots.png">    
                                        </button>
                                        <div class="dropdown-content">
                                            <!-- modifier Reponse -->
                                            <a href="Answer/modifierReponse.php?idR=<?=$R["idReponse"]?>" 
                                                <?php if (!isset($_SESSION["idMembre"])||(!(strcmp($_SESSION["idMembre"],$R["idDonnerReponse"])==0))){?> 
                                                    class="disabled" <?php } ?>>
                                                Modifier 
                                            </a>
                                            <!-- supprimer reponse -->
                                            <a href="Answer/supprimerReponse.php?idR=<?=$R["idReponse"]?>" 
                                                <?php if (!isset($_SESSION["idMembre"])||(!(strcmp($_SESSION["idMembre"],$R["idDonnerReponse"])==0))){?> 
                                                    class="disabled" <?php } ?>> 
                                                Supprimer
                                            </a>
                                        </div>
                                    </div> 
                                </div>
                                <div class="container_I"> 
                                    <b>Reponse:</b><br/><?=$R["contenuReponse"]?> 
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&emsp;</td>
                </tr>
                <?php } ?>
            <?php } ?>
    </table>
    
<?php
    include "Components/footer.php";
?>