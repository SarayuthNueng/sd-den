<?php include "header-user-level.php" ?>
<?php include "sidebar.php" ?>

	<div class="main-wrapper">		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header ">
					
					<div class="row">
						<div class="col-6">
							<h3 class="page-title">สมาชิกทั้งหมด</h3>
						 </div>
						 <div class="col-6">
						 <a type="button" class="btn btn-primary buttonedit ml-2" href="add-den.php" role="button">เพิ่มสมาชิก</a>
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
												<th>ชื่อผู้ใช้งาน</th>
												<th>รหัสผ่าน</th>
												<th>ชื่อ</th>
												<th>นามสกุล</th>
												<th>เลขบัตรประจำตัวประชาชน</th>
												<th>ที่อยู่</th>
												<th>อีเมล</th>
												<th>เบอร์โทรศัพท์</th>
												<th>วันที่สมัคร</th>
												<th>ระดับผู้ใช้งาน</th>
												<th>แก้ไข</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php
											//คิวรี่ข้อมูลมาแสดงในตาราง
											require_once 'connect.php';
											$stmt = $db->prepare("SELECT* FROM users");
											$stmt->execute();
											$result = $stmt->fetchAll();
											foreach($result as $k) {
											?>
												<td><?= $k['user_id'];?></td>
												<td><?= $k['username'];?></td>
												<td>
													<a type="button" style="color: steelblue; font-weight: bold;" href="edit-password-den.php">
														แก้ไขรหัสผ่าน	
													</a>
												</td>
												<td><?= $k['firstname'];?></td>
												<td><?= $k['lastname'];?></td>
												<td><?= $k['cid'];?></td>
												<td><?= $k['address'];?></td>
												<td><?= $k['email'];?></td>
												<td><?= $k['tel'];?></td>
												<td><?= $k['date'];?></td>
												<td><?= $k['user_level'];?></td>
												<td>
													<a type="button" class="fas fa-edit ml-2"
													href="edit-den.php?user_id=<?= $k['user_id'];?>" role="button" style="color:steelblue;">
													</a>
												</td>
												<td>
												<a type="button" class="fa fa-trash ml-2 " aria-hidden="true" onclick="return confirm('ยืนยันการลบข้อมูล !!');"
													href="del.php?user_id=<?= $k['user_id'];?>" role="button" style="color:tomato">
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