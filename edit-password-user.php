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
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5 text-center">แก้ไขรหัสผ่าน</h3>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 0%;">
							<div class="col-lg-12">
								<form action="function/edit-password-user-db.php" method="post">
									<div class="row ">
										<div class="col-md-12">
											<div class="form-group">
												<label>รหัสผ่าน</label>
												<input class="form-control" type="password" name="password" required value="" minlength="3">
											</div>
										</div>
									</div>

									<div class="row text-center">
										<div class="col-md-6 mt-2">
										<a type="submit" class="btn btn-warning " href="list-user.php" role="button">กลับ</a>
										</div>
										<div class="col-md-6 mt-2">
										<button type="submit" class="btn btn-primary ">แก้ไข</button>
										</div>
									</div>
									<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
									<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
									
									<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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