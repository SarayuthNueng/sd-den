<?php include "components/header-level.php" ?>
<?php include "components/sidebar-level.php" ?>

<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header ">

				<div class="row formtype mt-5">
					<div class="col-6">
						<h3 class="page-title">สมาชิกทั้งหมด</h3>
					</div>
					<div class="col-3">
						<a type="button" class="btn btn-primary ml-2" href="add-den.php" role="button">+ เพิ่มสมาชิก</a>
					</div>
					<div class="col-3">
						<a type="button" style="float: right;background: #fff799; border-color: #fff799;" class="btn ml-2" href="list-procedure.php" role="button">รายการหัตถการ</a>
					</div>

				</div>

				<div class=" mt-4 content container-fluid">
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="myTable" class=" table table table-stripped" style="width:100%">
											<thead>
												<tr>
													<th>รหัส</th>
													<th>ชื่อผู้ใช้งาน</th>
													<th>รหัสผ่าน</th>
													<th>คำนำหน้า</th>
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
													require_once 'db/pdo_connect.php';
													$stmt = $db->prepare("SELECT * FROM users WHERE user_level = 'user'");
													$stmt->execute();
													$result = $stmt->fetchAll();
													foreach ($result as $k) {
													?>
														<td><?= $k['user_id']; ?></td>
														<td><?= $k['username']; ?></td>
														<td>
															<a type="button" style="color: steelblue; font-weight: bold;" href="edit-password-den.php?user_id=<?= $k['user_id']; ?>">
																แก้ไขรหัสผ่าน
															</a>
														</td>
														<td><?= $k['pname'] ?></td>
														<td><?= $k['firstname']; ?></td>
														<td><?= $k['lastname']; ?></td>
														<td><?= $k['cid']; ?></td>
														<td><?= $k['address']; ?></td>
														<td><?= $k['email']; ?></td>
														<td><?= $k['tel']; ?></td>
														<td><?= $k['date']; ?></td>
														<td><?= $k['user_level']; ?></td>
														<td>
															<a type="button" class="fas fa-edit ml-2" href="edit-den.php?user_id=<?= $k['user_id']; ?>" role="button" style="color:steelblue;">
															</a>
														</td>
														<td>
															<a type="button" class="fa fa-trash ml-2 " aria-hidden="true" onclick="return confirm('ยืนยันการลบข้อมูล !!');" href="function/del-user.php?user_id=<?= $k['user_id']; ?>" role="button" style="color:tomato">
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
<script src="components/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="components/assets/plugins/datatables/datatables.min.js"></script>
<script src="components/assets/js/script.js"></script>
</body>

</html>