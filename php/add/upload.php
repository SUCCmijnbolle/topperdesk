<?php
	require_once '../include/db-connect.php';	
	require_once '../include/auth_session.php';

	if(ISSET($_POST['upload'])){
		if(isset($_POST['description'])){
			$description = $_POST['description'];
		}
		$result = mysqli_query($conn, "SELECT `id` FROM `users` WHERE username='$username'");
		while($row = mysqli_fetch_assoc($result)){
			$user_coll = $row['id'];
		}
		// TODO: if statement user_id
		$image_name = $_FILES['image']['name'];
		$image_temp = $_FILES['image']['tmp_name'];
		$allowed_ext = array("jpeg", "JPEG", "jpg", "JPG", "gif", "png", "PNG");
		$exp = explode(".", $image_name);
		$ext = end($exp);
		$name = date("Y-m-d h-i-s").".".$ext;
		$path = "../add/uploads/".$name;
		$sub_path = "../add/uploads/".$name;
		if(in_array($ext, $allowed_ext)){
			if(move_uploaded_file($image_temp, $path)){
				mysqli_query($conn, "INSERT INTO `collection` VALUES('', '$name', '$path', '$description', '$user_coll')") 
				or die(mysqli_error());
				header("location: dashadd.php");
			}
		}else{
			echo "<script>alert('Verkeerde invoer')</script>";
		}
	};
?>