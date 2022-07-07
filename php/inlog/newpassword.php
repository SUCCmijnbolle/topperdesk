<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inlog/inlog.css">    
    <title>Make a password</title>
</head>
<body>
<div id="nav"> 
        <img src="../../img/front_end/TopperDeskBlack.png" alt="picture" style="width: 12.5%; height: 12.5%;">
    </div>
    <div id="page">
        <div id="container">
            <form class="form" action="" method="post">
                <h1 class="login-title">Wachtwoord Vergeten</h1>
                <input type="text" class="login-input" name="username" placeholder="Username" required />
                <input type="password" class="login-input" name="newpassword" placeholder="New Password" required>
                <input type="password" class="login-input" name="repassword" placeholder="Re-Password" required>
                <input type="submit" name="submit" value="Submit" class="login-button"> 
            </form>
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