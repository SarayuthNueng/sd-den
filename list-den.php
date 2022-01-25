
<?php include "header.php" ?>
<?php include "sidebar.php" ?>

	<div class="main-wrapper">		
		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header mt-5">
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
												<th>ชื่อ</th>
												<th>นามสกุล</th>
												<th>เลขบัตรประจำตัวประชาชน</th>
												<th>ชื่อผู้ใช้งาน</th>
												<th>รหัสผ่าน</th>
												<th>ที่อยู่</th>
												<th>เบอร์โทรศัพท์</th>
												<th>อีเมล</th>
												<th>วันที่สมัคร</th>
												<th>ตำแหน่ง</th>
												<th>แก้ไข</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php
											//คิวรี่ข้อมูลมาแสดงในตาราง
											require_once 'connect.php';
											$stmt = $conn->prepare("SELECT* FROM member");
											$stmt->execute();
											$result = $stmt->fetchAll();
											foreach($result as $k) {
											?>
												<td><?= $k['id'];?></td>
												<td><?= $k['fname'];?></td>
												<td><?= $k['lname'];?></td>
												<td><?= $k['cid'];?></td>
												<td><?= $k['username'];?></td>
												<td><?= $k['password'];?></td>
												<td><?= $k['address'];?></td>
												<td><?= $k['email'];?></td>
												<td><?= $k['date'];?></td>
												<td><?= $k['role'];?></td>
												<td>
													<a type="button" class="fas fa-edit ml-2"
													href="edit-den.php" role="button" style="color:steelblue;">
													</a>
												</td>
												<td>
												<a type="button" class="fa fa-trash ml-2 " aria-hidden="true"
													href="edit-den.php" role="button" style="color:tomato">
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