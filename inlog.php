<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inlog/inlog.css" >
    <link rel="stylesheet" href="css/inlog/test.css" >
    <title>SSE Collector inlog</title>
</head>
    <body>
    <?php include("php/include/nav.php"); ?>
    <div id="page">
        <div id="container">
        <?php
        require('php/include/db-connect.php');
        require('php/include/auth_session.php');

        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($conn, $username);
            //check if user exists in db
            $checkUserExistsSQL = "SELECT `password` FROM `users` WHERE username='$username'";
            $checkUserExists = mysqli_query($conn, $checkUserExistsSQL);
            if ($checkUserExists != null){$checkUserExists = $checkUserExists->fetch_assoc(); $hashedPWD = $checkUserExists['password'];}
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);
            if (password_verify($password, $hashedPWD)){
                $query    = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$hashedPWD'";
                $result   = mysqli_query($conn, $query) or die(mysql_error());
                $rows     = mysqli_num_rows($result);
                if ($rows == 1) {
                    $_SESSION['username'] = $username;
                    header("Location: php/dashboard/dashboard.php");
                } else {
                    echo "<div class='form'>
                            <h3>Geen gebruiker gevonden</h3><br/>
                            <p class='link'>Klik hier om opnieuw te proberen <a href='inlog.php'>Login</a>.</p>
                        </div>";
                }
            } else {
                echo "<div class='form'>
                            <h3>Verkeerde naam of wachtoord</h3><br/>
                            <p class='link'>Klik hier om opnieuw te proberen <a href='inlog.php'>Login</a>.</p>
                        </div>";
            }
        } else {
        ?>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Login</h1>
            <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
            <input type="password" class="login-input" name="password" placeholder="Password"/>
            <input type="submit" value="Login" name="submit" class="login-button"/>
        </form>
        <?php
            }
        ?>
            <div class= "inlog-option">
                <div class="forgotps"><h3><a href="php/inlog/omweg.php" style="text-decoration: none;">Login Omweg...</a></h3> </div>
                <div class="forgotps"><h3><a href="php/inlog/newpassword.php" style="text-decoration: none;">Wachtwoord vergeten</a></h3> </div>
                <div class="noacc"><h3><a href="php/inlog/createaccount.php" style="text-decoration: none;">Maak een account</a></h3> </div>
            </div>
        </div>
    </div>
    <?php include("php/include/footer.php"); ?>
    </body>
</html>
