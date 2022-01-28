<?php session_start(); ?>

<?php include "header.php" ?>

<?php include "sidebar.php" ?>
 

	<div class="main-wrapper">
		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">เพิ่มสมาชิก</h3> </div>
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
								<button type="submit" name="" class="btn btn-primary buttonedit ml-2">เพิ่มข้อมูล</button>
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