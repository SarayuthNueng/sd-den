
<?php include "header-user-level.php" ?>
<?php include "sidebar-user-level.php" ?>
 

	<div class="main-wrapper">

<?php
    if(isset($_GET['procedure_id'])){
      require_once 'connect.php';
      $stmt = $db->prepare("SELECT* FROM procedures WHERE procedure_id=?");
      $stmt->execute([$_GET['procedure_id']]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
      if($stmt->rowCount() < 1){
          header('Location: list-procedure.php');
          exit();
      }
    }//isset
?>
		
		<div class="page-wrapper">
			<div class="content container-fluid mt-5">
				<div class="page-header">
					<div class="row align-items-center" >
						<div class="col">
							<h3 class="page-title text-center">แก้ไขประเภทการนัด</h3> </div>
					</div>
				</div>
				<div class="row" style="padding-left: 35%; padding-right: 35%; padding-top: 3%;">
				<div class="col-lg-12">
				
						<form action="edit-procedure-db.php" method="post">
							<div class="row formtype">
								<div class="col-md-12">
									<div class="form-group ">
										<label>ชื่อประเภทการนัด</label>
										<input class="form-control" type="text" name="procedure_name" required value="<?= $row['procedure_name'];?>"  minlength="3" placeholder="ชื่อประเภทการนัด">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group ">
										<label>สีประเภทการนัด</label>
										<input class="form-control" type="text" name="color" required value="<?= $row['color'];?>" placeholder="สีประเภทการนัด"> 
                                    </div>
								</div>
							</div>
                                <a type="submit" class="btn btn-secondary " href="list-procedure.php" role="button">กลับ</a>
                                <input type="hidden" name="procedure_id" value="<?= $row['procedure_id'];?>">
                                <button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไขประเภทการนัด</button>
                                  
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
    if (isset($_SESSION['err_fill']) || isset($_SESSION['exist_pname']) || isset($_SESSION['err_insert'])) {
        unset($_SESSION['err_fill']);
        unset($_SESSION['exist_pname']);
        unset($_SESSION['err_insert']);
    }
?>