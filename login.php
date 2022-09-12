
<?php 
    session_start();
    include_once('function/login-function.php'); 
    
    $userdata = new DB_con();

    if (isset($_POST['login'])) {
        $uname = $_POST['username'];
        $password = md5($_POST['password']);

        $result = $userdata->login($uname, $password);
        $num = mysqli_fetch_array($result);

        if ($num > 0) {
            $_SESSION['user_id'] = $num['user_id'];
            $_SESSION['firstname'] = $num['firstname'];
            $_SESSION['lastname'] = $num['lastname'];
            $_SESSION['username'] = $num['username'];
            $_SESSION['email'] = $num['email'];
            $_SESSION['tel'] = $num['tel'];
            $_SESSION['address'] = $num['address'];
            $_SESSION['user_level'] = $num['user_level'];
			$_SESSION['cid'] = $num['cid'];
			$_SESSION['title'] = $num['title'];

            if ($_SESSION['user_level'] == 'admin') {
                echo "<script>window.location.href='list-den.php'</script>";
            }

            else if ($_SESSION['user_level'] == 'doctor') {
                echo "<script>window.location.href='check-status-user.php'</script>";
            }

			else if ($_SESSION['user_level'] == 'user') {
                echo "<script>window.location.href='add-calendar.php'</script>";
            }
            
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง | กรุณาใส่รหัสผ่าอีกครั้ง');</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
    } 

?>


<?php include "components/header-level.php" ?>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
<div class="page-wrapper">
	<div class="main-wrapper login-body mt-5">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left"> <img class="img-fluid" src="components/assets/img/logo-sd.png" alt="Logo"> </div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>เข้าสู่ระบบสมาชิก</h1>
							<p class="account-subtitle"></p>
						
							<form action="" method="post">
								<div class="form-group">
									<input class="form-control" type="text" name="username" required placeholder="ผู้ใช้งาน"> </div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" required placeholder="รหัสผ่าน"> </div>
								<div class="form-group">
									<button type="submit" name="login" class="btn btn-primary btn-block" role="button">เข้าสู่ระบบ</button>
								</div>
							</form>

							<!-- <div class="text-center forgotpass"><a href="forgot-password.html">หากลืมรหัสผ่าน?</a> </div> -->
							<!-- <div class="login-or"> <span class="or-line"></span> <span class="span-or">หรือ</span> </div> -->
							<div class="text-center dont-have">ยังไม่มีบัญชี ? <a style="color: #009ce7;" href="register.php">สมัครสมาชิก</a></div>
						</div>
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
	<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="components/assets/js/script.js"></script>
</body>

</html>

