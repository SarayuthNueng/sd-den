
<?php 
    session_start();
    include_once('function/login-function.php'); 
    
    $userdata = new DB_con();

    if (isset($_POST['login'])) {
        $uname = $_POST['username'];
        $password = md5($_POST['password']);

        $result = $userdata->login($uname, $password);
        $num = mysqli_fetch_array($result);

        if ($num > 0) {
            $_SESSION['user_id'] = $num['user_id'];
            $_SESSION['firstname'] = $num['firstname'];
            $_SESSION['lastname'] = $num['lastname'];
            $_SESSION['username'] = $num['username'];
            $_SESSION['email'] = $num['email'];
            $_SESSION['tel'] = $num['tel'];
            $_SESSION['address'] = $num['address'];
            $_SESSION['user_level'] = $num['user_level'];
			$_SESSION['cid'] = $num['cid'];
			$_SESSION['title'] = $num['title'];

            if ($_SESSION['user_level'] == 'admin') {
                echo "<script>window.location.href='list-den.php'</script>";
            }

            else if ($_SESSION['user_level'] == 'doctor') {
                echo "<script>window.location.href='check-status-user.php'</script>";
            }

			else if ($_SESSION['user_level'] == 'user') {
                echo "<script>window.location.href='add-calendar.php'</script>";
            }
            
        } else {
			echo '<script>
			setTimeout(function() {
			swal({
				title: "รหัสผ่านไม่ถูกต้อง",
				text: "กรุณาใส่รหัสใหม่อีกครั้ง",
				type: "error"
			}, function() {
				window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
			});
			}, 100);
		</script>';
            // echo "<script>window.location.href='login.php'</script>";
        }
    } 

?>


<?php
session_start(); // เขียนทุกครั้งที่มีการใช้ตัวแปร session
include('db/pdo_connect.php');  // นำเข้าไฟล์ database


// query ข้อมูลของคนที่ login เข้ามา เพื่อแสดงผลใน html
$select_stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
$select_stmt->bindParam(':username', $_SESSION['username']);
$select_stmt->execute();
$row = $select_stmt->fetch(PDO::FETCH_ASSOC);   // ทำบรรทัดนี้ กรณีที่เราต้องการดึงข้อมูลมาแสดง
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
  <title>ปฏิทินนัดทันตกรรม | โรงพยาบาลสมเด็จ</title>
  <link rel="shortcut icon" type="image/x-icon" href="components/assets/img/logo-sd.png" />
  <link rel="stylesheet" href="components/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/fontawesome.min.css" />
  <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="components/assets/css/feathericon.min.css" />
  <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
  <link rel="stylesheet" href="components/assets/plugins/morris/morris.css" />
  <link rel="stylesheet" href="components/assets/css/style.css" />
  <link rel="stylesheet" href="components/assets/css/footers.css" />
  <link rel="stylesheet" href="components/assets/plugins/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="components/assets/plugins/fontawesome/css/all.min.css">



  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">

  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  

  <!-- datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

  <!-- DataTable แบบภาษาไทย -->
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#myTable').dataTable({
        "oLanguage": {
          "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
          "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
          "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
          "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
          "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
          "sSearch": "ค้นหา :",
          "aaSorting": [
            [0, 'desc']
          ],
          "oPaginate": {
            "sFirst": "หน้าแรก",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "หน้าสุดท้าย"
          },
        }
      });
    });
  </script>


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
        <a href="../index.php" class="logo">
          <img src="components/assets/img/logo-sd.png" width="50" height="70" alt="logo" />
          <span class="logoclass">ปฏิทินนัดทันตกรรม</span>
        </a>
        <a href="../index.php" class="logo logo-small">
          <img src="components/assets/img/logo-sd.png" alt="Logo" width="30" height="30" />
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

      </ul>
    </div>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
<div class="page-wrapper">
	<div class="main-wrapper login-body mt-5">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left"> <img class="img-fluid" src="components/assets/img/logo-sd.png" alt="Logo"> </div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>เข้าสู่ระบบสมาชิก</h1>
							<p class="account-subtitle"></p>
						
							<form action="" method="post">
								<div class="form-group">
									<input class="form-control" type="text" name="username" required placeholder="ผู้ใช้งาน"> </div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" required placeholder="รหัสผ่าน"> </div>
								<div class="form-group">
									<button type="submit" name="login" class="btn btn-primary btn-block" role="button">เข้าสู่ระบบ</button>
								</div>
							</form>

							<!-- <div class="text-center forgotpass"><a href="forgot-password.html">หากลืมรหัสผ่าน?</a> </div> -->
							<!-- <div class="login-or"> <span class="or-line"></span> <span class="span-or">หรือ</span> </div> -->
							<div class="text-center dont-have">ยังไม่มีบัญชี ? <a style="color: #009ce7;" href="register.php">สมัครสมาชิก</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "components/footer.php" ?>
</div>
</div>
	<script src="components/assets/js/jquery-3.5.1.min.js"></script>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/script.js"></script>
</body>

</html>

