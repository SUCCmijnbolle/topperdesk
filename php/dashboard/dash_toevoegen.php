<?php 
  require("../include/db-connect.php");
  require("../include/auth_session.php");

  if (isset($_POST['klachtNaam'])) {
    $klachtNaam = stripslashes($_REQUEST['klachtNaam']);
    $klachtNaam = mysqli_real_escape_string($conn, $klachtNaam);
    $klachtBericht = stripslashes($_REQUEST['klachtBericht']);
    $klachtBericht = mysqli_real_escape_string($conn, $klachtBericht);
    $soort = $_REQUEST['soort'];
    $medewerkerID = $_REQUEST['medewerkerID'];
    if (isset($_REQUEST['klantID'])) {
      $klantID = $_REQUEST['klantID'];
    } else {
      $username = $_SESSION['username'];
      $sql = "SELECT `ID` FROM `users` WHERE `username` = '$username'";
      $query = mysqli_query($conn, $sql);
      if (mysqli_num_rows($query) > 0) $ID = $query->fetch_assoc();
      $klantID = $ID['ID'];
    }

    if (isset($_FILES['meldingImg'])) {
      $image_name = $_FILES['meldingImg']['name'];
      $image_temp = $_FILES['meldingImg']['tmp_name'];
      $allowed_ext = array("jpeg", "JPEG", "jpg", "JPG", "gif", "png", "PNG");
      $exp = explode(".", $image_name);
      $ext = end($exp);
      $query = mysqli_query($conn, "SELECT `ID` FROM `klachten` ORDER BY ID DESC LIMIT 0, 1");
      $query = $query->fetch_assoc();
      $num = $query['ID'] + 1;
      $imgName = $num . "." . $ext;
      $path = "../../img/meldingen/".$imgName;
      if(in_array($ext, $allowed_ext)){ move_uploaded_file($image_temp, $path);}
    } else {
      $imgName = "TopperDesk.png";
    }
    
    $sql = "INSERT INTO `klachten` (klachtName, klachtBeschrijving, klachtstatus, soort, prioriteit, klantID, medewerkerID, fotoLocatie) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo header("Location: ./dash_toevoegen.php?error=sqlerror");
    } else {
      $status = 0;
      $prioriteit = 1;
      mysqli_stmt_bind_param($stmt, "ssiiiiis", $klachtNaam, $klachtBericht, $status, $soort, $prioriteit, $klantID, $medewerkerID, $imgName);
      mysqli_stmt_execute($stmt);
      echo header("Location: ./dash_toevoegen.php?error=created");
    }
  } else {
    $sql = "SELECT `ID`, `username` FROM `users` WHERE `isMedewerker` = 1";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo header("Location: ./dash_toevoegen.php?error=sqlerror");
    } else {
      mysqli_stmt_execute($stmt);
      $rowMedewerkers = mysqli_stmt_get_result($stmt);
    }

    $sqlOne = "SELECT `ID`, `username` FROM `users` WHERE `isMedewerker` = 0";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlOne)){
      echo header("Location: ./dash_toevoegen.php?error=sqlerror");
    } else {
      mysqli_stmt_execute($stmt);
      $rowKlanten = mysqli_stmt_get_result($stmt);
    }

    $sqlTwo = "SELECT `ID`, `soortCategorieNaam` FROM `soortencat`";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlTwo)){
      echo header("Location: ./dash_toevoegen.php?error=sqlerror");
    } else {
      mysqli_stmt_execute($stmt);
      $rowSoorten = mysqli_stmt_get_result($stmt);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topper Desk Toevoegen</title>
    <link rel="stylesheet" href="../../css/inlog/inlog.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
    <div class="container">
      <h1 class="page-title">Melding Toevoegen</h1>
        <div id="container"> 
          <form class="form" class="formFix" method="post" name="login" enctype="multipart/form-data">
            <h1 class="login-title">Klachten Formulier</h1>
            <div class="error-tab">
            <?php 
              if (isset($_GET["error"])){
                if ($_GET['error'] == "created") echo "Melding succesvol gemaakt!!";
                if ($_GET['error'] == "sqlerror") echo "SQL ERROR";
              }
            ?>
          </div>
            <input type="text" class="login-input" name="klachtNaam" placeholder="Klacht Titel" autofocus="true" required/>
            <textarea type="bericht" class="bericht-input" name="klachtBericht" placeholder="Bericht" cols="40" rows="5" required></textarea>
            <div class="dropdown-klacht">
              <?php if ($_SESSION["isMedewerker"] == 1){?> <p>
                <label for="klantID">Kies Klant : </label>
                <select class="selectClassOne" name="klantID" id="klant" required>
                  <option disabled selected value></option>
                  <?php 
                  foreach ($rowKlanten as $row) { ?> 
                    <option value="<?php echo $row["ID"]; ?>"><?php echo $row["username"];?></option>
                  <?php }?>
                </select>
              </p> <?php }?>
              <p>
                <label for="medewerkerID">Kies Medewerker : </label>
                <select class="selectClassTwo" name="medewerkerID" id="medewerker" required>
                <option disabled selected value></option>
                  <?php foreach ($rowMedewerkers as $row) { ?> 
                    <option value="<?php echo $row["ID"]; ?>"><?php echo $row["username"]; ?></option>
                  <?php }?>
                </select>
              </p>
              <p>
                <label for="soort">Soort Klacht : </label>
                <select class="selectClassThree" name="soort" id="soort" required>
                <option disabled selected value></option>
                  <?php foreach ($rowSoorten as $row) { ?> 
                    <option value="<?php echo $row["ID"]; ?>"><?php echo $row["soortCategorieNaam"];?></option>
                  <?php }?>
                </select>
              </p>
            </div>
            <p>Selecteer Foto (optioneel) : <input type="file" accept="image/* name="meldingImg"/></p>
            <input type="submit" value="klacht melden" name="submit" class="klacht-button"/>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html> 
<?php }?>