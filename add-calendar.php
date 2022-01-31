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
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">Calendar</h4>
								<button type="button" class="btn btn-primary float-right veiwbutton" data-toggle="modal" data-target="#add_event1">Add Event</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-8">
					<div class="card">
						<div class="card-body">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="add_event1" class="modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Event</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Event Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text"> </div>
								<div class="form-group">
									<label>Event Date <span class="text-danger">*</span></label>
									<div class="cal-icon">
										<input class="form-control datetimepicker" type="text"> </div>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade none-border" id="my_event">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add Event</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer justify-content-center">
							<button type="button" class="btn btn-success save-event submit-btn">Create event</button>
							<button type="button" class="btn btn-danger delete-event submit-btn" data-dismiss="modal">Delete</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="add_new_event">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add Category</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Category Name</label>
									<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" /> </div>
								<div class="form-group mb-0">
									<label>Choose Category Color</label>
									<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
										<option value="success">Success</option>
										<option value="danger">Danger</option>
										<option value="info">Info</option>
										<option value="primary">Primary</option>
										<option value="warning">Warning</option>
										<option value="inverse">Inverse</option>
									</select>
								</div>
								<div class="submit-section">
									<button type="button" class="btn btn-primary save-category submit-btn" data-dismiss="modal">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="add_event" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content modal-md">
					<div class="modal-header">
						<h4 class="modal-title">Add Event</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label>Event Name <span class="text-danger">*</span></label>
								<input class="form-control" type="text"> </div>
							<div class="form-group">
								<label>Event Date <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text"> </div>
							</div>
							<div class="m-t-20 text-center">
								<button class="btn btn-primary submit-btn">Create Event</button>
							</div>
						</form>
					</div>
					<?php include "footer.php" ?>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
	<script src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>
	<script src="assets/plugins/fullcalendar/jquery.fullcalendar.js"></script>
	<script src="assets/js/script.js"></script>
