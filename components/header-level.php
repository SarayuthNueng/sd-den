<<<<<<< HEAD
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
    <title>ปฏิทินนัดทันตกรรม | โรงพยาบาลสมเด็จ</title>
    <link rel="shortcut icon" type="image/x-icon" href="components/assets/img/logo-sd.png"/>
    <link rel="stylesheet" href="components/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="components/assets/css/feathericon.min.css" />
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
    <link rel="stylesheet" href="components/assets/plugins/morris/morris.css" />
    <link rel="stylesheet" href="components/assets/css/style.css" />
    <link rel="stylesheet" href="components/assets/css/footers.css" />
    <link rel="stylesheet" href="components/assets/plugins/datatables/datatables.min.css">
	  <link rel="stylesheet" type="text/css" href="components/assets/plugins/fontawesome/css/all.min.css">

    

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">

    <!-- sweetalert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--Sweet Alert CDN-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTable แบบภาษาไทย -->
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
            $('#myTable').dataTable( {
            "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :",
            "aaSorting" :[[0,'desc']],
            "oPaginate": {
            "sFirst":    "หน้าแรก",
            "sPrevious": "ก่อนหน้า",
            "sNext":     "ถัดไป",
            "sLast":     "หน้าสุดท้าย"
            },
            }
            } );
            } );
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
            <img
              src="components/assets/img/logo-sd.png"
              width="50"
              height="70"
              alt="logo"
            />
            <span class="logoclass">ปฏิทินนัดทันตกรรม</span>
          </a>
          <a href="../index.php" class="logo logo-small">
            <img
              src="components/assets/img/logo-sd.png"
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
		  
		  </ul>
		
=======
<?php
    session_start(); // เขียนทุกครั้งที่มีการใช้ตัวแปร session
	include('db/pdo_connect.php');  // นำเข้าไฟล์ database

    // ถ้าไม่มี $_SESSION['is_logged_in'] (เก็บสถานะ login โดยจะเก็บตอนที่สมัครสมาชิกหรือ login แล้วเท่านั้น) ให้กลับไปยังหน้า login.php เพื่อทำการ login ก่อน
    if ($_SESSION['user_id'] == "") {
        header('location: ../login.php');
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
    <link rel="shortcut icon" type="image/x-icon" href="components/assets/img/logo-sd.png"/>
    <link rel="stylesheet" href="components/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="components/assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="components/assets/css/feathericon.min.css" />
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css" />
    <link rel="stylesheet" href="components/assets/plugins/morris/morris.css" />
    <link rel="stylesheet" href="components/assets/css/style.css" />
    <link rel="stylesheet" href="components/assets/css/footers.css" />
    <link rel="stylesheet" href="components/assets/plugins/datatables/datatables.min.css">
	  <link rel="stylesheet" type="text/css" href="components/assets/plugins/fontawesome/css/all.min.css">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">

    <!-- sweetalert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--Sweet Alert CDN-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTable แบบภาษาไทย -->
    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
            $('#myTable').dataTable( {
            "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :",
            "aaSorting" :[[0,'desc']],
            "oPaginate": {
            "sFirst":    "หน้าแรก",
            "sPrevious": "ก่อนหน้า",
            "sNext":     "ถัดไป",
            "sLast":     "หน้าสุดท้าย"
            },
            }
            } );
            } );
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
            <img
              src="components/assets/img/logo-sd.png"
              width="50"
              height="70"
              alt="logo"
            />
            <span class="logoclass">ปฏิทินนัดทันตกรรม</span>
          </a>
          <a href="../index.php" class="logo logo-small">
            <img
              src="components/assets/img/logo-sd.png"
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
		  
		  </ul>
		
>>>>>>> 51ac95bd4ea84dd42a54fb4a63802e6ce4720ec6
      </div>