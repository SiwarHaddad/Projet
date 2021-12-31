<?php
    include "verifier_connex.php";
    if(verif()==0){
        header("location:../index.php");
    }
    else{
        session_start();
        session_destroy();
        header("location:../index.php");
    }
    
?>