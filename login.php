<?php include "header.php" ?>

<?php include "sidebar.php" ?>

<div class="main-wrapper">
<div class="page-wrapper">
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left"> <img class="img-fluid" src="assets/img/logo-sd.png" alt="Logo"> </div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>เข้าสู่ระบบสมาชิก</h1>
							<p class="account-subtitle"></p>
							<form action="index.html">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="ผู้ใช้งาน"> </div>
								<div class="form-group">
									<input class="form-control" type="text" placeholder="รหัสผ่าน"> </div>
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
								</div>
							</form>
							<div class="text-center forgotpass"><a href="forgot-password.html">หากลืมรหัสผ่าน?</a> </div>
							<div class="login-or"> <span class="or-line"></span> <span class="span-or">หรือ</span> </div>
							<div class="text-center dont-have">ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></div>
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