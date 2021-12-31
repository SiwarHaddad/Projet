<?php 
    //connexion avec la base de donnée
    include "Features/connexionBD.php";
    
    //importation de toutes les categories 
    $rq=$connex->prepare("SELECT *
                          FROM categoriequestion");

    $rq->execute();
    $tabategory=$rq->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <div class="container_"> 
        <div class="navbar_">
            <a href="index.php">Home</a>
            <a href="#question">Questions</a>
            <div class="dropdown_">
                <button class="dropbtn">Top categories
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <?php foreach($tabategory as $t){?> 
                        <a href="index.php?categorie=<?=$t["idCategorie"];?>"> <?=$t["nomCategorie"];?> </a>
                    <?php } ?>   
                </div>
            </div>
            <a href="Features/apropos.php"> A propos </a>
            <a class="espace"> &emsp;&emsp; </a>  
            <a href="Member/forms/form_connex.php" class="connex"> Se connecter </a>
            <a href="Member/forms/form_inscri.php" class="inscri"> S'inscrire </a>
        </div>
    </div>

    <div class="container_">
        <div class="logo">
        <img  style="width:20%; height:20%;" src="images/logo.png" alt="pdp">
        </div>
        <h1 class="display-2 text-bold" style="display: flex;justify-content: center;">Le monde du savoir</h1>
        <h6 class="text-gray-soft text-regular" style="display: flex;justify-content: center;">A toute question, sa réponse</h6>
        <br/>
    </div>  

    <div class="container_"> 
        <a class="button button-brand btn-lg mb-5 mb-lg-2 bouton" href="index.php?message=Connectez-vous pour avoir accés à cette fonctionnalité." style="display: flex;justify-content: center;">Poser une question</a>
    </div>

    <div class="container_">
        <br/>
        <div class="navbar_">
            <div class="dropdown_ aliRight">
                <a class="espaceR"> &emsp; </a>  
                <button class="dropbtn">Trier par
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="index.php?sortby=DESC"> Question plus récente </a>
                    <a href="index.php?sortby=ASC"> Question plus ancienne </a>
                </div>
            </div>   
            <a class="espace"> &emsp; </a>  
            <div>
                <form method="POST" action="Features/recherche.php" class="form-inline form-navbar my-2 my-lg-0 order-2" >
                    <input class="form-control" name="search" type="search" placeholder="rechercher">
                <button class="btn btn-success my-2 mx-2 my-sm-0 bouton2"  type="submit">Rechercher dans les questions</button> </form>
            </div>
        </div>
        <br/>
    </div>      