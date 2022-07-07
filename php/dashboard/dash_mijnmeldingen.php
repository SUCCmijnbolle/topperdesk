<?php 
  require("../include/db-connect.php");
  require("../include/auth_session.php");

  $sql = "SELECT klachten.ID, klachten.klachtName, klachten.klachtstatus, soortencat.soortCategorieNaam, users.username FROM `klachten` 
  LEFT JOIN `soortencat` ON klachten.soort = soortencat.ID
  LEFT JOIN `users` ON klachten.klantID = users.ID";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "je moeder met je error";
  } else {
    mysqli_stmt_execute($stmt);
    $klachten = mysqli_stmt_get_result($stmt);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topper Desk Mijn Meldingen</title>
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/inlog/inlog.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
    <div class="containerMelding">
      <div class="container-nav">
        <h1 class="page-title">Mijn Meldingen :</h1>
      </div>
      <div id="page-content">
        <table id="table-nonedit" style="display: block;">
          <td class="table-title">ID</td>
          <td class="table-title">naam</td>
          <td class="table-title">status</td>
          <td class="table-title">soort</td>
          <td class="table-title">klant</td>
          <tbody>
            <?php foreach ($klachten as $klacht) {
              if ($klacht["username"] == $_SESSION["username"]){?>
                <tr>
                  <td class="table-entry"><?php echo "<a href='./dash_viewmelding.php?id=" . $klacht["ID"] . "'>" . $klacht["ID"] . "</a>";?></td>
                  <td class="table-entry"><?php echo $klacht["klachtName"];?></td>
                  <td class="table-entry"><?php if ($klacht["klachtstatus"] == 1) echo "afgerond"; else echo "niet afgerond";?></td>
                  <td class="table-entry"><?php echo $klacht["soortCategorieNaam"];?></td>
                  <td class="table-entry"><?php echo $klacht["username"];?></td>
                </tr>
            <?php }}?>
          </tbody>
        </table>
      </div>
  </div>
  <script>
    let setting_toggle = false;
    document.getElementById("setting-aanpassen").onclick = () => {
        setting_toggle = !setting_toggle;
        document.getElementById("table-nonedit").style.display = "none";
        document.getElementById("table-edit").style.display = "block";
        document.getElementById("setting-aanpassen").style.display = "none";
        document.getElementById("setting-cancel").style.display = "block";
      };
      document.getElementById("setting-cancel").onclick = () => {
        setting_toggle = !setting_toggle;
        document.getElementById("table-nonedit").style.display = "block";
        document.getElementById("table-edit").style.display = "none";
        document.getElementById("setting-aanpassen").style.display = "block";
        document.getElementById("setting-cancel").style.display = "none";
      };
  </script>
</body>
</html> 