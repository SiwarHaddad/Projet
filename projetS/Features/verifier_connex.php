<?php
    session_start();
    function verif(){
        return(isset($_SESSION["pwd"],$_SESSION["idMembre"],$_SESSION["pseudo"]));
    }     
?>