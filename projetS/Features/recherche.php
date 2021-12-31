<?php
    //connexion avec la base des données
    include "../Features/connexionBD.php";

    $recherche=$_POST['search'];
    $rq = "SELECT DISTINCT question.idQuestion
            FROM question
            WHERE /* MATCH (objetQuestion, contenuQuestion) against ('$recherche')*/
                    objetQuestion LIKE '%$recherche%' 
                OR contenuQuestion LIKE '%$recherche%'";

    $rqQuery = $connex->query($rq);
    $result = $rqQuery->fetchAll(PDO::FETCH_ASSOC);
    
    $resultSerialized=serialize($result);
    header("location:../index.php?idSQ=$resultSerialized&search=$recherche");
?>                 