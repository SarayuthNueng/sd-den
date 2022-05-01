<?php include "components/header-user-level.php" ?>
<?php include "components/sidebar-user-level.php" ?>

<div class="main-wrapper">
	<?php
	if (isset($_GET['user_id'])) {
		require_once 'db/connect.php';
		$stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
		$stmt->execute([$_GET['user_id']]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
		if ($stmt->rowCount() < 1) {
			header('Location: index.php');
			exit();
		}
	} //isset
	?>
	<?php

	require_once 'db/connect.php';

	//Our select statement. This will retrieve the data that we want.
	$sql = "SELECT * FROM kname";

	//Prepare the select statement.
	$stmt = $db->prepare($sql);

	//Execute the statement.
	$stmt->execute();

	//Retrieve the rows using fetchAll.
	$kumnum = $stmt->fetchAll();


	?>
	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="page-header mt-5">
				<div class="row">
					<div class="col">
						<h3 class="page-title">Profile</h3>
						<!-- <ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="add-calendar.php">Add Event calendar</a></li>
								<li class="breadcrumb-item active">Profile</li>
							</ul> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="profile-menu">
						<ul class="nav nav-tabs nav-tabs-solid">
							<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a> </li>
							<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a> </li>
						</ul>
					</div>
					<div class="tab-content profile-tab-cont">
						<div class="tab-pane fade show active" id="per_details_tab">
							<div class="row ">
								<div class="col-lg-12">
									<div class="card ">
										<div class="card-body ">
											<h5 class="card-title d-flex justify-content-between ">
												<span>Personal Details</span>
												<a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
											</h5>

											<div class="row mt-5">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ชื่อผู้ใช้งาน :</p>
												<p class="col-sm-9"><?php echo $row['username']; ?></p>
											</div>
											<div class="row">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">คำนำหน้า :</p>
												<p class="col-sm-9"><?php echo $row['pname']; ?></p>
											</div>
											<div class="row">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ชื่อ :</p>
												<p class="col-sm-9"><?php echo $row['firstname']; ?></p>
											</div>
											<div class="row">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">นามสกุล :</p>
												<p class="col-sm-9"><?php echo $row['lastname']; ?></p>
											</div>
											<div class="row">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">เลขบัตรประจำตัวประชาชน :</p>
												<p class="col-sm-9"><?php echo $row['cid']; ?></p>
											</div>
											<div class="row ">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ที่อยู่ :</p>
												<p class="col-sm-9"><?php echo $row['address']; ?></p>
											</div>
											<div class="row ">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">อีเมล :</p>
												<p class="col-sm-9"><?php echo $row['email']; ?></p>
											</div>
											<div class="row ">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">เบอร์โทรศัพท์ :</p>
												<p class="col-sm-9"><?php echo $row['tel']; ?></p>
											</div>
											<div class="row ">
												<p class="col-sm-3 text-sm-right mb-0 mb-sm-3">วันที่สมัคร :</p>
												<p class="col-sm-9"><?php echo $row['date']; ?></p>
											</div>

										</div>
									</div>
									<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Personal Details</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												</div>
												<div class="modal-body">
													<form action="./function/edit-profile-db.php" method="post">
														<div class="row form-row">
															<div class="col-12">
																<div class="form-group">
																	<label>ชื่อผู้ใช้งาน</label>
																	<div class="form-group">
																		<input type="text" disabled="disabled" name="username" class="form-control" value="<?php echo $row['username']; ?>">
																	</div>
																</div>
															</div>
															<div class="mb-3 col-12 col-sm-12">
																<label>คำนำหน้าและชื่อ</label>
																<div class="input-group">
																	<div class="input-group-prepend">
																		<select class="form-control" name="pname" id="pname">
																			<option><?php echo $row['pname']; ?></option>
																			<?php foreach ($kumnum as $kum) : ?>
																				<option value="<?= $kum['kumnum_name']; ?>"><?= $kum['kumnum_name']; ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<input type="text" name="firstname" class="form-control" required value="<?= $row['firstname']; ?>" />
																</div>
															</div>

															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>นามสกุล</label>
																	<input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>">
																</div>
															</div>
															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>เลขบัตรประจำตัวประชาชน</label>
																	<input type="text" class="form-control" name="cid" value="<?php echo $row['cid']; ?>">
																</div>
															</div>
															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>ที่อยู่</label>
																	<input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control">
																</div>
															</div>
															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>อีเมล</label>
																	<input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control">
																</div>
															</div>
															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>เบอร์โทรศัพท์</label>
																	<input type="text" name="tel" value="<?php echo $row['tel']; ?>" class="form-control">
																</div>
															</div>
															<div class="col-12 col-sm-6">
																<div class="form-group">
																	<label>วันที่สมัคร</label>
																	<input type="datetime-local" name="date" value="<?php echo $row['date']; ?>" class="form-control">
																</div>
															</div>

														</div>
														<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
														<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="password_tab" class="tab-pane fade">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Change Password</h5>
									<div class="row">
										<div class="col-md-10 col-lg-6">
											<form action="change_p.php" method="post">
												<div class="form-group">
													<!-- ดัก error -->
													<?php if (isset($_GET['error'])) { ?>
														<p class="error"><?php echo $_GET['error']; ?></p>
													<?php } ?>

													<?php if (isset($_GET['success'])) { ?>
														<p class="success"><?php echo $_GET['success']; ?></p>
													<?php } ?>
													<label>Old Password</label>
													<input type="text" name="op" class="form-control">
												</div>

												<div class="form-group">
													<label>New Password</label>
													<input type="text" name="np" class="form-control">
												</div>

												<div class="form-group">
													<label>Confirm Password</label>
													<input type="text" name="c_np" class="form-control">
												</div>

												<button class="btn btn-primary" type="submit">Save Changes</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="components/assets/js/jquery-3.5.1.min.js"></script>
<script src="components/assets/js/popper.min.js"></script>
<script src="components/assets/js/bootstrap.min.js"></script>
<script src="components/assets/js/moment.min.js"></script>
<script src="components/assets/js/select2.min.js"></script>
<script src="components/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="components/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="components/assets/js/script.js"></script>
</body>

</html>