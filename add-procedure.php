
<?php include "components/header-user-level.php" ?>
<?php include "components/sidebar-user-level.php" ?>
 

	<div class="main-wrapper">
		
		<div class="page-wrapper">
			<div class="content container-fluid mt-5">
				<div class="page-header">
					<div class="row align-items-center" >
						<div class="col">
							<h3 class="page-title text-center">เพิ่มประเภทหัตถการ</h3> </div>
					</div>
				</div>
				<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
					<div class="col-lg-12">
				<?php if (isset($_SESSION['err_fill'])) : ?>
				<div class="alert alert-danger alert-custom" role="alert">
					<?php echo $_SESSION['err_fill']; ?>
				</div>
				<?php endif; ?>
				<?php if (isset($_SESSION['exist_pname'])) : ?>
					<div class="alert alert-danger alert-custom" role="alert">
						<?php echo $_SESSION['exist_pname']; ?>
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
										<label>ชื่อประเภทหัตถการ</label>
										<input class="form-control" type="text" name="procedure_name"  minlength="3" placeholder="ชื่อประเภทหัตถการ">
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<!-- <div class="form-group ">
										<label>สีประเภทหัตถการ</label>
										<input class="form-control" type="text" name="color" placeholder="สีประเภทหัตถการ"> 
                                    </div> -->
										<label for="color">สีประเภทหัตถการ</label>
											<select class="form-control" 
												name="color" id="color">
												<option>เหลือง</option>
												<option>แดง</option>
												<option>ม่วง</option>
												<option>เขียว</option>
												<option>น้ำตาล</option>
												<option>ฟ้า</option>
												<option>เทา</option>
												<option>น้ำเงิน</option>
												<option>ชมพู</option>
												<option>ดำ</option>
												<option>เขียวเทา</option>
												<option>ทอง</option>
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
    if (isset($_SESSION['err_fill']) || isset($_SESSION['exist_pname']) || isset($_SESSION['err_insert'])) {
        unset($_SESSION['err_fill']);
        unset($_SESSION['exist_pname']);
        unset($_SESSION['err_insert']);
    }
?>