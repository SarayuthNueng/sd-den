
<?php
require_once 'db/pdo_connect.php';

//list kname
$sql = "SELECT * FROM kname_patient";
$stmt = $db->prepare($sql);
$stmt->execute();
$kumnum = $stmt->fetchAll();

?>

<?php include "components/header-level.php"?>

<?php include "components/sidebar-level.php"?>

<div class="main-wrapper">
<div class="page-wrapper">
	<div class="main-wrapper login-body mt-5">
		<div class="login-wrapper">
			<div class="container">

            <div class="card" style="margin: 1.875rem auto; border-radius: 6px;">
				<div class="card-body">
					<div class="container col-md-12 py-4 px-4 mt-4">
                    <div class="login-right-wrap">
							<h1 class="text-center">สมัครสมาชิก</h1>
							<p class="account-subtitle"></p>

                            <?php if (isset($_SESSION['err_fill'])): ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['err_fill']; ?>
								</div>
							<?php endif;?>
							<?php if (isset($_SESSION['err_pw'])): ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['err_pw']; ?>
								</div>
							<?php endif;?>
							<?php if (isset($_SESSION['exist_uname'])): ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['exist_uname']; ?>
								</div>
							<?php endif;?>
							<?php if (isset($_SESSION['err_insert'])): ?>
								<div class="alert alert-danger alert-custom" role="alert">
									<?php echo $_SESSION['err_insert']; ?>
								</div>
							<?php endif;?>

							<form action="function/add-register-db.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="username" placeholder="ชื่อผู้ใช้งาน" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" placeholder="รหัสผ่าน" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input class="form-control" type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
											<div class="input-group-prepend">
												<select class="form-control" name="pname" id="pname" >
                                                <option value="" >คำนำหน้า</option>
													<?php foreach ($kumnum as $kum): ?>
														<option value="<?=$kum['kumnum_patient'];?>"><?=$kum['kumnum_patient'];?></option>
													<?php endforeach;?>
												</select>
											</div>
											<input type="text" class="form-control" name="firstname" placeholder="ชื่อ" >
										</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="lastname" placeholder="นามสกุล" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="cid" placeholder="เลขบัตรประจำตัวประชาชน" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="email" placeholder="อีเมล" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="address" placeholder="ที่อยู่" id="exampleFormControlTextarea1" rows="2" ></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 offset-md-3 px-5 mt-3">
                                    <div class="form-group">
									        <button type="submit" name="submit" class="btn btn-primary btn-block" role="button">สมัครสมาชิก</button>
								    </div>
                                    <div class="text-center dont-have" style="color: #a0a0a0;"> มีบัญชีแล้ว ? </h6><a href="login.php">เข้าสู่ระบบสมาชิก</a></div>
                                </div>
                                    
							

							</form>


						</div>
                    </div>
                </div>
				</div>
			</div>
		</div>
	</div>
	<?php include "components/footer.php"?>
</div>
</div>
	<script src="components/assets/js/jquery-3.5.1.min.js"></script>
	<script src="components/assets/js/popper.min.js"></script>
	<script src="components/assets/js/bootstrap.min.js"></script>
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/script.js"></script>
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

