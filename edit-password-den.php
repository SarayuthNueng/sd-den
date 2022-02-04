
<?php include "header-user-level.php" ?>
<?php include "sidebar.php" ?>


<div class="main-wrapper">
<?php
    if(isset($_GET['user_id'])){
      require_once 'connect.php';
      $stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
      $stmt->execute([$_GET['user_id']]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
      if($stmt->rowCount() < 1){
          header('Location: index.php');
          exit();
      }
    }//isset
?>
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">แก้ไขรหัสผ่าน</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
					<form action="edit-den-db.php" method="post">
							<div class="row formtype">
								
								<div class="col-md-4">
									<div class="form-group">
										<label>รหัสผ่าน</label>
										<input class="form-control" type="text" name="password" required value="<?= $row['password'];?>" minlength="3" > </div>
								</div>
								
							</div>
								<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
								<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
								<a type="submit" class="btn btn-warning " href="list-den.php" role="button">กลับ</a>
								<input type="hidden" name="submit" value="<?= $row['user_id'];?>">
								<button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไข</button>
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
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>
</body>

</html>