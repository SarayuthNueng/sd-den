<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า index

} else { ?>

<?php include "components/header-level.php"?>
<?php include "components/sidebar-level.php"?>



<div class="main-wrapper">
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header ">

				<div class="row formtype mt-5">
					<div class="col-md-6 col-sm-6">
						<h3 class="page-title">สถานะการนัด</h3>
					</div>
					<div class="col-md-3 col-sm-3">
						<a type="button" style="float:right;" class="btn btn-primary " href="check-status-user.php" role="button">รออนุมัติ</a>
					</div>
					<div class="col-md-3 col-sm-3">
						<a type="button" style="float:right; background-color: #7f7fff; border-color: #7f7fff;" class="btn btn-primary " href="check-status-approve.php" role="button">อนุมัติแล้ว</a>
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
													<th>ทันตแพทย์</th>
													<th>รายการหัตถการ</th>
													<th>ชิ่อคนไข้</th>
													<th>เบอร์โทรศัพท์คนไข้</th>
													<th>วันที่และเวลาที่เริ่ม</th>
													<th>วันที่และเวลาที่สิ้นสุด</th>
													<th>รายละเอียด</th>
													<th>อัปเดตสถานะ</th>
													<th>ลบ</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<?php
													//คิวรี่ข้อมูลมาแสดงในตาราง
													require_once 'db/pdo_connect.php';
													$stmt = $db->prepare
														("SELECT c.id, c.title, c.more, c.start, c.end, c.color, c.pname_patient, c.patient_name, c.patient_tel, c.status, p.procedure_name
														FROM calendar c
														LEFT JOIN procedures p ON p.color = c.color
														WHERE c.status = 'รออนุมัติ'");
													$stmt->execute();
													$result = $stmt->fetchAll();
													foreach ($result as $k) {
														?>
														<td><?=$k['id'];?></td>
														<td><?=$k['title'];?></td>
														<td><?=$k['procedure_name']?></td>
														<td><?=$k['pname_patient'];?> <?=$k['patient_name'];?></td>
														<td><?=$k['patient_tel'];?></td>
														<td><?=$k['start'];?></td>
														<td><?=$k['end'];?></td>
														<td><?=$k['more'];?></td>
														<td>
															<a type="button" style="color:#ff7f7f;" href="edit-status-user.php?status_id=<?=$k['id'];?>">
                                                                <?=$k['status'];?>
                                                            </a>
														</td>
														<td>
															<a type="button" class="fa fa-trash ml-2 " aria-hidden="true" onclick="return confirm('ยืนยันการลบข้อมูล !!');" href="function/del-status-db.php?status_id=<?=$k['id'];?>" role="button" style="color:tomato">
															</a>
														</td>

												</tr>
											<?php }?>
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
		<?php include "components/footer.php"?>
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

<?php } ?>