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

	<?php
	if (isset($_GET['procedure_id'])) {
		require_once 'db/connect.php';
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
			<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
				<div class="col-lg-12">
					<?php if (isset($_SESSION['exist_editcolor'])) : ?>
						<div class="alert alert-danger alert-custom" role="alert">
							<?php echo $_SESSION['exist_editcolor']; ?>
						</div>
					<?php endif; ?>
					<form action="function/edit-procedure-db.php" method="post">
						<div class="row formtype">
							<div class="col-md-12">
								<div class="form-group ">
									<label>ชื่อรายการหัตถการ</label>
									<input class="form-control" type="text" name="procedure_name" required value="<?= $row['procedure_name']; ?>" minlength="3" placeholder="ชื่อรายการหัตถการ">
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<!-- <div class="form-group ">
										<label>สีรายการหัตถการ</label>
										<input class="form-control" type="text" name="color" required value="<? //= $row['color'];
																												?>" placeholder="สีรายการหัตถการ"> 
                                    </div> -->
								<label for="color">สีประเภทหัตถการ</label>
								<select class="form-control" type="text" name="color" required value="<?= $row['color']; ?>" id="color">
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
						<input type="hidden" name="procedure_id" value="<?= $row['procedure_id']; ?>">
						<button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไขรายการหัตถการ</button>

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
if (isset($_SESSION['exist_editcolor'])) {
	unset($_SESSION['exist_editcolor']);
}
?>