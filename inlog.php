<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inlog/inlog.css" >
    <link rel="stylesheet" href="css/inlog/test.css" >
    <title>TopperDesk Inlog</title>
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
                    $checkUserExistsSQL = "SELECT `password` FROM `users` WHERE username='$username'";
                    $checkUserExists = mysqli_query($conn, $checkUserExistsSQL);
                    $rows = mysqli_num_rows($checkUserExists);
                    if ($rows == 1){
                        $checkUserExists = $checkUserExists->fetch_assoc(); 
                        $hashedPWD = $checkUserExists['password'];
                    } else header("Location: ./inlog.php?error=no_uid");
                    
                    $password = stripslashes($_REQUEST['password']);
                    $password = mysqli_real_escape_string($conn, $password);
                    if (password_verify($password, $hashedPWD)){
                        $query    = "SELECT * FROM `users` WHERE `username`='$username'";
                        $result   = mysqli_query($conn, $query) or die(mysql_error());
                        $rows     = mysqli_num_rows($result);
                        if ($rows == 1) {
                            $result = $result->fetch_assoc();
                            $_SESSION['username'] = $result['username'];
                            $_SESSION['isMedewerker'] = $result['isMedewerker'];
                            $_SESSION['isAdmin'] = $result['isAdmin'];
                            if ($_SESSION["isMedewerker"] == 1){
                                header("Location: php/dashboard/dashboard.php");
                            } else {
                                header("Location: php/dashboard/dash_mijnmeldingen.php");
                            }
                        } else header("Location: ./inlog.php?error=no_uid");
                    } else  {
                        header("Location: ./inlog.php?error=wrong_username");
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
                <div class="forgotps"><h3><a href="php/inlog/newpassword.php" style="text-decoration: none;">Wachtwoord vergeten</a></h3> </div>
                <div class="noacc"><h3><a href="php/inlog/createaccount.php" style="text-decoration: none;">Maak een account</a></h3> </div>
                <?php 
                if (isset($_GET["error"]))
                    if ($_GET["error"] == "no_uid") {
                        echo "<div class='error'><h3>Geen gebruiker gevonden, Probeer het opnieuw</h3> </div>";
                    }else if ($_GET["error"] == "wrong_username") {
                        echo "<div class='error'><h3>Verkeerde gebruikersnaam of wachtwoord, Probeer het opnieuw</h3> </div>";
                    }else if ($_GET["error"] == "user_create") {
                        echo "<div class='error'><h3>Succesvol een nieuwe gebruiker aangemaakt!</h3> </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include("php/include/footer.php"); ?>
</body>
</html>
