<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

	Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

	<?php include "components/header-level.php" ?>
	<?php include "components/sidebar-level.php" ?>


	<div class="main-wrapper">

		<?php
		if (isset($_GET['procedure_id'])) {
			require_once 'db/pdo_connect.php';
			$stmt = $db->prepare("SELECT* FROM procedures WHERE procedure_id=?");
			$stmt->execute([$_GET['procedure_id']]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
			if ($stmt->rowCount() < 1) {
				header('Location: list-procedure.php');
				exit();
			}
		} //isset
		?>

		<div class="page-wrapper">
			<div class="content container-fluid mt-5">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title text-center">แก้ไขรายการหัตถการ</h3>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
							<div class="col-lg-12">
								<?php if (isset($_SESSION['exist_editcolor'])) : ?>
									<div class="alert alert-danger alert-custom" role="alert">
										<?php echo $_SESSION['exist_editcolor']; ?>
									</div>
								<?php endif; ?>
								<form action="function/edit-procedure-db.php" method="post">
									<div class="row ">
										<div class="col-md-12">
											<div class="form-group ">
												<label>ชื่อรายการหัตถการ</label>
												<input class="form-control" type="text" name="procedure_name" required value="<?= $row['procedure_name']; ?>" minlength="3" placeholder="ชื่อรายการหัตถการ">
											</div>
										</div>
										<div class="col-md-12 mb-3">
											<div class="form-group ">
												<label>สีรายการหัตถการ</label>
												<input class="form-control" type="color" name="color" required value="<?= $row['color']; ?>" placeholder="สีรายการหัตถการ">
											</div>
										</div>
									</div>

									<div class="row text-center">
										<div class="col-md-6 mt-2">
											<a type="submit" class="btn btn-secondary " href="list-procedure.php" role="button">กลับ</a>
										</div>
										<div class="col-md-6 mt-2">
											<button type="submit" class="btn btn-primary">แก้ไข</button>
										</div>
									</div>

									<input type="hidden" name="procedure_id" value="<?= $row['procedure_id']; ?>">


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
	<script src="components/assets/js/script.js"></script>


	</body>

	</html>

	<?php
	if (isset($_SESSION['exist_editcolor'])) {
		unset($_SESSION['exist_editcolor']);
	}
	?>

<?php } ?>