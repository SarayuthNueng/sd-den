
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
						<span class="user-img"><img class="rounded-circle" src="assets/img/user.svg" width="31" alt="<?php echo $row['username']; ?>"></span> 
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="assets/img/user.svg" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6><?php echo $row['username']; ?></h6>
								<p class="text-muted mb-0"><?php echo $row['user_level']; ?></p>
							</div>
						</div> 
						<!-- <a class="dropdown-item" href="profile.html">My Profile</a> 
						<a class="dropdown-item" href="settings.html">Account Settings</a>  -->
						<a class="dropdown-item" href="logout.php">Logout</a> </div>
				</li>
		  </ul>
		
      </div>

<?php include "sidebar.php" ?>
 

	<div class="main-wrapper">
		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title ">เพิ่มสมาชิก</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
				<?php if (isset($_SESSION['err_fill'])) : ?>
				<div class="alert alert-danger alert-custom" role="alert">
					<?php echo $_SESSION['err_fill']; ?>
				</div>
				<?php endif; ?>
				<?php if (isset($_SESSION['err_pw'])) : ?>
					<div class="alert alert-danger alert-custom" role="alert">
						<?php echo $_SESSION['err_pw']; ?>
					</div>
				<?php endif; ?>
				<?php if (isset($_SESSION['exist_uname'])) : ?>
					<div class="alert alert-danger alert-custom" role="alert">
						<?php echo $_SESSION['exist_uname']; ?>
					</div>
				<?php endif; ?>
				<?php if (isset($_SESSION['err_insert'])) : ?>
					<div class="alert alert-danger alert-custom" role="alert">
						<?php echo $_SESSION['err_insert']; ?>
					</div>
				<?php endif; ?>
						<form action="add-den-db.php" method="post">
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>ชื่อ</label>
										<input type="text" name="firstname" class="form-control" required minlength="3" placeholder="ชื่อ">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>นามสกุล</label>
										<input class="form-control" type="text" name="lastname" placeholder="นามสกุล"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>เลขบัตรประจำตัวประชาชน</label>
										<input class="form-control" type="text" name="cid" placeholder="เลขบัตรประจำตัวประชาชน"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>ชื่อผู้ใช้งาน</label>
										<input class="form-control" type="text" name="username" placeholder="ชื่อผู้ใช้งาน"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>รหัสผ่าน</label>
										<input class="form-control" type="password" name="password" placeholder="รหัสผ่าน"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>ยืนยันรหัสผ่าน</label>
										<input class="form-control" type="text" name="confirm_password" placeholder="ยืนยันรหัสผ่าน"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>ที่อยู่</label>
										<input class="form-control" type="text" name="address" placeholder="ที่อยู่"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>เบอร์โทรศัพท์</label>
										<input class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>อีเมล</label>
										<input class="form-control" type="text" name="email" placeholder="อีเมล"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>วันที่สมัคร</label>
										<div class="">
											<input type="date" name="date" class="form-control "> </div>
									</div>
								</div>
								<!-- <div class="col-md-4">
									<div class="form-group">
										<label>ตำแหน่ง</label>
										<select class="form-control" id="sel1" name="member_level">
											<option>เลือก</option>
											<option>แอดมิน</option>
											<option>ทันตแพทย์</option>
										</select>
									</div>
								</div> -->
							</div>
								<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
								<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
								<a type="submit" class="btn btn-warning " href="list-den.php" role="button">กลับ</a>
								<button type="submit" name="submit" class="btn btn-primary buttonedit ml-2">เพิ่มข้อมูล</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/js/script.js"></script>
	
</body>

</html>

<?php
    if (isset($_SESSION['err_fill']) || isset($_SESSION['err_pw']) || isset($_SESSION['exist_uname']) || isset($_SESSION['err_insert'])) {
        unset($_SESSION['err_fill']);
        unset($_SESSION['err_pw']);
        unset($_SESSION['exist_uname']);
        unset($_SESSION['err_insert']);
    }
?>