<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");

if (isset($_POST['submit'])) {
  $Biographie = stripslashes($_REQUEST['Biographie']);
  $Biographie = mysqli_real_escape_string($conn, $Biographie);
  if (!$_FILES['profilePic']['size'] == 0) {
    $image_name = $_FILES['profilePic']['name'];
    $image_temp = $_FILES['profilePic']['tmp_name'];
    $allowed_ext = array("jpeg", "JPEG", "jpg", "JPG", "gif", "png", "PNG");
    $exp = explode(".", $image_name);
    $ext = end($exp);
    $username = $_SESSION["username"];
    $query = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `username`='$username'");
    $query = $query->fetch_assoc();
    $num = $query['ID'];
    $imgName = $num . "." . $ext;
    $path = "../../img/pfs/".$imgName;
    if(in_array($ext, $allowed_ext)){ move_uploaded_file($image_temp, $path);}
  } else {
    $imgName = "default_pf.png";
  }

  $sql = "UPDATE `users` SET `bios` = ?, `fotoLocatie` = ? WHERE `username` = '$username'";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo header("Location: ./dash_myacc.php?error=sqlerror");
  } else {
    mysqli_stmt_bind_param($stmt, "ss", $Biographie, $imgName);
    mysqli_stmt_execute($stmt);
    echo header("Location: ./dash_myacc.php?error=updated");
  }
} else {
$username = $_SESSION["username"];
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) $user = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topper Desk Mijn account</title>
    <link rel="stylesheet" href="../../css/inlog/inlog.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/Myacc.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
    <div class="container">
    <div class="container">
      <h1 class="page-title"></h1>
        <div id="container"> 
          <form class="form" class="formFix" method="post" name="login" enctype="multipart/form-data">
            <h1 class="login-title">Mijn account</h1>
            <img class="klachtImg" src="../../img/pfs/<?php echo $user['fotoLocatie'];?>" alt="profielfoto" style="height: 75px; width: 75px; border-radius: 100%;">
            <div class="error-tab">

            </div>
            <p><?php echo $user['username']; ?></p>
            <textarea type="bericht" class="bericht-input" name="Biographie" placeholder="Biographie" cols="40" rows="5" required> <?php echo $user['bios']; ?></textarea>
            <p>Selecteer Foto (optioneel) : <input type="file" name="profilePic"/></p>
            <input type="submit" value="Opslaan" name="submit" class="klacht-button"/>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html> 
<?php } ?>