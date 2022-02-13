<?php
    session_start(); // เขียนทุกครั้งที่มีการใช้ตัวแปร session
	include('connect.php');  // นำเข้าไฟล์ database

    // ถ้าไม่มี $_SESSION['is_logged_in'] (เก็บสถานะ login โดยจะเก็บตอนที่สมัครสมาชิกหรือ login แล้วเท่านั้น) ให้กลับไปยังหน้า login.php เพื่อทำการ login ก่อน
    if (!isset($_SESSION['is_logged_in'])) {
        header('location: login.php');
    }
	// ถ้ามี $_SESSION['is_logged_in'] แสดงว่ามีการ login เข้ามาแล้ว
    else {
        // query ข้อมูลของคนที่ login เข้ามา เพื่อแสดงผลใน html
        $select_stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $select_stmt->bindParam(':username', $_SESSION['username']);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);   // ทำบรรทัดนี้ กรณีที่เราต้องการดึงข้อมูลมาแสดง
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
    <title>ปฏิทินนัดทันตกรรม | โรงพยาบาลสมเด็จ</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo-sd.png"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/feathericon.min.css" />
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
    <link rel="stylesheet" href="assets/plugins/morris/morris.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/footers.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	  <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">


  </head>

  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  <body>
    <div class="main-wrapper">
      <div class="header">
        <div class="header-left">
          <a href="index.php" class="logo">
            <img
              src="assets/img/logo-sd.png"
              width="50"
              height="70"
              alt="logo"
            />
            <span class="logoclass">ปฏิทินนัดทันตกรรม</span>
          </a>
          <a href="index.html" class="logo logo-small">
            <img
              src="assets/img/logo-sd.png"
              alt="Logo"
              width="30"
              height="30"
            />
          </a>
        </div>
        <a href="javascript:void(0);" id="toggle_btn">
          <i class="fe fe-text-align-left"></i>
        </a>
        <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
        
        <!-- <div class="top-nav-search">
          <form>
            <input type="text" class="form-control" placeholder="Search here" />
            <button class="btn" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div> -->

	  	<ul class="nav user-menu">
		  <li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> 
						<span class="user-img px-2"><img class="rounded-circle px-2" src="assets/img/user.svg" width="40" alt="username"><?php echo $row['username']; ?></span> 
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="user-text">
								<p class="text-muted mb-0" style="font-weight: bold; text-align: center;">
									User Level : <?php echo $row['user_level']; ?>
								</p>
							</div>
						</div> 
						<!-- <a class="dropdown-item" href="profile.html">My Profile</a> 
						<a class="dropdown-item" href="settings.html">Account Settings</a>  -->
            <?php if($row['user_level'] == 'user') {?>
              <a class="dropdown-item" href="add-calendar.php">Add Event calendar</a> 
            <?php } ?>
            <a class="dropdown-item" href="profile.php?user_id=<?= $row['user_id'];?>">My Profile</a> 
						<a class="dropdown-item" href="logout.php">Logout</a> </div>
				</li>
		  </ul>
		
      </div>