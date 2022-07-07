<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");

$id = $_REQUEST["id"];
$sql = "SELECT klachten.ID, klachten.klachtName, klachten.klachtBeschrijving, klachten.klachtstatus, klachten.fotoLocatie, klachten.prioriteit, soortencat.soortCategorieNaam FROM `klachten` 
LEFT JOIN `soortencat` ON klachten.soort = soortencat.ID WHERE klachten.ID = '$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) $klacht = $query->fetch_assoc();

$sqlTwo = "SELECT users.username FROM `klachten`
RIGHT JOIN `users` ON klachten.klantID = users.ID WHERE klachten.ID = '$id'";
$query = mysqli_query($conn, $sqlTwo);
if (mysqli_num_rows($query) > 0) $klachtnameklant = $query->fetch_assoc();

$sqlThree = "SELECT users.username FROM `klachten`
RIGHT JOIN `users` ON klachten.medewerkerID = users.ID WHERE klachten.ID = '$id'";
$query = mysqli_query($conn, $sqlThree);
if (mysqli_num_rows($query) > 0) $klachtnamemedewerker = $query->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topper Desk Meldingen (ID)</title>
    <link rel="stylesheet" href="../../css/inlog/inlog.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/viewMelding.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
    <div class="container">
      <h1 class="page-title">Melding : <?php echo $klacht["ID"]; ?></h1>
      <div id="page-content"> 
        <div id="container"> 
          <form class="form" class="formFix" method="post" name="login" enctype="multipart/form-data">
            <h1 class="login-title">Klacht Informatie</h1>             
            <textarea type="text" class="login-input" name="klachtNaam" autofocus="true" readonly required><?php echo $klacht['klachtName']; ?></textarea>
            <textarea type="bericht" class="bericht-input" name="klachtBericht" placeholder="Bericht" cols="40" rows="5"  readonly required><?php echo $klacht['klachtBeschrijving']; ?></textarea>
            <img class="klachtImg" src="../../img/meldingen/<?php echo $klacht['fotoLocatie'];?>" alt="img">
            <div class="dropdown-klacht">
               <div>
                <label for="info1">Klant : </label>
                  <p class="info" id="info1"><?php echo $klachtnameklant['username']; ?></p>             
                </div>
                <div>          
                <label for="info2">Medewerker : </label>
                  <p class="info" id="info2"><?php echo $klachtnamemedewerker['username']; ?></p>
                </div>  
                <div>          
                <label for="info3">Soort Klacht : </label>
                  <p class="info" id="info3"><?php echo $klacht['soortCategorieNaam']; ?></p>
                </div>    
                <div>          
                <label for="info4">Prioriteit : </label>
                  <p class="info" id="info4"><?php echo $klacht['prioriteit']; ?></p>
                </div>  
                <div>        
                <label for="status">Status : </label>
                 <p class="info" id="info4"><?php 
                 if ($klacht["klachtstatus"] == 0)
                 { echo "Niet Opgelost"; }
                 else { echo "Voltooid"; } ?></p>                 
               </div>
            </div>
            <input type="submit" value="Edit Klacht" name="submit" class="klacht-button"/>
            
          </form>
          <h1 class="editklacht">Edit Klacht</h1>
        </div>
        <div id="container2"> 
        <!-- ECHO ALLE MELDING INFORMATIE -->
      </div>
    </div>
  </div>
  <script>  
  
  </script>
</body>
</html> 