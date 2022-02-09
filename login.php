
<?php include "header.php" ?>

<?php include "sidebar-user-level.php" ?>

<div class="main-wrapper">
<div class="page-wrapper">
	<div class="main-wrapper login-body mt-5">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left"> <img class="img-fluid" src="assets/img/logo-sd.png" alt="Logo"> </div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>เข้าสู่ระบบสมาชิก</h1>
							<p class="account-subtitle"></p>
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
						<?php if (isset($_SESSION['err_uname'])) : ?>
							<div class="alert alert-danger alert-custom" role="alert">
								<?php echo $_SESSION['err_uname']; ?>
							</div>
						<?php endif; ?>
							<form action="login_db.php" method="post">
								<div class="form-group">
									<input class="form-control" type="text" name="username" required placeholder="ผู้ใช้งาน"> </div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" required placeholder="รหัสผ่าน"> </div>
								<div class="form-group">
								<!-- <button type="submit" name="submit" class="btn login-btn-blue btn-block text-white">Login</button> -->
									<button type="submit" name="submit" class="btn btn-primary btn-block" role="button">เข้าสู่ระบบ</button>
								</div>
							</form>

							<!-- <div class="text-center forgotpass"><a href="forgot-password.html">หากลืมรหัสผ่าน?</a> </div> -->
							<!-- <div class="login-or"> <span class="or-line"></span> <span class="span-or">หรือ</span> </div>
							<div class="text-center dont-have">ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>

<?php
    if (isset($_SESSION['err_fill']) || isset($_SESSION['err_pw']) || isset($_SESSION['err_uname'])) {
        unset($_SESSION['err_fill']);
        unset($_SESSION['err_pw']);
        unset($_SESSION['err_uname']);
    }
?>