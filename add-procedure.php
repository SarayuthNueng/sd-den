
<?php include "header-user-level.php" ?>
<?php include "sidebar-user-level.php" ?>
 

	<div class="main-wrapper">
		
		<div class="page-wrapper">
			<div class="content container-fluid mt-5">
				<div class="page-header">
					<div class="row align-items-center" >
						<div class="col">
							<h3 class="page-title text-center">เพิ่มประเภทการนัด</h3> </div>
					</div>
				</div>
				<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
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
							<div class="row ">
								<div class="col-md-12">
									<div class="form-group ">
										<label>ชื่อประเภทการนัด</label>
										<input class="form-control" type="text" name="firstname"  minlength="3" placeholder="ชื่อประเภทการนัด">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group ">
										<label>สีประเภทการนัด</label>
										<input class="form-control" type="text" name="lastname" placeholder="สีประเภทการนัด"> 
                                    </div>
								</div>
							</div>
                                <a type="submit" class="btn btn-secondary " href="list-den.php" role="button">กลับ</a>
                                <button type="submit" name="submit" class="btn btn-primary buttonedit ml-2">เพิ่มประเภทการนัด</button>
                                  
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

<?php
    if (isset($_SESSION['err_fill']) || isset($_SESSION['err_pw']) || isset($_SESSION['exist_uname']) || isset($_SESSION['err_insert'])) {
        unset($_SESSION['err_fill']);
        unset($_SESSION['err_pw']);
        unset($_SESSION['exist_uname']);
        unset($_SESSION['err_insert']);
    }
?>