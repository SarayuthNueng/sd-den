<?php include "components/header-level.php" ?>

<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<div class="mt-5">
							<h4 class="card-title float-left mt-2">ค้นหาข้อมูลการนัด</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="myTable" class=" table table table-stripped" style="width:100%">
									<thead>
										<tr>
											<th>แพทย์</th>
											<th>ชื่อ-นามสกุล</th>
											<th>รายละเอียด</th>
											<th>รายการหัตถการ</th>
											<th>เวลาเริ่มต้น</th>
											<th>เวลาสิ้นสุด</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php
										//คิวรี่ข้อมูลมาแสดงในตาราง
										require_once 'db/pdo_connect.php';
										$stmt = $db->prepare("SELECT * 
															FROM calendar c  
															LEFT JOIN procedures p on c.color = p.color
															ORDER BY id DESC");
										$stmt->execute();
										$result = $stmt->fetchAll();
										foreach ($result as $s) {
										?>
											<td><?= $s['title']?></td>
											<td><?= $s['pname_patient']?><?= $s['patient_name']?></td>
											<td><?= $s['more']?></td>
											<td><?= $s['procedure_name']?></td>
											<td><?= $s['start']?></td>
											<td><?= $s['end']?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
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
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>

<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="components/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="components/assets/plugins/datatables/datatables.min.js"></script>

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