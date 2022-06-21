<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Add SSE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../css/dashboard/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/collection.css">
</head>
<body>
  <div id="grid">
  <?php include('../include/nav-dash.php'); ?>
      <div class="container">
        <h1 class="page-title">ADD</h1>
        <form method="POST" action="upload.php" enctype="multipart/form-data">
          <div class="form-inline">
            <input type="file" class="form-control" name="image" required/>
            <input type="text" class="form-control" name="description" placeholder="Description" required/>
            <button name="upload"><span>Upload</span></button>
          </div>
        </form>	
    </div>
  </div>	
  <script src="../../js/script.js"></script>
</body>
</html>