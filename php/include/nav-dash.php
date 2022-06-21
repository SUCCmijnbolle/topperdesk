<?php
  $current_time = time();
  if ($current_time < strtotime('12:00:00')) {$welcome = "Goedemorgen, ";}
  else if ($current_time > strtotime('12:00:00')) {$welcome = "Goedemiddag, ";}
  else if ($current_time > strtotime('18:00:00')) {$welcome = "Goedeavond, ";}
?>

<div class="nav">
  <img class="nav_img" src="../../img/front_end/TopperDeskBlack.png" width="150" height="85" alt="picture" href="../../inlog.php" style="padding: 10px;">
  <a class="myacc" href="myacc.php"><?php echo $welcome . $_SESSION['username']; ?></a>
</div>

<div class="menu">
  <div class="menu-top">
      <div class="menuitem"><a href ="dashboard.php"><i class="fa fa-home"></i><span>Dashboard</span></a></div>
      <div class="menuitem"><a href ="dash_meldingen.php"><i class="fa fa-comment"></i><span>Meldingen</span></a></div>
      <div class="menuitem"><a href ="dash_klachten.php"><i class="fa fa-exclamation-circle"></i><span>Klachten</span></a></div>
      <div class="menuitem"><a href ="dash_toevoegen.php"><i class="fa fa-plus"></i><span>Toevoegen</span></a></button></div>
  </div>

  <div class="menu-bottom">
      <div class="menuitem"><a href ="dash_gebruikers.php"><i class="fa fa-user"></i><span>Gebruikers</span></a></div>
      <div class="menuitem"><a href ="dash_setting.php"><i class="fa fa-cog"></i><span>Settings</span></a></div>
      <h5 id="nav_copyright">Copyright © 2020-2022 TopperDesk ™</h5>
  </div>
</div>