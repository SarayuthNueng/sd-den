<?php
include('db/pdo_connect.php');  // นำเข้าไฟล์ database
$select_stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
$select_stmt->bindParam(':username', $_SESSION['username']);
$select_stmt->execute();
$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

//list procedures
$sql = "SELECT * FROM procedures ";
$stmt = $db->prepare($sql);
$stmt->execute();
$procedures_color = $stmt->fetchAll();

?>
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>

        <!-- เงื่อนไขตรวจสอบว่าได้ทำการ login ไว้ไหม // ดักไว้ที่ปุ่ม เข้าสู่ระบบ -->
        <!-- เช็คว่า session ได้เข้าสู่ระบบหรือยัง -->
        <?php if (isset($_SESSION['user_id'])) { ?>

          <!-- ถ้าเข้าสู่ระบบแล้ว ก็ให้ไปเช็ค user_level ต่อ -->
          <!-- ถ้า user_level = admin ให้ไปที่ list-den.php -->
          <?php if ($row['user_level'] == 'admin') { ?>
            <li class="submenu">
              <a href="#">
                <i class="fas fa-user"></i> <span><?php echo $row['pname']; ?><?php echo $row['firstname']; ?><?php echo ' ' ?><?php echo $row['lastname']; ?></span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="submenu_class" style="display: none">
                <li ><a href="profile.php?user_id=<?= $row['user_id']; ?>">โปรไฟล์</a></li>
                <li ><a href="list-den.php">ทันตแพทย์ทั้งหมด</a></li>
                <li ><a href="list-user.php">สมาชิกทั้งหมด</a></li>
                <li ><a href="list-procedure.php">รายการหัตถการ</a></li>
                <li ><a href="add-calendar-admin.php">เพิ่มข้อมูลในปฏิทิน</a></li>
                <li ><a href="check-status-user.php">เช็คสถานะวันนัด</a></li>
              </ul>
            </li>
            <!-- ถ้า user_level = doctor ให้ไปที่ add-calendar.php -->
          <?php } else if ($row['user_level'] == 'doctor') { ?>
            <li class="submenu">
              <a href="#">
                <i class="fas fa-user"></i> <span><?php echo $row['pname']; ?><?php echo $row['firstname']; ?><?php echo ' ' ?><?php echo $row['lastname']; ?></span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="submenu_class" style="display: none">
                <li><a href="profile.php?user_id=<?= $row['user_id']; ?>">โปรไฟล์</a></li>
                <li><a href="add-calendar-den.php">เพิ่มข้อมูลในปฏิทิน</a></li>
                <li><a href="check-status-user.php">เช็คสถานะวันนัด</a></li>
              </ul>
            </li>

            <!-- ถ้า user_level = user ให้ไปที่ add-calendar.php -->
          <?php } else if ($row['user_level'] == 'user') { ?>
            <li class="submenu">
              <a href="#">
                <i class="fas fa-user"></i> <span><?php echo $row['pname']; ?><?php echo $row['firstname']; ?><?php echo ' ' ?><?php echo $row['lastname']; ?></span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="submenu_class" style="display: none">
                <li><a href="profile.php?user_id=<?= $row['user_id']; ?>">โปรไฟล์</a></li>
                <li><a href="add-calendar.php">เพิ่มข้อมูลในปฏิทิน</a></li>
              </ul>
            </li>

            <!-- ถ้า นอกเหนือจากนี้ ให้แสดงปกติ -->
          <?php } else { ?>
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

        <?php if (isset($_SESSION['user_id'])) { ?>
          <li>
            <a href="calendar-level.php">
              <i class="fas fa-calendar-alt"></i><span>ปฏิทินการนัดทันตกรรม</span>
            </a>
          </li>
        <?php } else { ?>
          <li>
            <a href="calendar.php">
              <i class="fas fa-calendar-alt"></i><span>ปฏิทินการนัดทันตกรรม</span>
            </a>
          </li>
        <?php } ?>


        <li>
          <a href="dashboard-level.php">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="search-level.php">
            <i class="fas fa-search"></i><span>ค้นหาข้อมูล</span>
          </a>
        </li>



        <li class="list-divider"></li>
        <li class="submenu">
          <a href="#">
            <i class="fas fa-tooth"></i> <span> สีรายการหัตถการ </span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="submenu_class" style="display: none">
            <?php foreach ($procedures_color as $color) : ?>
              <li><a style="pointer-events: none; color: <?= $color['color']; ?>" href=""><?= $color['procedure_name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>

        <?php if (isset($_SESSION['user_id'])) { ?>
          <li>
            <a class="exit-btn" href="logout.php">
              <i class="fas fa-sign-out-alt"></i><span>ออกจากระบบ</span>
            </a>
          </li>
        <?php } ?>


      </ul>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll(".nav-item").forEach((ele) =>
    ele.addEventListener("click", function(event) {
      event.preventDefault();
      document
        .querySelectorAll(".nav-item")
        .forEach((ele) => ele.classList.remove("active"));
      this.classList.add("active")
    })
  );
</script>

<script>
  $('.exit-btn').on('click', function(e) {
    e.preventDefault();
    var self = $(this);
    console.log(self.data('title'));
    Swal.fire({
      title: 'คุณต้องการออกจากระบบหรือไม่ ?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = self.attr('href');
      }

    })
  })
</script>