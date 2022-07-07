<?php
    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    if(isset($_SESSION['isMedewerker'])){
        $isMedewerker = $_SESSION['isMedewerker'];
    }
    if(isset($_SESSION['isAdmin'])){
        $isAdmin = $_SESSION['isAdmin'];
    }
?>