<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

<?php include "components/header-level.php" ?>
<?php include "components/sidebar-level.php" ?>


<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid mt-5">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title text-center">เพิ่มรายการหัตถการ</h3>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center" >
						<div class="col-lg-4">
							<?php if (isset($_SESSION['err_fill'])) : ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['err_fill']; ?>
								</div>
							<?php endif; ?>
							<?php if (isset($_SESSION['exist_color'])) : ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['exist_color']; ?>
								</div>
							<?php endif; ?>
							<?php if (isset($_SESSION['err_insert'])) : ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['err_insert']; ?>
								</div>
							<?php endif; ?>
							<form action="function/add-procedure-db.php" method="post">
								<div class="row formtype">
									<div class="col-md-12">
										<div class="form-group ">
											<label>ชื่อหัตถการ</label>
											<input class="form-control" type="text" name="procedure_name" minlength="3" placeholder="ชื่อประเภทหัตถการ">
										</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="color">สีหัตถการ</label>
										<div class="form-group ">
											<input class="form-control" type="color" name="color" placeholder="สีประเภทหัตถการ">
										</div>
									</div>
								</div>
								<a type="submit" class="btn btn-secondary " href="list-procedure.php" role="button">กลับ</a>
								<button type="submit" name="submit" class="btn btn-primary ml-2" style="float: right;">เพิ่มประเภทหัตถการ</button>

							</form>
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
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/plugins/raphael/raphael.min.js"></script>
<script src="components/assets/js/script.js"></script>

</body>

</html>

<?php
if (isset($_SESSION['err_fill']) || isset($_SESSION['exist_color']) || isset($_SESSION['err_insert'])) {
	unset($_SESSION['err_fill']);
	unset($_SESSION['exist_color']);
	unset($_SESSION['err_insert']);
}
?>
<?php } ?>