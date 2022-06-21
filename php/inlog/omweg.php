<?php
require('../include/auth_session.php');

$_SESSION['username'] = "Johan";
header("Location: ../dashboard/dashboard.php");