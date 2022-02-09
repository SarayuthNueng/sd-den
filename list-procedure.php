<?php include "header-user-level.php" ?>
<?php include "sidebar-user-level.php" ?>

	<div class="main-wrapper">		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header ">
					
					<div class="row formtype mt-5">
						<div class="col-6">
							<h3 class="page-title">ประเภทการนัดทั้งหมด</h3>
						</div>
						 <div class="col-3">
						 <a type="button" class="btn btn-primary buttonedit ml-2" href="list-den.php" role="button">สมาชิก</a>
						 </div>
						 <div class="col-3">
							<a type="button" style="color: lemonchiffon;float: right;height: 45px;background: goldenrod; border-color: goldenrod;" class="btn " href="add-procedure.php" role="button">+ เพิ่มประเภทการนัด</a>
						 </div> 
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="datatable table table-stripped">
										<thead>
											<tr>
												<th>รหัส</th>
												<th>ชื่อหัตถการ</th>
												<th>สีของหัตถการ</th>
												<th>แก้ไข</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php
											//คิวรี่ข้อมูลมาแสดงในตาราง
											require_once 'connect.php';
											$stmt = $db->prepare("SELECT* FROM procedures");
											$stmt->execute();
											$result = $stmt->fetchAll();
											foreach($result as $p) {
											?>
												<td><?= $p['procedure_id'];?></td>
												<td><?= $p['procedure_name'];?></td>
												<td><?= $p['color'];?></td>
												<td>
													<a type="button" class="fas fa-edit ml-2"
													href="edit-procedure.php?procedure_id=<?= $p['procedure_id'];?>" role="button" style="color:steelblue;">
													</a>
												</td>
												<td>
												<a type="button" class="fa fa-trash ml-2 " aria-hidden="true" onclick="return confirm('ยืนยันการลบข้อมูล !!');"
													href="del-procedure.php?procedure_id=<?= $p['procedure_id'];?>" role="button" style="color:tomato">
													</a>
												</td>

											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include "footer.php" ?>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/datatables.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>