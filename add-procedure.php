<?php include "components/header-user-level.php" ?>
<?php include "components/sidebar-user-level.php" ?>

<?php
$เหลือง = '#FFCC00';
$แดง = '#FF3300';
$ม่วง = '#CC33FF';
$เขียว = '#66CC33';
$น้ำตาล = '#996600';
$ฟ้า = '#6699FF';
$เทา = '#666666';
$น้ำเงิน = '#000080';
$ชมพู = '#FF69B4';
$ดำ = '#000000';
$เขียวเทา = '#2F4F4F';
// $แดงอ่อน = '#CD5C5C';




?>

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
			<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
				<div class="col-lg-12">
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
								<!-- <div class="form-group ">
										<label>สีประเภทหัตถการ</label>
										<input class="form-control" type="text" name="color" placeholder="สีประเภทหัตถการ"> 
                                    </div> -->
								<label for="color">สีหัตถการ</label>
								<select class="form-control" name="color" id="color">
									<option style="color: white; background-color: <?php echo $เหลือง ?>;"><?php echo $เหลือง ?></option>
									<option style="color: white; background-color: <?php echo $แดง ?>;"><?php echo $แดง ?></option>
									<option style="color: white; background-color: <?php echo $ม่วง ?>;"><?php echo $ม่วง ?></option>
									<option style="color: white; background-color: <?php echo $เขียว ?>;"><?php echo $เขียว ?></option>
									<option style="color: white; background-color: <?php echo $น้ำตาล ?>;"><?php echo $น้ำตาล ?></option>
									<option style="color: white; background-color: <?php echo $ฟ้า ?>;"><?php echo $ฟ้า ?></option>
									<option style="color: white; background-color: <?php echo $เทา ?>;"><?php echo $เทา ?></option>
									<option style="color: white; background-color: <?php echo $น้ำเงิน ?>;"><?php echo $น้ำเงิน ?></option>
									<option style="color: white; background-color: <?php echo $ชมพู ?>;"><?php echo $ชมพู ?></option>
									<option style="color: white; background-color: <?php echo $ดำ ?>;"><?php echo $ดำ ?></option>
									<option style="color: white; background-color: <?php echo $เขียวเทา ?>;"><?php echo $เขียวเทา ?></option>
								</select>
							</div>
						</div>
						<a type="submit" class="btn btn-secondary " href="list-procedure.php" role="button">กลับ</a>
						<button type="submit" name="submit" class="btn btn-primary buttonedit ml-2">เพิ่มประเภทหัตถการ</button>

					</form>
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
if (isset($_SESSION['err_fill']) || isset($_SESSION['exist_color']) || isset($_SESSION['err_insert'])) {
	unset($_SESSION['err_fill']);
	unset($_SESSION['exist_color']);
	unset($_SESSION['err_insert']);
}
?>