<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Users SSE</title>
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/userpage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
    <div class="container">
      <h1 class="page-title">All Users</h1>
        <div class="scrollbox">
            <div class="collection">
            <?php
              $q = mysqli_query($conn,"SELECT * FROM users");
              while($row = mysqli_fetch_assoc($q)){                           
                if ($row['pf_img'] == ""){
                echo "<img width='100' height='100' src='../../img/pfs/default_pf.png' alt='Default Profile Pic'>";
                echo $row['username'];
                }
			      }
      ?>
      </div>
    </div>
    </div>     
  </div>
</body>
</html>