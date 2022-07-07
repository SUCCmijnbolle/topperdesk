<?php 

if (isset($_GET['bool'])) {
    if ($_GET['bool'] == "true") {
        session_destroy();
        header("Location: ../../inlog.php");
    }
}