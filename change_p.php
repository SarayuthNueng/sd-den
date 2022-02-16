<?php 
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    include "db/db_conn.php"; //ต่อกับ database

	// เชคค่าที่ส่งมา
	if (isset($_POST['op']) && isset($_POST['np'])
    	&& isset($_POST['c_np'])) {

		// validation เชคค่าว่าถูกไหม
		function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

		$op = validate($_POST['op']);
		$np = validate($_POST['np']);
		$c_np = validate($_POST['c_np']);
		
		// เข้าสู่เงื่อนไข
		if(empty($op)){
		header("Location: update-password-profile.php?error=Old Password is required");
		exit();
		}else if(empty($np)){
		header("Location: update-password-profile.php?error=New Password is required");
		exit();
		}else if($np !== $c_np){
		header("Location: update-password-profile.php?error=The confirmation password  does not match");
		exit();
		}else {
			// hashing the password | ตรวจสอบค่า op,np
			$op = md5($op);
			$np = md5($np);
			$user_id = $_SESSION['user_id'];

			// ทำการเลือกค่า ใน database แล้วเชค op ในdatabase
			$sql = "SELECT password
					FROM users WHERE 
					user_id='$user_id' AND password='$op'";
			$result = mysqli_query($conn, $sql);
			
			//  ถ้ามีค่า = 1 ค่า ให้ทำการ update ค่า np ลงไป
			if(mysqli_num_rows($result) === 1){
				
				$sql_2 = "UPDATE users
						SET password='$np'
						WHERE user_id='$user_id'";
				mysqli_query($conn, $sql_2);
				header("Location: update-password-profile.php?success=Your password has been changed successfully");
				exit();

			}else {
				header("Location: update-password-profile.php?error=Incorrect password");
				exit();
			}

		}

    
	}else{
		header("Location: update-password-profile.php");
		exit();
	}

}else{
     header("Location: index.php");
     exit();
}