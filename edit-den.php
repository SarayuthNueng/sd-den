<?php include "header.php" ?>
<?php include "sidebar.php" ?>


<div class="main-wrapper">
<?php
    if(isset($_GET['id'])){
      require_once 'connect.php';
      $stmt = $conn->prepare("SELECT* FROM member WHERE id=?");
      $stmt->execute([$_GET['id']]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
      if($stmt->rowCount() < 1){
          header('Location: index.php');
          exit();
      }
    }//isset
?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">แก้ไขสมาชิก</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
					<form action="add-den-db.php" method="post">
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>ชื่อ</label>
										<input type="text" name="fname" class="form-control" required value="<?= $row['fname'];?>" minlength="3" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>นามสกุล</label>
										<input class="form-control" type="text" name="lname" required value="<?= $row['lname'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>เลขบัตรประจำตัวประชาชน</label>
										<input class="form-control" type="text" name="cid" required value="<?= $row['cid'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>ชื่อผู้ใช้งาน</label>
										<input class="form-control" type="text" name="username" required value="<?= $row['username'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>รหัสผ่าน</label>
										<input class="form-control" type="text" name="password" required value="<?= $row['password'];?>" minlength="3" > </div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>ที่อยู่</label>
										<input class="form-control" type="text" name="address" required value="<?= $row['address'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>เบอร์โทรศัพท์</label>
										<input class="form-control" type="text" name="tel" required value="<?= $row['tel'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>อีเมล</label>
										<input class="form-control" type="text" name="email" required value="<?= $row['email'];?>" minlength="3" > </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>วันที่สมัคร</label>
										<div class="">
											<input type="date" name="date" class="form-control " required value="<?= $row['date'];?>" minlength="3" > </div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>ตำแหน่ง</label>
										<select class="form-control" id="sel1" name="role"  minlength="3" >
											<option><?= $row['role'];?></option>
											<option>แอดมิน</option>
											<option>ทันตแพทย์</option>
										</select>
									</div>
								</div>
							</div>
								<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
								<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
								<button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไขข้อมูล</button>
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
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>
</body>

</html>