<?php
    require("../include/db-connect.php");
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . password_hash($password, PASSWORD_DEFAULT) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Je bent succesvol geregistreerd</h3><br/>
                  <p class='link'>Klik hier om inteloggen<a href='../../inlog.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Er zijn nodige velden leeg!</h3><br/>
                  <p class='link'>Klik hier om opnieuw te proberen<a href='createaccount.php'>registration</a>Opnieuw</p>
                  </div>";
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
    <?php include("../include/nav.php"); ?> 
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
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>
    </body>
</html>