<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

<?php include "components/header-level.php"?>
<?php include "components/sidebar-level.php"?>


<div class="main-wrapper">
	<?php
if (isset($_GET['status_id'])) {
    require_once 'db/pdo_connect.php';
    $stmt = $db->prepare("SELECT c.id, c.title, c.more, c.start, c.end, c.color, c.pname_patient, c.patient_name, c.patient_tel, c.status, p.procedure_name 
                        FROM calendar c  
                        LEFT JOIN procedures p ON p.color = c.color 
                        WHERE id=?");
    $stmt->execute([$_GET['status_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
    if ($stmt->rowCount() < 1) {
        header('Location: index.php');
        exit();
    }
} //isset
?>
	<?php

require_once 'db/connect_main.php';

//list dentist.
$sql = "SELECT * FROM users WHERE user_level='doctor' AND firstname != 'title'";
$stmt = $db->prepare($sql);
$stmt->execute();
$dentist = $stmt->fetchAll();

//list status.
$sql = "SELECT * FROM status ";
$stmt = $db->prepare($sql);
$stmt->execute();
$status = $stmt->fetchAll();

//list kname_patient
$sql = "SELECT * FROM kname_patient ";
$stmt = $db->prepare($sql);
$stmt->execute();
$kumname_patient = $stmt->fetchAll();

//list procedures
$sql = "SELECT * FROM procedures ";
$stmt = $db->prepare($sql);
$stmt->execute();
$stmt->fetchAll();

?>
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title mt-5">แก้ไขข้อมูลและสถานะคนไข้</h3>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<form action="function/edit-status-user-db.php" method="post">
								<div class="row formtype">
									
										<div class="form-group">
											<!-- <label>ทันตแพทย์</label> -->
											<input class="form-control" type="hidden" name="title"  value="<?=$row['title'];?>" minlength="3" disabled="disabled">
										</div>
									
									
										<div class="form-group">
											<!-- <label>รายการหัตถการ</label> -->
											<input class="form-control" type="hidden" name="procedure_name"  value="<?=$row['procedure_name'];?>" minlength="3" disabled="disabled">
										</div>
									
									
										<div class="form-group">
											<!-- <label>ชื่อคนไข้</label> -->
	 										<input type="hidden" class="form-control" name="patient_name" value="<?=$row['pname_patient'];?><?=$row['patient_name'];?>" disabled="disabled">
	 									</div>
									
									
										<div class="form-group">
											<!-- <label>เบอร์โทรศัพท์คนไข้</label> -->
											<input class="form-control" type="hidden" name="patient_tel"  value="<?=$row['patient_tel'];?>" minlength="3" disabled="disabled">
										</div>
									
									
										<div class="form-group">
											<!-- <label>วันที่และเวลาที่เริ่ม</label> -->
											<input class="form-control" type="hidden" name="start"  value="<?=$row['start'];?>" minlength="3" disabled="disabled">
										</div>
									
									
										<div class="form-group">
											<!-- <label>วันที่และเวลาที่สิ้นสุด</label> -->
											<input class="form-control" type="hidden" name="end"  value="<?=$row['end'];?>" minlength="3" disabled="disabled">
										</div>
									

									<div class="col-md-4">
									<div class="form-group">
										<label>สถานะ</label>
											<select class="form-control" name="status" id="status" >
												<option><?php echo $row['status']; ?></option>
												<?php foreach ($status as $s): ?>
													<option value="<?=$s['status_name'];?>"><?=$s['status_name'];?></option>
												<?php endforeach;?>
											</select>
									</div>
								</div>
								</div>
								<!-- <button type="button" class="btn btn-primary buttonedit ml-2" href="#" >เพิ่ม</button> -->
								<!-- <a type="submit" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">เพิ่ม</a> -->
								<a type="submit" class="btn btn-warning " href="check-status-user.php" role="button">กลับ</a>
								<input type="hidden" name="id" value="<?=$row['id'];?>">
								<button type="submit" class="btn btn-primary buttonedit ml-2">แก้ไขข้อมูล</button>
							</form>
						</div>
					</div>
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
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="components/assets/js/script.js"></script>
<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
</script>
</body>

</html>
<?php } ?>