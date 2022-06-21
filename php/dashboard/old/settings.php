<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
  <?php include('../include/nav-dash.php'); ?>
        <div class="container">
        <h1 class="page-title">Settings</h1>
  <div id="settingpage">

    <form method="post">
        <input type="submit" class="button" name="button1"
                value="General Settings"/>
          
        <input type="button" class="disabled-button" name="--"
                value="Account Settings"/>

        <input type="submit" class="button" name="button3"
                value="Privacy Settings"/>

        <input type="submit" class="button" name="button4"
                value="Information"/>
    </form>


    <?php
        if(isset($_POST['button1'])) {
            echo "generaltab";
        }
        if(isset($_POST['button3'])) {
            echo "privacytab";
        }
        if(isset($_POST['button4'])) {
            echo "infotab";
        }
        //heel leuk joshua nu nog een div op deze ^ echo plekken en dan kun je settings opties maken
    ?>
            </div>
        </div>
  </div>
</body>
</html>