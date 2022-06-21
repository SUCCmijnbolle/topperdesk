<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Collections SSE</title>
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/dashcoll.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../js/dashcoll.js"></script>   
</head>
<body>
  <div id="grid">
    <?php include('../include/nav-dash.php'); ?>
      <div class="container">
        <h1 class="page-title">My Collections</h1>
        <button class="coll-option" name="submit">Delete</button>
        <button class="coll-option" name="submit">Update</button>
         <div id="page-content">
          <div class="scrollbox">
            <div class="coll-items">
              <a href="../collections/collectionTEMP.php">Inside collection test</a>
              <?php
              $result = mysqli_query($conn, "SELECT `id` FROM `users` WHERE username='$username'");
              while($row = mysqli_fetch_assoc($result)){
                $user_coll = $row['id'];
              }
                $query = mysqli_query($conn, "SELECT * FROM `collection` WHERE `user_coll` ='$user_coll'") or die(mysqli_error($conn));
                while($fetch = mysqli_fetch_array($query)){       
              ?>
              <div class="collection">
                <img class="coll-img" src="<?php echo $fetch['location']?>" id="<?php echo $fetch['img_id']?>" height="400" width="400"/>
                <h1 class="coll-text" id="<?php echo $fetch['description']?>"><?php echo $fetch['description']?><h1>
              </div>
              <?php
                }
              ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>