<?php
//   session_start(); // เขียนทุกครั้งที่มีการใช้ตัวแปร session
	include('db/connect.php');  // นำเข้าไฟล์ database
  $select_stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
  $select_stmt->bindParam(':username', $_SESSION['username']);
  $select_stmt->execute();
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC); 

?>
<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
            <ul>
              
            <!-- เงื่อนไขตรวจสอบว่าได้ทำการ login ไว้ไหม // ดักไว้ที่ปุ่ม เข้าสู่ระบบ -->
            <!-- เช็คว่า session ได้เข้าสู่ระบบหรือยัง -->
            <?php if(isset($_SESSION['is_logged_in'])){ ?>  

              <!-- ถ้าเข้าสู่ระบบแล้ว ก็ให้ไปเช็ค user_level ต่อ -->
              <!-- ถ้า user_level = admin ให้ไปที่ list-den.php -->
              <?php if($row['user_level'] == 'admin'){ ?>
                <li class="submenu">
                  <a href="#">
                    <i class="fas fa-user"></i> <span><?php echo $row['username']; ?></span>
                    <span class="menu-arrow"></span>
                  </a>
                  <ul class="submenu_class" style="display: none">
                    <li><a  href="list-den.php">สมาชิกทั้งหมด</a></li>
                    <li><a  href="list-procedure.php">ประเภทการนัด</a></li>
                  </ul>
                </li>
              <!-- ถ้า user_level = user ให้ไปที่ add-calendar.php -->
               <?php }else if($row['user_level'] == 'user'){ ?>
                <li class="submenu">
                  <a href="#">
                    <i class="fas fa-user"></i> <span><?php echo $row['username']; ?></span>
                    <span class="menu-arrow"></span>
                  </a>
                  <ul class="submenu_class" style="display: none">
                    <li><a  href="add-calendar.php">เพิ่มข้อมูลในปฏิทิน</a></li>
                  </ul>
                </li>

              <!-- ถ้า นอกเหนือจากนี้ ให้แสดงปกติ -->
               <?php }else {?>
                <li class="">
                <a href="login.php">
                <i class="fas fa-user"></i>
                  <span>เข้าสู่ระบบ</span>
                </a>
                </li>
               <?php } ?>

            <!-- ถ้า นอกเหนือจากนี้ ให้แสดงปกติ -->   
            <?php } else { ?>
              <li class="">
                <a href="login.php">
                <i class="fas fa-user"></i>
                  <span>เข้าสู่ระบบ</span>
                </a>
                </li>
            <?php } ?>

              <li class="list-divider"></li>
              
              <li>
                <a href="index.php">
                  <i class="fas fa-calendar-alt"></i><span>ปฏิทินการนัดทันตกรรม</span>
                </a>
              </li>
              
              <li>
                <a href="dashboard.php">
                  <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
              </li>

			        <li>
                <a href="search.php">
                  <i class="fas fa-search"></i><span>ค้นหาข้อมูล</span>
                </a>
              </li>
              
              <li class="list-divider"></li>
              <li class="submenu">
                <a href="#">
                  <i class="fas fa-tooth"></i> <span> สีแทนประเภทการนัด </span>
                  <span class="menu-arrow"></span>
                </a>
                <ul class="submenu_class" style="display: none">
                  <li><a style="pointer-events: none; color: #05eeff;" href="">ขูดหินปูน/อุดคอฟัน </a></li>
                  <li><a style="pointer-events: none; color: #982abc;" href="">รักษารากฟัน/เดือยฟัน/ครอบฟัน/สะพานฟัน </a></li>
                  <li><a style="pointer-events: none; color: #a28415;" href="">อุดฟัน </a></li>
                  <li><a style="pointer-events: none; color: #008040;" href="">ผ่าฟันคุด/ฟันฝัง/แต่งกระดูก </a></li>
                  <li><a style="pointer-events: none; color: #0061fe;" href="">ฟันปลอม </a></li>
                  <li><a style="pointer-events: none; color: #f6c1d9;" href="">เด็ก </a></li>
                  <li><a style="pointer-events: none; color: #ff0000;" href="">Swab </a></li>
                  <li><a style="pointer-events: none; color: #000000;" href="">อื่นๆ </a></li>
                </ul>
              </li>
              
              
            </ul>
          </div>
        </div>
      </div>