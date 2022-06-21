
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inlog/inlog.css">    
    <title>Make a password</title>
</head>
<body>
<?php include("../include/nav.php"); ?> 
    <div id="page">
        <div id="container">
            <div class="flex-container">
                <div class="flex-item-left" id="">
                    <div class="container">
                        <div>

                        </div>
                    </div>
                </div>
                <div class="flex-item" id="">
                    <div class="container">
                        <div class="con">
                        <!-- Hier moet alle content -->
                        <div class ="col-25">
                            <div class ="arial" class ="inlogtext">
                                <label for="user"> Username </label>
                                <input class="inlog" type="text" placeholder="Username" id="user" name="user">
                            </div>
                        </div>
                        <div class ="col-25">
                            <div class ="arial" class ="inlogtext">
                                <label for="pass"> Password </label>
                                <input class="inlog" id="pass" placeholder="Enter your new password" type="password" name="newpass">
                            </div>
                        </div>
                        <div class ="col-25">
                            <div class ="arial" class ="inlogtext">
                                <label for="user"> Re-enter Password </label>
                                <input class="inlog" type="text" placeholder="Re-enter your new password" id="user" name="renewpass">
                            </div>
                        </div>
                                          
                        <input type="button" class="login-button"><a href="../../inlog.php">Login</a></input>
                        </div>
                    </div>
                </div>
                            <div class="flex-item-right" id="">
                            <div class="container">
                            <div></div>
                </div>
            </div>
        </div>
            <h1>
    </div>
    <?php include("../include/footer.php"); ?>
</body>
</html>