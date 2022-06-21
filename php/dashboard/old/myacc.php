<?php 
require("../include/db-connect.php");
require("../include/auth_session.php");
	if(isset($_POST['submit'])){
		move_uploaded_file($_FILES['file']['tmp_name'],"pictures/".$_FILES['file']['name']);
		$q = mysqli_query($con,"UPDATE username SET image = '".$_FILES['file']['name']."' WHERE username = '".$_SESSION['username']."'");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard My account RPSD</title>

    <link rel="stylesheet" href="../../css/dashboard/navigatie/dash-menu.css">
    <link rel="stylesheet" href="../../css/dashboard/myacc.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">       
</head>
<body>
  <div id="grid">
  <?php include('../include/nav-dash.php'); ?>
    <div class="container">
      <h1 class="page-title">My Account</h1>
        <div id="page-content">
                <?php
                  echo $username;
		              $q = mysqli_query($conn,"SELECT * FROM `users` where `username` = '$username'");
		              while($row = mysqli_fetch_assoc($q)){
                    echo $row['username'];
                    if($row['pf_img'] == ""){
                    echo "<img width='100' height='100' src='../../img/pfs/default_pf.png' alt='Default Profile Pic'>";
                    }
			            }
                  
                ?>
              <div class="accinfo">
                <h2>Wie ben ik</h2>
                <p>
                Wat is je geslacht?
                  <select name="formgeslacht">
                     <option value="">select...</option>
                     <option value="M">Man</option>
                     <option value="F">Vrouw</option>
                     <option value="G">Gamer</option>
                     <option value="O">Anders</option>
                  </select>
                </p>
                <p>
                Wat is je leeftijd?
                  <select name="leeftijd">
                     <option value="">select...</option>
                     <option value="15-20">15-20</option>
                     <option value="21-30">21-30</option>
                     <option value="31-40">31-40</option>
                     <option value="41-50">41-50</option>
                     <option value="51+">51+</option>
                  </select>
              </p>
              <p>
                vertel wat over jezelf
                <form action="">
                <textarea name="myTextBox" cols="75" rows="10">
                </textarea>
              </p>
              <p>
                Profiel plaatje veranderen
              </p>
                <form action="" method="post" enctype="multipart/form-data">
			          <input type="file" name="file">
			          <input type="submit" name="submit">
		        </form>
      </div>
    </div>
  </div>
</body>
</html>