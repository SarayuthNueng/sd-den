<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

	Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

	<?php include "components/header-level.php" ?>
	<?php include "components/sidebar-level.php" ?>


	<div class="main-wrapper">
		<?php
		if (isset($_GET['user_id'])) {
			require_once 'db/pdo_connect.php';
			$stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
			$stmt->execute([$_GET['user_id']]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
			if ($stmt->rowCount() < 1) {
				header('Location: index.php');
				exit();
			}
		} //isset
		?>
		<?php

		require_once 'db/connect_main.php';

		//list kname
		$sql = "SELECT * FROM kname";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$kumnum = $stmt->fetchAll();

		//list ulevel
		$sql = "SELECT * FROM ulevel";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$level = $stmt->fetchAll();

		?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">แก้ไขทันตแพทย์</h3>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<?php if (isset($_SESSION['exist_uname'])) : ?>
									<div class="alert alert-danger alert-custom" role="alert">
										<?php echo $_SESSION['exist_uname']; ?>
									</div>
								<?php endif; ?>
								<?php if (isset($_SESSION['err_cid'])) : ?>
									<div class="alert alert-danger alert-custom" role="alert">
										<?php echo $_SESSION['err_cid']; ?>
									</div>
								<?php endif; ?>
								<form action="function/edit-den-db.php" method="post">
									<div class="row formtype">
										<div class="col-md-4">
											<div class="form-group">
												<label>ชื่อผู้ใช้งาน</label>
												<input class="form-control" type="text" name="username" required value="<?= $row['username']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<label>คำนำหน้าและชื่อ</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<select class="form-control" name="pname" id="pname">
														<option><?php echo $row['pname']; ?></option>
														<?php foreach ($kumnum as $kum) : ?>
															<option value="<?= $kum['kumnum_name']; ?>"><?= $kum['kumnum_name']; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<input type="text" name="firstname" class="form-control" required value="<?= $row['firstname']; ?>" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>นามสกุล</label>
												<input class="form-control" type="text" name="lastname" required value="<?= $row['lastname']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>เลขบัตรประจำตัวประชาชน</label>
												<input class="form-control" type="text" name="cid" required value="<?= $row['cid']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>ที่อยู่</label>
												<input class="form-control" type="text" name="address" required value="<?= $row['address']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>อีเมล</label>
												<input class="form-control" type="text" name="email" required value="<?= $row['email']; ?>" minlength="3">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>เบอร์โทรศัพท์</label>
												<input class="form-control" type="text" name="tel" required value="<?= $row['tel']; ?>" minlength="3">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>ระดับผู้ใช้งาน</label>
												<select class="form-control" name="user_level" id="user_level">
													<option><?php echo $row['user_level']; ?></option>
													<?php foreach ($level as $l) : ?>
														<option value="<?= $l['ulevel_name']; ?>"><?= $l['ulevel_name']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
									<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
									<a type="submit" class="btn btn-warning " href="list-den.php" role="button">กลับ</a>
									<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
									<button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไขข้อมูล</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($_SESSION['exist_uname']) || isset($_SESSION['err_cid'])) {
		unset($_SESSION['exist_uname']);
		unset($_SESSION['err_cid']);
	}
	?>
	<script src="components/assets/js/jquery-3.5.1.min.js"></script>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/js/moment.min.js"></script>
	<script src="components/assets/js/select2.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/plugins/raphael/raphael.min.js"></script>
	<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="components/assets/js/script.js"></script>
	<script>
		$(function() {
			$('#datetimepicker3').datetimepicker({
				format: 'LT'
			});
		});
	</script>
	</body>

	</html>
<?php } ?>