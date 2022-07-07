<?php
    require("../include/db-connect.php");
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $fotoLocatie = "default_pf.png";

        $sql = "INSERT INTO `users` (username, email, password, create_date, fotoLocatie) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            echo header("Location: ./createaccount.php?error=wrong_value");
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $username, $email, password_hash($password, PASSWORD_DEFAULT), $create_datetime, $fotoLocatie);
            mysqli_stmt_execute($stmt);
            echo header("Location: ../../inlog.php?error=user_create");
        }
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inlog/inlog.css">    
    <title>Create Account</title>
    </head>
    <body>
    <div id="nav"> 
        <img src="../../img/front_end/TopperDeskBlack.png" alt="picture" style="width: 12.5%; height: 12.5%;">
    </div>
    <div id="page">
        <div id="container">
            <form class="form" action="" method="post">
                <h1 class="login-title">Registration</h1>
                <input type="text" class="login-input" name="username" placeholder="Username" required />
                <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
                <input type="password" class="login-input" name="password" placeholder="Password" required>
                <input type="submit" name="submit" value="Register" class="login-button"> 
            </form>
            <?php
                }
            ?>
            <div class= "inlog-option">
                <div class="noacc" class= "inlog-option"><h3><a href="../../inlog.php" style="text-decoration: none;">Inloggen</a></h3> </div>
                <?php 
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "wrong_value") {
                            echo "<div class='error'><h3>Er zijn verkeerde waarden ingevuld</h3> </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>
    </body>
</html>